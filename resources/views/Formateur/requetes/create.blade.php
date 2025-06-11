@extends("Formateur.app")
@section("content")


<div class="container mt-4">
    <?php
$i = 0;
$rand = random_int(100, 900);
?>
@if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade in custom-toast" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <i class="bx bx-bell me-2"></i>
        <strong>Annonce</strong> - {{ session()->get('message') }}
    </div>
@endif
    <h3 class="text-center mb-4 text-primary" style="font-weight: bold;">Mes messages envoyés à l'administration</h3>
    <button type="button" class="btn btn-primary btn-lg mb-3 custom-btn" onclick="toggleForm('formMessage')">
        <i class="bx bx-plus me-2"></i> Nouvelle requête
    </button>

    <form action="{{ route('formateur.messages.destroy') }}" method="POST" class="mb-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" id="supb" style="display: none;">
            <i class="bx bx-trash me-2"></i> <span id="sup"></span>
        </button>
        <input type="hidden" name="total_checked" id="total_checked">
    </form>

    <p class="text-warning mb-3" id="alerte"></p>

    @if(empty($requetes) || count($requetes) == 0)
        <div class="text-center py-5">
            <h5 class="text-muted">Aucune requête envoyée pour le moment.</h5>
        </div>
    @else
        <div class="row">
            @foreach($requetes as $requete)
                <div class="col-xs-12 mb-3">
                    <div class="panel panel-default custom-card">
                        <div class="panel-body p-3">
                            <div class="row">
                                <div class="col-xs-1 text-center">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="check" data-element="{{ $requete->id }}" onclick="checkOnce(this)">
                                    </label>
                                </div>
                                <div class="col-xs-3">
                                    <h5 class="panel-title">
                                        <a href="{{ route('formateur.messages.show', $rand . '-' . $requete->titre) }}" class="text-decoration-none text-dark">
                                            {{ $requete->titre }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-0">Envoyée à <strong>Administrateur</strong></p>
                                </div>
                                <div class="col-xs-4">
                                    @if(count($reponse[$requete->id]) == 0)
                                        <p class="text-muted small mb-0">Aucun message</p>
                                    @else
                                        <p class="text-muted small mb-0">
                                            {{ count($reponse[$requete->id]) }} Message(s)
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-4 text-right">
                                    @if(count($reponse[$requete->id]) > 0)
                                        <p class="text-muted small mb-0">
                                            Dernière réponse : {{ date('d/m/Y H:i:s', strtotime($reponse[$requete->id][count($reponse[$requete->id]) - 1]['updated_at'])) }}
                                            par <strong>{{ $users[$reponse[$requete->id][count($reponse[$requete->id]) - 1]['user_id']]->nom }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary btn-lg mt-3 custom-btn" onclick="toggleForm('formMessage')">
            <i class="bx bx-plus me-2"></i> Nouvelle requête
        </button>
    @endif
</div>

<div class="container mt-4" id="formMessage" style="display: none;">
    <div class="panel panel-primary custom-card">
        <div class="panel-heading">
            <h5 class="panel-title mb-0">Nouvelle requête</h5>
        </div>
        <div class="panel-body">
            <form action="{{ route('formateur.messages.store') }}" method="post" id="form">
                @csrf
                <div class="form-group">
                    <label for="titre">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                    <span class="help-block text-danger" style="display: none;" id="titre-error">Veuillez entrer un titre.</span>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                    <span class="help-block text-danger" style="display: none;" id="description-error">Veuillez entrer une description.</span>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <button type="button" class="btn btn-default" onclick="toggleForm('formMessage')">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Style pour les conteneurs de messages en ligne */
    .custom-card {
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        border-left: 4px solid #0d6efd; /* Bordure latérale pour un style messagerie */
    }
    .custom-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        background-color: #ffffff;
    }
    .panel-body {
        padding: 15px;
    }
    .panel-body .row {
        align-items: center;
    }
    .panel-title a {
        color: #333;
        font-weight: 500;
    }
    .panel-title a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }
    .text-muted {
        color: #6c757d !important;
    }

    /* Style pour les boutons */
    .custom-btn {
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .custom-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }
    .btn-danger {
        border-radius: 8px;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Style pour le toast */
    .custom-toast {
        opacity: 0;
        transition: opacity 0.5s ease;
        border-radius: 10px;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
    }
    .custom-toast.fade.in {
        opacity: 1;
    }
    .custom-toast strong {
        color: #155724;
    }

    /* Style pour le formulaire */
    .panel-primary .panel-heading {
        background-color: #0d6efd;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .panel-primary .panel-body {
        background-color: #ffffff;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .form-control {
        border-radius: 6px;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 5px rgba(13, 110, 253, 0.5);
    }
    .btn-primary, .btn-default {
        border-radius: 6px;
        padding: 8px 20px;
    }

    /* Responsivité */
    @media (max-width: 767px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
        .panel-body {
            padding: 10px;
        }
        .col-xs-3, .col-xs-4 {
            font-size: 14px;
        }
        .custom-btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Gestion des toasts (Bootstrap 3)
        $('.custom-toast').fadeIn(500).delay(5000).fadeOut(500);

        // Validation du formulaire
        $('#form').on('submit', function (e) {
            let isValid = true;
            const titre = $('#titre').val().trim();
            const description = $('#description').val().trim();

            if (!titre) {
                $('#titre-error').show();
                isValid = false;
            } else {
                $('#titre-error').hide();
            }

            if (!description) {
                $('#description-error').show();
                isValid = false;
            } else {
                $('#description-error').hide();
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });

    function toggleForm(elm) {
        const element = $('#' + elm);
        element.slideToggle(300);
    }

    let alerte = document.getElementById('alerte');
    let supText = document.getElementById('sup');
    let supButton = document.getElementById('supb');
    let totalChecked = document.getElementById('total_checked');
    let valChecked = [];

    function check() {
        let checks = document.getElementsByClassName('check');
        let allSup = document.getElementById('all_sup');

        valChecked = Array.from(checks).map((chk) => {
            chk.checked = allSup.checked;
            return chk.checked ? chk.dataset.element : null;
        }).filter(Boolean);

        updateCheckUI();
    }

    function checkOnce(checks) {
        let element = checks.dataset.element;
        if (checks.checked) {
            valChecked.push(element);
        } else {
            valChecked = valChecked.filter(val => val !== element);
        }
        updateCheckUI();
    }

    function updateCheckUI() {
        if (valChecked.length === 0) {
            alerte.style.display = 'none';
            supButton.style.display = 'none';
        } else {
            alerte.style.display = 'block';
            supButton.style.display = 'inline-block';
            alerte.textContent = `Vous avez sélectionné ${valChecked.length} message(s)`;
            supText.textContent = `Supprimer ${valChecked.length} message(s)`;
        }
        totalChecked.value = valChecked.join(',');
    }
</script>
@endsection