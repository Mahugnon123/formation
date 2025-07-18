@extends('Admin.app')

@section('content')
<div class="m-3">
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif
</div>

<div class="m-3" style="background-color: #f5f5f5; padding: 20px; border-radius: 10px;">
    <div class="discussion-header mb-4" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(44,62,80,0.08); padding: 18px 16px; margin-bottom: 18px; display: table; margin-left: 0; margin-right: 0; min-width: 220px; max-width: 90vw;">
        <div style="text-align: left; display: table-cell; vertical-align: middle;">
            <div class="discussion-subtitle" style="font-size: 1rem; color: #6c757d; display: flex; align-items: center; gap: 6px;">
                <i class="bx bx-user" style="font-size: 1.1em;"></i>
                <span>Participants :</span>
                <span style="font-weight:500;">{{ optional($users[$requete->user_id] ?? null)->nom ?? 'Inconnu' }}</span> & Administrateur
            </div>
        </div>
    </div>

    <!-- Bloc message initial modernisé -->
    <div class="message-initial-block mb-3 mt-2">
        @php
            $photo = $users[$requete->user_id]['photo_profil'] ?? null;
            if ($photo) {
                // Si le chemin commence déjà par les bons dossiers, on l'utilise tel quel
                if (
                    strpos($photo, 'photo_profil/') === 0 ||
                    strpos($photo, 'partner_requests/photos/') === 0
                ) {
                    $photoPath = $photo;
                } else {
                    // Sinon, on préfixe avec 'photo_profil/'
                    $photoPath = 'photo_profil/' . ltrim($photo, '/');
                }
                $photoUrl = asset('storage/' . $photoPath);
            } else {
                // Si pas de photo, image par défaut
                $photoUrl = asset('/1.png');
            }
        @endphp
        <img class="rounded-circle shadow-1-strong m-3"
             src="{{ $photoUrl }}"
             alt="avatar" width="90" height="90"
             onerror="this.src='{{ asset('/1.png') }}'" />
        <div style="flex:1; min-width: 0;">
            <div class="message-initial-title" style="font-weight: 600; color: #2d3a4a; font-size: 1.1rem;">
                {{ $requete->titre }}
            </div>
            <div class="message-initial-desc" style="color: #444; font-size: 1rem;">
                {{ $requete->description }}
            </div>
            <div class="message-initial-date mt-1" style="font-size: 0.95rem; color: #888;">
                <small>Envoyé le {{ date('d/m/Y H:i:s', strtotime($requete->updated_at)) }}</small>
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
                    @php
                        $photo = $users[$reponse->user_id]['photo_profil'] ?? null;
                        if ($photo) {
                            if (
                                strpos($photo, 'photo_profil/') === 0 ||
                                strpos($photo, 'partner_requests/photos/') === 0
                            ) {
                                $photoPath = $photo;
                            } else {
                                $photoPath = 'photo_profil/' . ltrim($photo, '/');
                            }
                            $photoUrl = asset('storage/' . $photoPath);
                        } else {
                            $photoUrl = asset('/1.png');
                        }
                    @endphp
                    <img class="avatar shadow-1-strong me-2"
                         src="{{ $photoUrl }}"
                         alt="Photo de profil de {{ $users[$reponse->user_id]['nom'] ?? 'Inconnu' }}"
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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

// Script pour scroll automatique à la fin de la discussion
document.addEventListener('DOMContentLoaded', function() {
    // Scroll à la fin de la discussion (avant le formulaire)
    var formSection = document.getElementById('form');
    if (formSection) {
        formSection.scrollIntoView({ behavior: 'smooth' });
    }
});

// Disparition automatique de l'alerte après 4 secondes
document.addEventListener('DOMContentLoaded', function() {
    var alert = document.getElementById('success-alert');
    if (alert) {
        setTimeout(function() {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 4000);
    }
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
    .discussion-header {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        margin-bottom: 18px;
        padding: 18px 16px;
        display: table;
        margin-left: 0;
        margin-right: 0;
        min-width: 220px;
        max-width: 90vw;
    }
    .discussion-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #2d3a4a;
        letter-spacing: 0.01em;
        margin-bottom: 4px;
    }
    .discussion-subtitle {
        font-size: 1rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    @media (max-width: 767.98px) {
        .discussion-header {
            border-radius: 12px;
            padding: 10px 6px;
            max-width: 95vw;
            min-width: unset;
        }
        .discussion-title {
            font-size: 1.1rem;
        }
        .discussion-subtitle {
            font-size: 0.97rem;
        }
    }
    .message-initial-block {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(44,62,80,0.08);
        max-width: 400px;
        width: 100%;
        margin-bottom: 18px;
        padding: 18px 18px 14px 18px;
        margin-left: 0;
    }
    @media (max-width: 767.98px) {
        .message-initial-block {
            max-width: 95vw;
            padding: 12px 6px 10px 6px;
            border-radius: 12px;
        }
        .message-initial-title {
            font-size: 1rem !important;
        }
        .message-initial-desc {
            font-size: 0.97rem !important;
        }
    }
</style>

@endsection 