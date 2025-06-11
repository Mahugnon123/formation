@extends("Admin.app")

@section("content")


<div class="container mt-4">
    <div class="card shadow-sm">
        <nav class="card-header bg-light text-primary" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item" id="actuelle">Accueil</li>
                <li class="breadcrumb-item" id="fmtsSee" style="display:none">
                    <a href="javascript:void(0);" onclick="formateur();">Formations</a>
                </li>
                <li class="breadcrumb-item" id="fmtSee" style="display:none">Formation</li>
            </ol>
        </nav>

        <div class="card-body">
            <p class="card-text text-muted">Consultez vos informations personnelles et gérez les utilisateurs.</p>

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3" id="nav-buttons">
                <div class="d-flex gap-2">
                    <button class="btn nav-btn" onclick="showSection('utilisateurs', this)">Utilisateurs</button>
                     <button id="tabFormateurs" class="btn nav-btn" onclick="showSection('formateurs', this)">Formateurs</button>

                    <button class="btn nav-btn" onclick="showSection('apprenants', this)">Apprenants</button>
                </div>
            
             
            </div>
            
            
        
            
            <div class="mt-4">
                <div id="utilisateurs" class="section mt-3">
                    <div class="card card-body">
                        @include('Admin.users')
                    </div>
                </div>

                <div id="formateurs" class="section mt-3" style="display: none;">
                    <div class="card card-body">
                        @include('Admin.formateur')
                    </div>
                </div>

                <div id="apprenants" class="section mt-3" style="display: none;">
                    <div class="card card-body">
                        @include('Admin.apprenant')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function showSection(id, btn) {
    // Masquer toutes les sections
    document.querySelectorAll('.section').forEach(el => el.style.display = 'none');

    // Afficher la bonne section
    document.getElementById(id).style.display = 'block';

    // Mettre à jour le fil d'Ariane
    document.getElementById('actuelle').innerText = btn.innerText;

    // Gérer les boutons actifs
    document.querySelectorAll('.nav-btn').forEach(el => el.classList.remove('active'));
    btn.classList.add('active');

    // Gérer l'affichage dynamique du bouton
    const navButtonsDiv = document.getElementById('nav-buttons');
    
    // Supprimer le bouton s'il existe déjà
    const existingBtn = document.getElementById('btn-create-formateur');
    if (existingBtn) {
        existingBtn.remove();
    }

    // Si on est dans la section formateurs, on crée le bouton
    if (id === 'formateurs') {
        const newBtn = document.createElement('button');
        newBtn.id = 'btn-create-formateur';
        newBtn.className = 'btn d-flex align-items-center';
        newBtn.style = 'border: 1px solid #d1e7ff; background-color: #ffffff; color: rgb(18, 70, 118); padding: 6px 12px; border-radius: 4px;';
        newBtn.setAttribute('data-toggle', 'modal');
        newBtn.setAttribute('data-target', '#signupModal');
        newBtn.innerHTML = '<i class="bx bx-plus me-2"></i> Créer un formateur';

        navButtonsDiv.appendChild(newBtn);
    }
}


document.getElementById('tabFormateurs').addEventListener('click', function() {
    // Affiche la section principale des formateurs
    document.getElementById('formateurs').style.display = 'block';
    // Masque toutes les sous-sections spécifiques si besoin
    document.querySelectorAll('.formations, .formation_user').forEach(el => el.style.display = 'none');
    // Optionnel : masque le bouton retour si affiché
    const retourBtn = document.getElementById('fmtsSee');
    if (retourBtn) retourBtn.style.display = 'none';
});

</script> 

<style>
 .nav-btn {
    background-color: #f8f9fa;
    color:rgb(35, 128, 227);
    border: none; /* supprime la bordure */
    border-radius: 5px;
    padding: 6px 12px;
    transition: all 0.3s ease;
    box-shadow: none;
}

.nav-btn.active,
.nav-btn:focus,
.nav-btn:active {
    background-color: #e7f1ff;
    color: #0056b3;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2); /* ombre bleue légère */
    outline: none;
}

.nav-btn:hover {
    background-color: #e7f1ff;
    color: #0056b3;
    box-shadow: 0 2px 6px rgba(0, 123, 255, 0.15); /* ombre légère au survol */
}

</style>
<!-- CSS DataTables et Buttons -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
@endsection