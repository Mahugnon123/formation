@extends("Formateur.app")

@section("content")
<?php
?>
<!-- Débogage détaillé -->
<div class="m-3">
    
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible m-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
             {{ session()->get('message') }}
        </div>
    @endif
</div>




<div class="m-3" style="background-color: #f5f5f5; padding: 20px; border-radius: 10px;">
 
  
    <div class="card mb-3 mt-2">
        <div class="discussion-header mb-4" style="background: #fff; border-radius: 16px; box-shadow: 0 2px 8px rgba(44,62,80,0.08); padding: 18px 16px; margin-bottom: 18px; display: table; margin-left: 0; margin-right: 0; min-width: 220px; max-width: 90vw;">
            <div style="text-align: left; display: table-cell; vertical-align: middle;">
                <div class="discussion-subtitle" style="font-size: 1rem; color: #6c757d; display: flex; align-items: center; gap: 6px;">
                    <i class="bx bx-user" style="font-size: 1.1em;"></i>
                    <span>Participants :</span>
                    <span style="font-weight:500;">{{ optional($users[$requete->user_id] ?? null)->nom ?? 'Inconnu' }}</span> & {{ $enseignant['nom'] }}
                </div>
            </div>
        </div>
        <div class="row g-0">
            <div class="col-md-1">
            <div class="col-md-1">
    <img class="rounded-circle shadow-1-strong m-3" 
         src="{{ isset($users[$requete->user_id]['photo_profil']) && $users[$requete->user_id]['photo_profil'] ? asset('storage/photo_profil/' . $users[$requete->user_id]['photo_profil']) : asset('/1.png') }}" 
         alt="avatar" width="90" height="90" 
         onerror="this.src='{{ asset('/1.png') }}'" />
</div>            </div>
            <div class="col-md-11">
                <div class="card-body">
                    <h5 class="card-title">{{ $requete->nom }}</h5>
                    <p class="card-text">{{ $requete->description }}</p>
                    <p class="card-text"><small class="text-muted">Envoyé le {{ date('d/m/Y H:i:s', strtotime($requete->updated_at)) }}</small></p>
                </div>
            </div>
        </div>
    </div>
    

   @if($reponses == null)
    <h5>Aucune réponse</h5>
@else
    @foreach($reponses as $reponse)
        @php
            $isMe = auth()->id() === $reponse->user_id;
            $parentResponse = $reponse->parent; // Utilise la relation préchargée
        @endphp

        <div class="d-flex {{ $isMe ? 'justify-content-end' : 'justify-content-start' }} mb-3" style="border-radius: 1rem; padding: 10px;" id="{{ $reponse->slug }}">
            @if(!$isMe)
    <img class="rounded-circle shadow-1-strong me-2" 
         src="{{ isset($users[$reponse->user_id]['photo_profil']) && $users[$reponse->user_id]['photo_profil'] ? asset('storage/photo_profil/' . $users[$reponse->user_id]['photo_profil']) : asset('/1.png') }}" 
         alt="avatar" width="40" height="40" 
         onerror="this.src='{{ asset('/1.png') }}'" />
@endif

            <div class="p-3 rounded text-wrap" style="word-break: break-word; max-width: 60%; background-color: {{ $isMe ? '#d1e7dd' : '#f8f9fa' }}; box-shadow: 0 2px 6px rgba(0,0,0,0.05); overflow-wrap: break-word;">
                <!-- Afficher la référence au message parent si existant -->
                @if($parentResponse)
                    <div style="padding: 5px; background-color: #f1f1f1; border-left: 4px solid #007bff; margin-bottom: 10px;">
                        <small class="text-muted">Réponse à :</small>
                        <p class="mb-0" style="white-space: pre-line;">{{ Str::limit($parentResponse->description, 50) }}</p>
                        <small><a href="#{{ $parentResponse->slug }}" class="text-primary">Voir le message original</a></small>
                    </div>
                @endif

                <div class="mb-2">
                    <strong>@ {{ $users[$reponse->user_id]['nom'] }}</strong><br>
                    <small class="text-muted">{{ date('d/m/Y H:i:s', strtotime($reponse->updated_at)) }}</small>
                </div>
                <p class="mb-1 m-0" style="white-space: pre-line;">{{ $reponse->description }}</p>
                <a href="#form" class="btn btn-sm btn-link text-primary p-0 me-2" onclick="Reply(this)" data-element="{{ $reponse->slug }}" data-value="{{ Str::limit($reponse->description, 50) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="indigo" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12z"/>
                        <path d="M2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    Répondre
                </a>
                @if($isMe)
                    <div class="d-inline-flex align-items-center">
                        <a href="javascript:void(0)" class="btn btn-sm btn-link text-warning p-0 me-2" onclick="prepareEdit('{{ $reponse->id }}', '{{ $reponse->description }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                        </a>
                        <form action="{{ route('reponse.delete', $reponse->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette réponse ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 5v6a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5.5zm-5-3A.5.5 0 0 1 5 2h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h1.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
