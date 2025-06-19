@extends("Apprenant.app")
@section("content")
<?php
$i = 0;
$rand = random_int(100, 900);
?>

@if (session()->has('message'))
<div class="container mt-4">
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Annonce :</strong> {{ session()->get('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
</div>
@endif

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary">Mes messages privés</h3>
        <button type="button" class="btn btn-primary" onclick="showForm('formMessage')">Nouveau message privé</button>
    </div>

    <form action="/requete" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-danger d-none" id="supb">
            <i class="bi bi-trash-fill"></i>
            <span id="sup"></span>
        </button>
        <input type="hidden" name="total_checked" id="total_checked">
    </form>

    <p id="alerte" class="text-info fw-bold"></p>

    @if(count($requetes) == 0)
        <div class="alert alert-warning text-center">Aucun message privé pour le moment.</div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th><input type="checkbox" id="all_sup" onclick="check()"></th>
                        <th>Nom</th>
                        <th>Messages</th>
                        <th>Dernier message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requetes as $requete)
                    <tr class="hoverable">
                        <td><input type="checkbox" class="check" data-element="{{ $requete->id }}" onclick="checkOnce(this)"></td>
                        <td>
                            <h5><a href="/requete/{{ $rand }}-{{ $requete->nom }}" class="text-decoration-none text-dark">{{ $requete->nom }}</a></h5>
                            <p class="text-muted">envoyé dans <strong></strong></p>
                        </td>
                        <td>
                            <h5>{{ count($reponse[$requete->id]) }} Message(s)</h5>
                        </td>
                        <td>
                            @if(count($reponse[$requete->id]) > 0)
                                <p class="text-muted">
                                    {{ date('d/m/Y H:i:s', strtotime($reponse[$requete->id][count($reponse[$requete->id])-1]['updated_at'])) }}
                                    par <strong>{{ $users[$reponse[$requete->id][count($reponse[$requete->id])-1]['user_id']]->nom }}</strong>
                                </p>
                            @else
                                <p class="text-muted">Aucun</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="card mt-4 d-none" id="formMessage">
        <div class="card-body">
            <h5 class="card-title">Nouveau message privé</h5>
            <form action="/apprenant-requete" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fmt_id" class="form-label">Formation</label>
                        <select name="fmt_id" id="fmt_id" class="form-select" required>
                            @foreach($formation_iscrt as $fmt)
                            <option value="{{ $fmt->id }}">{{ $fmt->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<style>
    .hoverable:hover {
        background-color: #f1f1f1;
        transition: 0.3s;
    }
</style>

<script>
    function showForm(elm) {
        let element = document.getElementById(elm);
        element.classList.toggle('d-none');
    }

    let alerte = document.getElementById('alerte');
    let supText = document.getElementById('sup');
    let supButton = document.getElementById('supb');
    let total_checked = document.getElementById('total_checked');
    let val_checked = [];

    function check() {
        let checks = document.getElementsByClassName('check');
        let element = document.getElementById('all_sup');
        val_checked = [];

        for (let i = 0; i < checks.length; i++) {
            checks[i].checked = element.checked;
            if (element.checked) {
                val_checked.push($(checks[i]).data('element'));
            }
        }

        updateAlert();
    }

    function checkOnce(checks) {
        let element = $(checks).data('element');
        if (checks.checked) {
            val_checked.push(element);
        } else {
            val_checked = val_checked.filter(val => val != element);
        }
        updateAlert();
    }

    function updateAlert() {
        total_checked.value = val_checked;
        if (val_checked.length === 0) {
            alerte.style.display = 'none';
            supButton.classList.add('d-none');
        } else {
            alerte.style.display = 'block';
            supButton.classList.remove('d-none');
            alerte.innerHTML = `<span style="font-weight: bold; color:rgb(0, 0, 0);">Vous avez sélectionné ${val_checked.length} message(s)</span>`;
            supText.innerHTML = `SUPPRIMER ${val_checked.length} MESSAGE(S)`;
        }
    }
</script>
@endsection
