@extends("Apprenant.app")
@section("content")

<div class="container">
    <h5 class="text-center mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#015a98" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z"/>
            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
        </svg>
        Toutes les formations auxquelles vous vous êtes inscrit.e
        <div class="bg-primary row align-self-center col-12 mr-3 ml-3" style="height: 2px"></div>
    </h5>
</div>

<div class="content-wrapper">
    @if($userfmt == null)
        <div class="text-center">
            <img src="{{ asset('no-formation.svg') }}" alt="" height="250px"><br><br>
            <h4 style="color:#015a98">Aucune formation</h4>
        </div>
    @else
        <section class="container my-5" style="min-height: 63vh">
            <div class="row">
                @foreach($formations as $index => $formation)
                    <div class="col-12 col-sm-6 col-md-3 mb-4">
                        <div class="card shadow-lg p-2 bg-white rounded h-100">
                            <a href="/apprenant-suivi/{{ $formation->slug }}" class="text-decoration-none">
                                <div class="card-body" style="height: 400px; overflow: hidden;">
                                    <p class="card-text mb-4">
                                        <span style="font-size: 12px; float: right; font-weight: 600; font-family: Source Sans Pro, Arial, sans-serif; width: fit-content; text-decoration: none; color: black; 
                                            @if($status[$index] == 'Inscrire')
                                                background-color: #ffd700;
                                            @elseif($status[$index] == 'En cours')
                                                background-color: #90EE90;
                                            @elseif($status[$index] == 'Terminer')
                                                background-color: #87CEEB;
                                            @endif
                                            border-radius: 10px; padding: 0px 15px; vertical-align: middle;">
                                            Statut: {{ $status[$index] }}
                                        </span>
                                    </p>
                                    <a href="/apprenant-suivi/{{ $formation->slug }}">
                                        <img src="{{ asset($formation->image_url) }}" class="card-img-top image-card mx-auto d-block" style="width: 100%; height: 150px; object-fit: cover;">
                                    </a>
                                    <hr>
                                    <h5 style="color: black; font-family: inherit; text-align: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="indigo" class="bi bi-calendar" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg>
                                        Durée: {{ $formation->duree }}
                                    </h5>
                                    <h5 style="text-align: center;">{{ $formation->titre }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>

<script>
$(document).ready(function() {
    $('.btn-inscription').click(function(e) {
        e.preventDefault();
        var formationId = $(this).data('id');
        
        $.ajax({
            url: "{{ url('/inscription-formation') }}",
            type: 'POST',
            data: {
                id: formationId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Afficher un message de succès
                    Swal.fire({
                        title: 'Succès!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = response.redirect;
                        }
                    });
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    // Utilisateur non connecté
                    Swal.fire({
                        title: 'Connexion requise',
                        text: 'Veuillez vous connecter ou vous inscrire pour accéder aux cours',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Se connecter',
                        cancelButtonText: 'S\'inscrire'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('login') }}";
                        } else {
                            window.location.href = "{{ route('register') }}";
                        }
                    });
                } else {
                    // Autre erreur
                    Swal.fire({
                        title: 'Erreur!',
                        text: 'Une erreur est survenue',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
});
</script>

@endsection 