@endif

    <section style="background-color: #eee;" id="form">
    <div class="container my-5 py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <div class="card">
                    <div class="card-body py-3 border-0" style="background-color: #f8f9fa;">
                        <form action="/forum-response" method="post" id="responseForm">
                            @csrf
                            <input type="text" class="d-none" name="parent_id" id="parent_id">
                            <input type="text" class="d-none" name="requete_slug" id="requete_slug" value="{{ $requete->slug }}">
                            <input type="text" class="d-none" name="response_id" id="response_id">

                            <div id="replyCitation" style="display: none; padding: 10px; background-color: #f1f1f1; border-left: 4px solid #007bff; margin-bottom: 10px;">
                                <p id="replyText" class="mb-0"></p>
                                <small><a href="#" id="replyLink" class="text-primary"></a></small>
                            </div>

                            <div class="form-outline w-100">
                                <textarea class="form-control" required='required' name="description" id="description" rows="4" style="background: #fff;"></textarea>
                                <label class="form-label" for="description">Description</label>
                            </div>
                            <div class="d-flex justify-content-end mt-2 pb-2">
                                <button type="submit" class="btn btn-primary btn-sm fw-bold me-4">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<script>
function Reply(elm) {
    var parent_id = document.getElementById('parent_id');
    var texteraReply = document.getElementById('description');
    var replyCitation = document.getElementById('replyCitation');
    var replyText = document.getElementById('replyText');
    var replyLink = document.getElementById('replyLink');
    
    var reply = $(elm).data('element');
    var descripReply = $(elm).data('value');

    parent_id.value = reply;
    replyText.textContent = descripReply;
    replyLink.href = '#' + reply;
    replyLink.textContent = 'Voir le message original';
    replyCitation.style.display = 'block';
    texteraReply.value = '';
}

function prepareEdit(responseId, description) {
    document.getElementById('response_id').value = responseId;
    document.getElementById('description').value = description;
    document.getElementById('responseForm').action = '/forum-response';
    document.getElementById('responseForm').method = 'POST';
    document.getElementById('responseForm').scrollIntoView({ behavior: 'smooth' });
}
// Ajout de l'effet de surbrillance
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault(); // Empêche le comportement par défaut du lien
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    targetElement.classList.add('highlight-message');
                    targetElement.scrollIntoView({ behavior: 'smooth' });

                    // Supprime la classe après 3 secondes
                    setTimeout(() => {
                        targetElement.classList.remove('highlight-message');
                    }, 3000);
                }
            });
        });
    });

document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne le dernier message (dernier .d-flex du fil de discussion)
    var messages = document.querySelectorAll('.d-flex.mb-3');
    if (messages.length > 0) {
        messages[messages.length - 1].scrollIntoView({ behavior: 'smooth' });
    } else {
        // Sinon, scroll jusqu'au formulaire de réponse
        var form = document.getElementById('form');
        if (form) {
            form.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
</script>

<style>
.card {
    border-radius: 1rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}
    .highlight-message {
        animation: highlight 3s ease-out;
        border: 2px solid #007bff; /* Bordure bleue pour l'effet */
        border-radius: 0.5rem;
        background-color: #e6f3ff; /* Fond clair pour plus de visibilité */
    }

    @keyframes highlight {
        0% { border-color: #007bff; background-color: #e6f3ff; }
        100% { border-color: transparent; background-color: transparent; }
    }
</style>
@endsection