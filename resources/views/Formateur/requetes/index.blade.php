@extends('Formateur.app')

@section('content')
    <h3 class="text-center mt-2 pb-4">Requêtes des apprenants</h3>

    @if (session()->has('message'))
        <div class="m-3 bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Annonce</div>
                <small>A l'instant</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session()->get('message') }}
            </div>
        </div>
    @endif

    @if ($requetes->isEmpty())
        <div class="text-center">
            <img src="{{ asset('no-formation.svg') }}" alt="" height="250px"><br><br>
            <h4 style="color:#015a98">Aucune requête pour le moment</h4>
        </div>
    
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Apprenant</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Formation</th>
                    <th scope="col">Dernier Message</th>
                    <th scope="col">Réponses</th>
                    <
                </tr>
            </thead>
            <tbody>
                @foreach ($requetes as $requete)
                    <tr class="hoverable">
                        <td>{{ $users[$requete->user_id]->nom ?? 'Inconnu' }}</td>
                        <td>
                            <a href="{{ route('requete.show', $requete->slug) }}" style="text-decoration:none">
                                {{ $requete->nom }}
                            </a>
                        </td>
                        <td>{{ $formations_associees[$requete->id]->titre ?? 'N/A' }}</td>
                        <td>
                            @if ($reponse[$requete->id]->isNotEmpty())
                                {{ date('d/m/Y H:i:s', strtotime($reponse[$requete->id]->last()->updated_at)) }}
                                par <strong>{{ $users[$reponse[$requete->id]->last()->user_id]->nom ?? 'Inconnu' }}</strong>
                            @else
                                Aucun
                            @endif
                        </td>
                        <td>{{ $reponse[$requete->id]->count() }} Message(s)</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <style>
        .hoverable {
            transition: all 0.3s ease-in-out;
        }

        .hoverable:hover {
            background: linear-gradient(135deg,rgb(213, 214, 217),rgb(174, 181, 192));
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            border-radius: 4px;
        }
    </style>
    

    <script>
        function toggleReplyForm(id) {
            const form = document.getElementById('reply-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection