@extends('Admin.app')

@section('content')
<div class="m-3">
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<div class="m-3" style="background-color: #f5f5f5; padding: 20px; border-radius: 10px;">
    <h3 class="text-center mt-2 pb-4">Discussion avec le formateur</h3>
    <a href="#form" style="text-decoration:none">
        <button type="button" class="btn btn-primary py-2 pb-2 m-3">Répondre au message</button>
    </a>

    <h3>{{ $requete->titre }}</h3>
    <p>
        <h4>Participants :</h4>
        <h5>{{ optional($users[$requete->user_id] ?? null)->nom ?? 'Inconnu' }} & Administrateur</h5>
    </p>

    <div class="card mb-3 mt-2">
        <div class="row g-0 d-flex align-items-center">
            <div class="col-md-1 d-flex justify-content-center">
                <img class="avatar shadow-1-strong m-1"
                     src="{{ optional($users[$requete->user_id] ?? null)->photo_profil 
                            ? asset('storage/photo_profil/' . $users[$requete->user_id]->photo_profil) 
                            : asset('/1.png') }}"
                     alt="Photo de profil de {{ optional($users[$requete->user_id] ?? null)->nom ?? 'Inconnu' }}"
                     width="40" height="40"
                     onerror="this.src='{{ asset('/1.png') }}'" />
            </div>
            <div class="col-md-11">
                <div class="card-body">
                    <h5 class="card-title">{{ $requete->titre }}</h5>
                    <p class="card-text">{{ $requete->description }}</p>
                    <p class="card-text"><small class="text-muted">Envoyé le {{ date('d/m/Y H:i:s', strtotime($requete->updated_at)) }}</small></p>
                </div>
            </div>
        </div>
    </div>

    @if($reponses == null || $reponses->isEmpty())
        <h5 class="text-center" style="color: #666;">Aucune réponse</h5>
    @else
        @foreach($reponses as $reponse)
            @php
                $isMe = auth()->id() === $reponse->user_id;
                $parentResponse = $reponse->parent;
                $reponseId = 'reponse-' . $reponse->id;
            @endphp

            <div class="d-flex {{ $isMe ? 'justify-content-end' : 'justify-content-start' }} mb-3" style="border-radius: 1rem; padding: 1px;" id="{{ $reponseId }}">
                @if(!$isMe)
                    <img class="avatar shadow-1-strong me-2"
                         src="{{ optional($users[$reponse->user_id] ?? null)->photo_profil 
                                ? asset('storage/photo_profil/' . $users[$reponse->user_id]->photo_profil) 
                                : asset('/1.png') }}"
                         alt="Photo de profil de {{ optional($users[$reponse->user_id] ?? null)->nom ?? 'Inconnu' }}"
                         width="40" height="40"
                         onerror="this.src='{{ asset('/1.png') }}'" />
                @endif

                <div class="p-3 rounded text-wrap" style="word-break: break-word; max-width: 60%; background-color: {{ $isMe ? '#d1e7dd' : '#e4e6eb' }}; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow-wrap: break-word; margin-left: {{ !$isMe ? '10px' : '0' }}; margin-right: {{ $isMe ? '10px' : '0' }};">
                    @if($parentResponse)
                        <blockquote class="blockquote mb-2" style="background-color: #f0f0f0; border-left: 3px solid #007bff; padding: 10px;">
                            <small class="text-muted">Réponse à :</small>
                            <p class="mb-0">{{ Str::limit($parentResponse->description, 50) }}</p>
                            <small><a href="#reponse-{{ $parentResponse->id }}" class="text-primary">Voir le message original</a></small>
                        </blockquote>
                    @endif

                    <div class="mb-2">
                        <strong>@ {{ optional($users[$reponse->user_id] ?? null)->nom ?? 'Inconnu' }}</strong><br>
                        <small class="text-muted">{{ date('d/m/Y H:i:s', strtotime($reponse->updated_at)) }}</small>
                    </div>
                    <p class="mb-1 m-0" style="white-space: pre-line;">{{ $reponse->description }}</p>
                    <a href="#form" class="btn btn-sm btn-link text-primary p-0 me-2" onclick="Reply(this)"
                       data-id="{{ $reponse->id }}" data-value="{{ Str::limit($reponse->description, 50) }}" aria-label="Répondre au message">
                        <i class="bx bx-chat"></i> Répondre
                    </a>
                    @if($isMe)
                         <div class="d-inline-flex align-items-center">
                               <a href="javascript:void(0)" class="btn btn-sm btn-link text-warning p-0 me-2"
                                    onclick="prepareEdit('{{ $reponse->id }}', '{{ addslashes($reponse->description) }}')"                                         aria-label="Modifier ce message">
                                              <i class="bx bx-pencil"></i>
                                </a>
                                        <form action="{{ route('admin.reponse.delete', $reponse->id) }}" method="POST" class="delete-response-form" style="display:inline;">
                                             @csrf
                                                  @method('DELETE')
                                                      <button type="button" class="btn btn-sm btn-link text-danger p-0 btn-delete-response" aria-label="Supprimer ce message">
                                                         <i class="bx bx-trash"></i>
                                                             </button>
                                                            </form>
                             </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

    <!-- Section du formulaire -->
<section style="background-color: #eee;" id="form">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card" style="border: none; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                    <div class="card-body py-3 border-0" style="background-color: #f8f9fa;">
                        <form id="responseForm" action="{{ route('admin.reponse.store', $requete->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" id="parent_id" value="">
                            <input type="hidden" name="edit_response_id" id="edit_response_id" value="">

                            <div id="replyCitation" style="display: none; padding: 15px; background-color: #f8f9fa; border-left: 2px solid #007bff; margin-bottom: 10px; border-radius: 5px;">
                                <p class="mb-0" style="font-weight: bold; color: #444;"><span id="replyText"></span></p>
                                <small><a href="#" id="replyLink" class="text-primary scroll-to-message"><i class="bx bx-show"></i> Voir le message original</a></small>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label"></label>
                                <textarea class="form-control" id="description" name="description" placeholder="Ecrivez un message..." rows="4" required style="border-radius: 5px;"></textarea>
                            </div>

                            <div class="d-flex justify-content-end mt-2">
                                <button type="submit" class="btn btn-primary me-2" id="submitBtn">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Modal de confirmation suppression -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center" id="deleteConfirmLabel" style="font-weight:600;">Confirmer la suppression</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body text-center">
        <p>Voulez-vous vraiment supprimer cette réponse ?</p>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
        <button type="button" class="btn btn-secondary" id="cancelDeleteBtn" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script>
console.log('Script chargé');

function Reply(elm) {
    console.log('Fonction Reply appelée');
    const parent_id = document.getElementById('parent_id');
    const texteraReply = document.getElementById('description');
    const replyCitation = document.getElementById('replyCitation');
    const replyText = document.getElementById('replyText');
    const replyLink = document.getElementById('replyLink');
    const replyId = elm.getAttribute('data-id');
    const descripReply = elm.getAttribute('data-value');

    parent_id.value = replyId;
    replyText.textContent = descripReply;
    replyLink.setAttribute('href', '#reponse-' + replyId);
    replyCitation.style.display = 'block';
    texteraReply.value = '';
    document.getElementById('submitBtn').textContent = 'Envoyer';
    document.getElementById('edit_response_id').value = ''; // Réinitialiser le mode édition
    document.getElementById('responseForm').action = "{{ route('admin.reponse.store', $requete->id) }}";
    document.getElementById('responseForm').scrollIntoView({ behavior: 'smooth' });
}

function prepareEdit(responseId, description) {
    console.log('Préparation de l\'édition pour ID:', responseId);
    console.log('Description reçue:', description);

    const editResponseId = document.getElementById('edit_response_id');
    const descriptionField = document.getElementById('description');
    const replyCitation = document.getElementById('replyCitation');

    if (!editResponseId || !descriptionField) {
        console.error('Erreur : éléments DOM manquants');
        return;
    }

    editResponseId.value = responseId;
    descriptionField.value = description.replace(/\\n/g, '\n').replace(/\\'/g, "'").replace(/\\"/g, '"') || '';
    document.getElementById('parent_id').value = '';
    replyCitation.style.display = 'none';
    document.getElementById('submitBtn').textContent = 'Mettre à jour';
    document.getElementById('responseForm').action = '/admin/reponse/update/' + responseId;
    console.log('Action du formulaire définie:', document.getElementById('responseForm').action);
    document.getElementById('responseForm').scrollIntoView({ behavior: 'smooth' });
    descriptionField.focus();
}

function resetForm() {
    console.log('Réinitialisation du formulaire');
    const form = document.getElementById('responseForm');
    form.action = "{{ route('admin.reponse.store', $requete->id) }}";
    document.getElementById('edit_response_id').value = '';
    document.getElementById('parent_id').value = '';
    document.getElementById('description').value = '';
    document.getElementById('replyCitation').style.display = 'none';
    document.getElementById('submitBtn').textContent = 'Envoyer';
}

document.getElementById('responseForm').addEventListener('submit', function(e) {
    console.log('Formulaire soumis');
    const editResponseId = document.getElementById('edit_response_id').value;
    if (editResponseId) {
        this.action = '/admin/reponse/update/' + editResponseId;
        console.log('Action définie pour mise à jour:', this.action);
    } else {
        this.action = "{{ route('admin.reponse.store', $requete->id) }}";
        console.log('Action définie pour stockage:', this.action);
    }

    // Réinitialiser le formulaire après soumission
    setTimeout(() => {
        resetForm();
    }, 500);
});

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM entièrement chargé');
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            console.log('Ancre cliquée:', this.getAttribute('href'));
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.classList.add('highlight-message');
                targetElement.scrollIntoView({ behavior: 'smooth' });
                setTimeout(() => {
                    targetElement.classList.remove('highlight-message');
                }, 3000);
            }
        });
    });
});

let formToDelete = null;

document.querySelectorAll('.btn-delete-response').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        formToDelete = this.closest('form');
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    });
});

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (formToDelete) {
        formToDelete.submit();
    }
    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
    modal.hide();
});
</script>

<!-- Styles -->
<style>
    .avatar {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
    }
    .col-md-1.d-flex.justify-content-center {
        min-width: 60px;
    }
    .card {
        border-radius: 1rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .highlight-message {
        animation: highlight 3s ease-out;
        border: 2px solid #007bff;
        border-radius: 0.5rem;
        background-color: #e6f3ff;
    }
    @keyframes highlight {
        0% { border-color: #007bff; background-color: #e6f3ff; }
        100% { border-color: transparent; background-color: transparent; }
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-1px);
    }
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.5);
    }
    #replyCitation {
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        border-left: 2px solid #007bff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    #replyCitation p {
        margin-bottom: 0;
        font-weight: bold;
        color: #444;
    }
    #replyCitation small a {
        color: #007bff;
        text-decoration: none;
        font-style: italic;
    }
    #replyCitation small a:hover {
        text-decoration: underline;
    }
    #replyCitation small a i {
        margin-right: 5px;
    }
</style>

@endsection