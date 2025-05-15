@extends("Formateur.app")
@section("content")

<?php
$link_info = ($user->link_info != null) ? json_decode($user->link_info, true) : [];
$site = ($user->link_info != null) ? $link_info["site"] : '';
$linkedIn = ($user->link_info != null) ? $link_info["linkedIn"] : '';
$facebook = ($user->link_info != null) ? $link_info["facebook"] : '';
?>

@if (session()->has('message'))
    <div class="alert alert-success alert-dismissable">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
@endif

@if (request()->get('success'))
    <div id="success-alert" class="alert alert-success alert-dismissable">
        Votre profil a été modifié avec succès.
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
    <script>
        setTimeout(function () {
            var alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>
@endif

<div class="m-3" style="background-color:#055d9b; height:100px;">
    <h4 class="text-center fw-bold mb-3" style="color:white">Informations Privées</h4>
    <h5 class="m-3" style="color:white">
        <a href="/home" class="text-decoration-none text-light">Accueil/</a>
        <span id="onglet"></span>
    </h5>
</div>

<div class="panel panel-default">
    <div class="panel-heading" style="color:#055d9b;" id="actuelle">PROFIL</div>
    <div class="panel-body">
        <p>Consulter vos informations personnelles et les modifier.</p>

        <div class="btn-group">
            <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" data-element="Profil" onclick="actuel(this)">Profil</a>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" data-element="Parametres" onclick="actuel(this)">Paramètres</button>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample4" data-element="Avis" onclick="actuel(this)">Avis</button>
        </div>

        <!-- Profil -->
        <div class="collapse" id="multiCollapseExample1">
            <div id="formUser" style="display:none;">
                <div class="panel panel-default">
                    <div class="panel-heading">Informations Personnelles</div>
                    <div class="panel-body">
                        <form action="javascript:void(0)" method="post">
                            @csrf
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-md-3">
                                        
                                        @if(Auth::user()->photo_profil)
                                            <img src="{{ asset('storage/photo_profil_formateur/' . Auth::user()->photo_profil) }}" id="photo_profile" alt="avatar" class="img-fluid" style="cursor: pointer;"onerror="this.src='{{ asset('assets/img/avatars/1.png') }}'">
                                        @else
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="avatar" class="img-fluid" style="cursor: pointer;">
                                        @endif
                                        <input class="hidden" type="file" accept=".png, .jpg, .jpeg" id="photo_image">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="pseudo">Pseudo</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" id="pseudo" class="form-control" value="{{ Auth::user()->pseudo }}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="a_propos">Mini Biographie</label>
                                            <textarea name="a_propos" id="a_propos" class="form-control" rows="4">{{ Auth::user()->a_propos }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>A propos de vous</h4>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="prenom">Prénom</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="prenom" class="form-control" value="{{ Auth::user()->prenom }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="nom">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="nom" class="form-control" value="{{ Auth::user()->nom }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="sex">Sexe</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <select name="sex" id="sex" class="form-control">
                                            <option value="F" {{ Auth::user()->sex == 'F' ? 'selected' : '' }}>Féminin</option>
                                            <option value="M" {{ Auth::user()->sex == 'M' ? 'selected' : '' }}>Masculin</option>
                                            <option value="A" {{ Auth::user()->sex == 'A' ? 'selected' : '' }}>Autres</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="birthday">Date de Naissance</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="date" id="birthday" class="form-control" value="{{ Auth::user()->birthday }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="pays">Pays</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                        <select name="pays" id="pays" class="form-control">
                                            <option value="" disabled selected>Sélectionnez un pays</option>
                                                                <option value="Afghanistan" {{ Auth::user()->pays == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                                                <option value="Albanie" {{ Auth::user()->pays == 'Albanie' ? 'selected' : '' }}>Albanie</option>
                                                                <option value="Algérie" {{ Auth::user()->pays == 'Algérie' ? 'selected' : '' }}>Algérie</option>
                                                                <option value="Andorre" {{ Auth::user()->pays == 'Andorre' ? 'selected' : '' }}>Andorre</option>
                                                                <option value="Angola" {{ Auth::user()->pays == 'Angola' ? 'selected' : '' }}>Angola</option>
                                                                <option value="Antigua-et-Barbuda" {{ Auth::user()->pays == 'Antigua-et-Barbuda' ? 'selected' : '' }}>Antigua-et-Barbuda</option>
                                                                <option value="Argentine" {{ Auth::user()->pays == 'Argentine' ? 'selected' : '' }}>Argentine</option>
                                                                <option value="Arménie" {{ Auth::user()->pays == 'Arménie' ? 'selected' : '' }}>Arménie</option>
                                                                <option value="Australie" {{ Auth::user()->pays == 'Australie' ? 'selected' : '' }}>Australie</option>
                                                                <option value="Autriche" {{ Auth::user()->pays == 'Autriche' ? 'selected' : '' }}>Autriche</option>
                                                                <option value="Azerbaïdjan" {{ Auth::user()->pays == 'Azerbaïdjan' ? 'selected' : '' }}>Azerbaïdjan</option>
                                                                <option value="Bahamas" {{ Auth::user()->pays == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                                                <option value="Bahreïn" {{ Auth::user()->pays == 'Bahreïn' ? 'selected' : '' }}>Bahreïn</option>
                                                                <option value="Bangladesh" {{ Auth::user()->pays == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                                                <option value="Barbade" {{ Auth::user()->pays == 'Barbade' ? 'selected' : '' }}>Barbade</option>
                                                                <option value="Biélorussie" {{ Auth::user()->pays == 'Biélorussie' ? 'selected' : '' }}>Biélorussie</option>
                                                                <option value="Belgique" {{ Auth::user()->pays == 'Belgique' ? 'selected' : '' }}>Belgique</option>
                                                                <option value="Belize" {{ Auth::user()->pays == 'Belize' ? 'selected' : '' }}>Belize</option>
                                                                <option value="Bénin" {{ Auth::user()->pays == 'Bénin' ? 'selected' : '' }}>Bénin</option>
                                                                <option value="Bhoutan" {{ Auth::user()->pays == 'Bhoutan' ? 'selected' : '' }}>Bhoutan</option>
                                                                <option value="Bolivie" {{ Auth::user()->pays == 'Bolivie' ? 'selected' : '' }}>Bolivie</option>
                                                                <option value="Bosnie-Herzégovine" {{ Auth::user()->pays == 'Bosnie-Herzégovine' ? 'selected' : '' }}>Bosnie-Herzégovine</option>
                                                                <option value="Botswana" {{ Auth::user()->pays == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                                                <option value="Brésil" {{ Auth::user()->pays == 'Brésil' ? 'selected' : '' }}>Brésil</option>
                                                                <option value="Brunei" {{ Auth::user()->pays == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                                                <option value="Bulgarie" {{ Auth::user()->pays == 'Bulgarie' ? 'selected' : '' }}>Bulgarie</option>
                                                                <option value="Burkina Faso" {{ Auth::user()->pays == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                                                <option value="Burundi" {{ Auth::user()->pays == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                                                <option value="Cambodge" {{ Auth::user()->pays == 'Cambodge' ? 'selected' : '' }}>Cambodge</option>
                                                                <option value="Cameroun" {{ Auth::user()->pays == 'Cameroun' ? 'selected' : '' }}>Cameroun</option>
                                                                <option value="Canada" {{ Auth::user()->pays == 'Canada' ? 'selected' : '' }}>Canada</option>
                                                                <option value="Cap-Vert" {{ Auth::user()->pays == 'Cap-Vert' ? 'selected' : '' }}>Cap-Vert</option>
                                                                <option value="République centrafricaine" {{ Auth::user()->pays == 'République centrafricaine' ? 'selected' : '' }}>République centrafricaine</option>
                                                                <option value="Tchad" {{ Auth::user()->pays == 'Tchad' ? 'selected' : '' }}>Tchad</option>
                                                                <option value="Chili" {{ Auth::user()->pays == 'Chili' ? 'selected' : '' }}>Chili</option>
                                                                <option value="Chine" {{ Auth::user()->pays == 'Chine' ? 'selected' : '' }}>Chine</option>
                                                                <option value="Colombie" {{ Auth::user()->pays == 'Colombie' ? 'selected' : '' }}>Colombie</option>
                                                                <option value="Comores" {{ Auth::user()->pays == 'Comores' ? 'selected' : '' }}>Comores</option>
                                                                <option value="République démocratique du Congo" {{ Auth::user()->pays == 'République démocratique du Congo' ? 'selected' : '' }}>République démocratique du Congo</option>
                                                                <option value="République du Congo" {{ Auth::user()->pays == 'République du Congo' ? 'selected' : '' }}>République du Congo</option>
                                                                <option value="Costa Rica" {{ Auth::user()->pays == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                                                <option value="Côte d'Ivoire" {{ Auth::user()->pays == 'Côte d\'Ivoire' ? 'selected' : '' }}>Côte d'Ivoire</option>
                                                                <option value="Croatie" {{ Auth::user()->pays == 'Croatie' ? 'selected' : '' }}>Croatie</option>
                                                                <option value="Cuba" {{ Auth::user()->pays == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                                                <option value="Chypre" {{ Auth::user()->pays == 'Chypre' ? 'selected' : '' }}>Chypre</option>
                                                                <option value="Tchéquie" {{ Auth::user()->pays == 'Tchéquie' ? 'selected' : '' }}>Tchéquie</option>
                                                                <option value="Danemark" {{ Auth::user()->pays == 'Danemark' ? 'selected' : '' }}>Danemark</option>
                                                                <option value="Djibouti" {{ Auth::user()->pays == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                                                <option value="Dominique" {{ Auth::user()->pays == 'Dominique' ? 'selected' : '' }}>Dominique</option>
                                                                <option value="République dominicaine" {{ Auth::user()->pays == 'République dominicaine' ? 'selected' : '' }}>République dominicaine</option>
                                                                <option value="Équateur" {{ Auth::user()->pays == 'Équateur' ? 'selected' : '' }}>Équateur</option>
                                                                <option value="Égypte" {{ Auth::user()->pays == 'Égypte' ? 'selected' : '' }}>Égypte</option>
                                                                <option value="Salvador" {{ Auth::user()->pays == 'Salvador' ? 'selected' : '' }}>Salvador</option>
                                                                <option value="Guinée équatoriale" {{ Auth::user()->pays == 'Guinée équatoriale' ? 'selected' : '' }}>Guinée équatoriale</option>
                                                                <option value="Érythrée" {{ Auth::user()->pays == 'Érythrée' ? 'selected' : '' }}>Érythrée</option>
                                                                <option value="Estonie" {{ Auth::user()->pays == 'Estonie' ? 'selected' : '' }}>Estonie</option>
                                                                <option value="Eswatini" {{ Auth::user()->pays == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                                                                <option value="Éthiopie" {{ Auth::user()->pays == 'Éthiopie' ? 'selected' : '' }}>Éthiopie</option>
                                                                <option value="Fidji" {{ Auth::user()->pays == 'Fidji' ? 'selected' : '' }}>Fidji</option>
                                                                <option value="Finlande" {{ Auth::user()->pays == 'Finlande' ? 'selected' : '' }}>Finlande</option>
                                                                <option value="France" {{ Auth::user()->pays == 'France' ? 'selected' : '' }}>France</option>
                                                                <option value="Gabon" {{ Auth::user()->pays == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                                                                <option value="Gambie" {{ Auth::user()->pays == 'Gambie' ? 'selected' : '' }}>Gambie</option>
                                                                <option value="Géorgie" {{ Auth::user()->pays == 'Géorgie' ? 'selected' : '' }}>Géorgie</option>
                                                                <option value="Allemagne" {{ Auth::user()->pays == 'Allemagne' ? 'selected' : '' }}>Allemagne</option>
                                                                <option value="Ghana" {{ Auth::user()->pays == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                                                <option value="Grèce" {{ Auth::user()->pays == 'Grèce' ? 'selected' : '' }}>Grèce</option>
                                                                <option value="Grenade" {{ Auth::user()->pays == 'Grenade' ? 'selected' : '' }}>Grenade</option>
                                                                <option value="Guatemala" {{ Auth::user()->pays == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                                                                <option value="Guinée" {{ Auth::user()->pays == 'Guinée' ? 'selected' : '' }}>Guinée</option>
                                                                <option value="Guinée-Bissau" {{ Auth::user()->pays == 'Guinée-Bissau' ? 'selected' : '' }}>Guinée-Bissau</option>
                                                                <option value="Guyana" {{ Auth::user()->pays == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                                                                <option value="Haïti" {{ Auth::user()->pays == 'Haïti' ? 'selected' : '' }}>Haïti</option>
                                                                <option value="Honduras" {{ Auth::user()->pays == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                                                <option value="Hongrie" {{ Auth::user()->pays == 'Hongrie' ? 'selected' : '' }}>Hongrie</option>
                                                                <option value="Islande" {{ Auth::user()->pays == 'Islande' ? 'selected' : '' }}>Islande</option>
                                                                <option value="Inde" {{ Auth::user()->pays == 'Inde' ? 'selected' : '' }}>Inde</option>
                                                                <option value="Indonésie" {{ Auth::user()->pays == 'Indonésie' ? 'selected' : '' }}>Indonésie</option>
                                                                <option value="Iran" {{ Auth::user()->pays == 'Iran' ? 'selected' : '' }}>Iran</option>
                                                                <option value="Irak" {{ Auth::user()->pays == 'Irak' ? 'selected' : '' }}>Irak</option>
                                                                <option value="Irlande" {{ Auth::user()->pays == 'Irlande' ? 'selected' : '' }}>Irlande</option>
                                                                <option value="Israël" {{ Auth::user()->pays == 'Israël' ? 'selected' : '' }}>Israël</option>
                                                                <option value="Italie" {{ Auth::user()->pays == 'Italie' ? 'selected' : '' }}>Italie</option>
                                                                <option value="Jamaïque" {{ Auth::user()->pays == 'Jamaïque' ? 'selected' : '' }}>Jamaïque</option>
                                                                <option value="Japon" {{ Auth::user()->pays == 'Japon' ? 'selected' : '' }}>Japon</option>
                                                                <option value="Jordanie" {{ Auth::user()->pays == 'Jordanie' ? 'selected' : '' }}>Jordanie</option>
                                                                <option value="Kazakhstan" {{ Auth::user()->pays == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                                                <option value="Kenya" {{ Auth::user()->pays == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                                                <option value="Kiribati" {{ Auth::user()->pays == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                                                                <option value="Koweït" {{ Auth::user()->pays == 'Koweït' ? 'selected' : '' }}>Koweït</option>
                                                                <option value="Kirghizistan" {{ Auth::user()->pays == 'Kirghizistan' ? 'selected' : '' }}>Kirghizistan</option>
                                                                <option value="Laos" {{ Auth::user()->pays == 'Laos' ? 'selected' : '' }}>Laos</option>
                                                                <option value="Lettonie" {{ Auth::user()->pays == 'Lettonie' ? 'selected' : '' }}>Lettonie</option>
                                                                <option value="Liban" {{ Auth::user()->pays == 'Liban' ? 'selected' : '' }}>Liban</option>
                                                                <option value="Lesotho" {{ Auth::user()->pays == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                                                                <option value="Liberia" {{ Auth::user()->pays == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                                                <option value="Libye" {{ Auth::user()->pays == 'Libye' ? 'selected' : '' }}>Libye</option>
                                                                <option value="Liechtenstein" {{ Auth::user()->pays == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                                                                <option value="Lituanie" {{ Auth::user()->pays == 'Lituanie' ? 'selected' : '' }}>Lituanie</option>
                                                                <option value="Luxembourg" {{ Auth::user()->pays == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                                                <option value="Madagascar" {{ Auth::user()->pays == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                                                <option value="Malawi" {{ Auth::user()->pays == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                                                                <option value="Malaisie" {{ Auth::user()->pays == 'Malaisie' ? 'selected' : '' }}>Malaisie</option>
                                                                <option value="Maldives" {{ Auth::user()->pays == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                                                <option value="Mali" {{ Auth::user()->pays == 'Mali' ? 'selected' : '' }}>Mali</option>
                                                                <option value="Malte" {{ Auth::user()->pays == 'Malte' ? 'selected' : '' }}>Malte</option>
                                                                <option value="Îles Marshall" {{ Auth::user()->pays == 'Îles Marshall' ? 'selected' : '' }}>Îles Marshall</option>
                                                                <option value="Mauritanie" {{ Auth::user()->pays == 'Mauritanie' ? 'selected' : '' }}>Mauritanie</option>
                                                                <option value="Maurice" {{ Auth::user()->pays == 'Maurice' ? 'selected' : '' }}>Maurice</option>
                                                                <option value="Mexique" {{ Auth::user()->pays == 'Mexique' ? 'selected' : '' }}>Mexique</option>
                                                                <option value="Micronésie" {{ Auth::user()->pays == 'Micronésie' ? 'selected' : '' }}>Micronésie</option>
                                                                <option value="Moldavie" {{ Auth::user()->pays == 'Moldavie' ? 'selected' : '' }}>Moldavie</option>
                                                                <option value="Monaco" {{ Auth::user()->pays == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                                                <option value="Mongolie" {{ Auth::user()->pays == 'Mongolie' ? 'selected' : '' }}>Mongolie</option>
                                                                <option value="Monténégro" {{ Auth::user()->pays == 'Monténégro' ? 'selected' : '' }}>Monténégro</option>
                                                                <option value="Maroc" {{ Auth::user()->pays == 'Maroc' ? 'selected' : '' }}>Maroc</option>
                                                                <option value="Mozambique" {{ Auth::user()->pays=='Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                                                <option value="Myanmar" {{ Auth::user()->pays == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                                                <option value="Namibie" {{ Auth::user()->pays == 'Namibie' ? 'selected' : '' }}>Namibie</option>
                                                                <option value="Nauru" {{ Auth::user()->pays == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                                                                <option value="Népal" {{ Auth::user()->pays == 'Népal' ? 'selected' : '' }}>Népal</option>
                                                                <option value="Pays-Bas" {{ Auth::user()->pays == 'Pays-Bas' ? 'selected' : '' }}>Pays-Bas</option>
                                                                <option value="Nouvelle-Zélande" {{ Auth::user()->pays == 'Nouvelle-Zélande' ? 'selected' : '' }}>Nouvelle-Zélande</option>
                                                                <option value="Nicaragua" {{ Auth::user()->pays == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                                                <option value="Niger" {{ Auth::user()->pays == 'Niger' ? 'selected' : '' }}>Niger</option>
                                                                <option value="Nigeria" {{ Auth::user()->pays == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                                                <option value="Macédoine du Nord" {{ Auth::user()->pays == 'Macédoine du Nord' ? 'selected' : '' }}>Macédoine du Nord</option>
                                                                <option value="Norvège" {{ Auth::user()->pays == 'Norvège' ? 'selected' : '' }}>Norvège</option>
                                                                <option value="Oman" {{ Auth::user()->pays == 'Oman' ? 'selected' : '' }}>Oman</option>
                                                                <option value="Pakistan" {{ Auth::user()->pays == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                                                <option value="Palaos" {{ Auth::user()->pays == 'Palaos' ? 'selected' : '' }}>Palaos</option>
                                                                <option value="Panama" {{ Auth::user()->pays == 'Panama' ? 'selected' : '' }}>Panama</option>
                                                                <option value="Papouasie-Nouvelle-Guinée" {{ Auth::user()->pays == 'Papouasie-Nouvelle-Guinée' ? 'selected' : '' }}>Papouasie-Nouvelle-Guinée</option>
                                                                <option value="Paraguay" {{ Auth::user()->pays == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                                                                <option value="Pérou" {{ Auth::user()->pays == 'Pérou' ? 'selected' : '' }}>Pérou</option>
                                                                <option value="Philippines" {{ Auth::user()->pays == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                                                <option value="Pologne" {{ Auth::user()->pays == 'Pologne' ? 'selected' : '' }}>Pologne</option>
                                                                <option value="Portugal" {{ Auth::user()->pays == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                                                <option value="Qatar" {{ Auth::user()->pays == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                                                <option value="Roumanie" {{ Auth::user()->pays == 'Roumanie' ? 'selected' : '' }}>Roumanie</option>
                                                                <option value="Russie" {{ Auth::user()->pays == 'Russie' ? 'selected' : '' }}>Russie</option>
                                                                <option value="Rwanda" {{ Auth::user()->pays == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                                                <option value="Saint-Kitts-et-Nevis" {{ Auth::user()->pays == 'Saint-Kitts-et-Nevis' ? 'selected' : '' }}>Saint-Kitts-et-Nevis</option>
                                                                <option value="Sainte-Lucie" {{ Auth::user()->pays == 'Sainte-Lucie' ? 'selected' : '' }}>Sainte-Lucie</option>
                                                                <option value="Saint-Vincent-et-les-Grenadines" {{ Auth::user()->pays == 'Saint-Vincent-et-les-Grenadines' ? 'selected' : '' }}>Saint-Vincent-et-les-Grenadines</option>
                                                                <option value="Samoa" {{ Auth::user()->pays == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                                                                <option value="Saint-Marin" {{ Auth::user()->pays == 'Saint-Marin' ? 'selected' : '' }}>Saint-Marin</option>
                                                                <option value="Sao Tomé-et-Principe" {{ Auth::user()->pays == 'Sao Tomé-et-Principe' ? 'selected' : '' }}>Sao Tomé-et-Principe</option>
                                                                <option value="Arabie saoudite" {{ Auth::user()->pays == 'Arabie saoudite' ? 'selected' : '' }}>Arabie saoudite</option>
                                                                <option value="Sénégal" {{ Auth::user()->pays == 'Sénégal' ? 'selected' : '' }}>Sénégal</option>
                                                                <option value="Serbie" {{ Auth::user()->pays == 'Serbie' ? 'selected' : '' }}>Serbie</option>
                                                                <option value="Seychelles" {{ Auth::user()->pays == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                                                <option value="Sierra Leone" {{ Auth::user()->pays == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                                                <option value="Singapour" {{ Auth::user()->pays == 'Singapour' ? 'selected' : '' }}>Singapour</option>
                                                                <option value="Slovaquie" {{ Auth::user()->pays == 'Slovaquie' ? 'selected' : '' }}>Slovaquie</option>
                                                                <option value="Slovénie" {{ Auth::user()->pays == 'Slovénie' ? 'selected' : '' }}>Slovénie</option>
                                                                <option value="Îles Salomon" {{ Auth::user()->pays == 'Îles Salomon' ? 'selected' : '' }}>Îles Salomon</option>
                                                                <option value="Somalie" {{ Auth::user()->pays == 'Somalie' ? 'selected' : '' }}>Somalie</option>
                                                                <option value="Afrique du Sud" {{ Auth::user()->pays == 'Afrique du Sud' ? 'selected' : '' }}>Afrique du Sud</option>
                                                                <option value="Corée du Sud" {{ Auth::user()->pays == 'Corée du Sud' ? 'selected' : '' }}>Corée du Sud</option>
                                                                <option value="Soudan du Sud" {{ Auth::user()->pays == 'Soudan du Sud' ? 'selected' : '' }}>Soudan du Sud</option>
                                                                <option value="Espagne" {{ Auth::user()->pays == 'Espagne' ? 'selected' : '' }}>Espagne</option>
                                                                <option value="Sri Lanka" {{ Auth::user()->pays == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                                                <option value="Soudan" {{ Auth::user()->pays == 'Soudan' ? 'selected' : '' }}>Soudan</option>
                                                                <option value="Suriname" {{ Auth::user()->pays == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                                                                <option value="Suède" {{ Auth::user()->pays == 'Suède' ? 'selected' : '' }}>Suède</option>
                                                                <option value="Suisse" {{ Auth::user()->pays == 'Suisse' ? 'selected' : '' }}>Suisse</option>
                                                                <option value="Syrie" {{ Auth::user()->pays == 'Syrie' ? 'selected' : '' }}>Syrie</option>
                                                                <option value="Taïwan" {{ Auth::user()->pays == 'Taïwan' ? 'selected' : '' }}>Taïwan</option>
                                                                <option value="Tadjikistan" {{ Auth::user()->pays == 'Tadjikistan' ? 'selected' : '' }}>Tadjikistan</option>
                                                                <option value="Tanzanie" {{ Auth::user()->pays == 'Tanzanie' ? 'selected' : '' }}>Tanzanie</option>
                                                                <option value="Thaïlande" {{ Auth::user()->pays == 'Thaïlande' ? 'selected' : '' }}>Thaïlande</option>
                                                                <option value="Timor oriental" {{ Auth::user()->pays == 'Timor oriental' ? 'selected' : '' }}>Timor oriental</option>
                                                                <option value="Togo" {{ Auth::user()->pays == 'Togo' ? 'selected' : '' }}>Togo</option>
                                                                <option value="Tonga" {{ Auth::user()->pays == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                                                                <option value="Trinité-et-Tobago" {{ Auth::user()->pays == 'Trinité-et-Tobago' ? 'selected' : '' }}>Trinité-et-Tobago</option>
                                                                <option value="Tunisie" {{ Auth::user()->pays == 'Tunisie' ? 'selected' : '' }}>Tunisie</option>
                                                                <option value="Turquie" {{ Auth::user()->pays == 'Turquie' ? 'selected' : '' }}>Turquie</option>
                                                                <option value="Turkménistan" {{ Auth::user()->pays == 'Turkménistan' ? 'selected' : '' }}>Turkménistan</option>
                                                                <option value="Tuvalu" {{ Auth::user()->pays == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                                                                <option value="Ouganda" {{ Auth::user()->pays == 'Ouganda' ? 'selected' : '' }}>Ouganda</option>
                                                                <option value="Ukraine" {{ Auth::user()->pays == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                                                <option value="Émirats arabes unis" {{ Auth::user()->pays == 'Émirats arabes unis' ? 'selected' : '' }}>Émirats arabes unis</option>
                                                                <option value="Royaume-Uni" {{ Auth::user()->pays == 'Royaume-Uni' ? 'selected' : '' }}>Royaume-Uni</option>
                                                                <option value="États-Unis" {{ Auth::user()->pays == 'États-Unis' ? 'selected' : '' }}>États-Unis</option>
                                                                <option value="Uruguay" {{ Auth::user()->pays == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                                                <option value="Ouzbékistan" {{ Auth::user()->pays == 'Ouzbékistan' ? 'selected' : '' }}>Ouzbékistan</option>
                                                                <option value="Vanuatu" {{ Auth::user()->pays == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                                                                <option value="Vatican" {{ Auth::user()->pays == 'Vatican' ? 'selected' : '' }}>Vatican</option>
                                                                <option value="Venezuela" {{ Auth::user()->pays == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                                                <option value="Viêt Nam" {{ Auth::user()->pays == 'Viêt Nam' ? 'selected' : '' }}>Viêt Nam</option>
                                                                <option value="Yémen" {{ Auth::user()->pays == 'Yémen' ? 'selected' : '' }}>Yémen</option>
                                                                <option value="Zambie" {{ Auth::user()->pays == 'Zambie' ? 'selected' : '' }}>Zambie</option>
                                                                <option value="Zimbabwe" {{ Auth::user()->pays == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                                                <option value="Palestine" {{ Auth::user()->pays == 'Palestine' ? 'selected' : '' }}>Palestine</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="phone">Téléphone</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="text" id="phone" class="form-control" value="{{ Auth::user()->contact }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="phone">Site Web</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                                        <input type="text" id="site" class="form-control" value="{{ $site }}" />
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="LinkedIn">LinkedIn</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                                        <input type="text" id="LinkedIn" class="form-control" value="{{ $linkedIn }}" />
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="Facebook">Facebook</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                                        <input type="text" id="Facebook" class="form-control" value="{{ $facebook }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="biographie">Biographie</label>
                                <textarea name="biographie" id="biographie" class="form-control" rows="10">{{ Auth::user()->biographie }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary updateProfil btn-block">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>

            <div id="userInfo">
                <button type="button" class="btn btn-info" onclick="modifier()">Modifier mon profil</button>
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-md-4">
    
    @if(Auth::user()->photo_profil)
        <img src="{{ asset('storage/photo_profil_formateur/' . Auth::user()->photo_profil) }}" alt="avatar" class="img-fluid" onerror="this.src='{{ asset('assets/img/avatars/1.png') }}'">
    @else
        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="avatar" class="img-fluid">
    @endif
</div>
                        <div class="col-md-8">
                            <div class="panel-body">
                                <h4>{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h4>
                                <h5>A propos de moi :</h5>
                                <p>{{ Auth::user()->a_propos }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Informations sur le compte</div>
                    <div class="panel-body">
                        <h5>Date d'inscription : {{ Auth::user()->created_at }}</h5>
                        <h5>Dernière connexion : {{ Auth::user()->last_connexion }}</h5>
                        <h5>Date de naissance : {{ Auth::user()->birthday }}</h5>
                        <h5>Sexe : {{ Auth::user()->sex }}</h5>
                        <h5>Pays : {{ Auth::user()->pays }}</h5>
                        <h5>Contact : {{ Auth::user()->contact }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paramètres -->
        <div class="collapse" id="multiCollapseExample2">
            <div class="panel panel-default">
                <div class="panel-heading">Votre Email</div>
                <div class="panel-body">
                    <div id="email-message"></div>
                    <form action="javascript:void(0)" method="post" id="update-email-form">
                        @csrf
                        <div class="form-group">
                            <label for="mail">Email Actuel</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" id="mail" class="form-control" value="{{ Auth::user()->email }}" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newMail">Nouveau Email</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" id="newMail" class="form-control" placeholder="li@gmail.com" required />
                            </div>
                        </div>
                        <button type="submit" id="update_email" class="btn btn-primary">Modifier l'Email</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Votre Mot De Passe</div>
                <div class="panel-body">
                    <div id="password-message" class="alert" style="display:none;"></div>
                    <form id="form_update_password">
                        @csrf
                        <div class="form-group">
                            <label for="pwd2">Mot De Passe Actuel</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" id="pwd2" name="pwd_actu" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd3">Nouveau Mot De Passe</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" id="pwd3" name="pwd_modif" class="form-control" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier le mot de passe</button>
                    </form>
                </div>
            </div>

            <div>
                <h4>Préférences e-mail</h4>
                <form action="javascript:void(0)" method="post">
                    @csrf
                    <label><input type="checkbox" name="newsletter" id="newsletter"> Recevoir la Newsletter de SinusTic</label>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </form>
            </div>

            <div>
                <h4 class="text-danger">Supprimer votre compte</h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalToggle">Je désire supprimer mon compte</button>

                <div class="modal fade" id="modalToggle" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Alerte Suppression</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                Voulez-vous vraiment supprimer votre compte ?
                                <p>La suppression de votre compte entraîne directement la suppression de toutes vos données personnelles et autres liées à ce compte.</p>
                            </div>
                            <div class="modal-footer">
                                <a href="/delete-compte" class="btn btn-danger">Je le veux</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Avis -->
        <div class="collapse" id="multiCollapseExample4">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-circle" src="{{ asset('/avis.jpg') }}" alt="avatar" width="250" height="250" />
                </div>
                <div class="col-md-9">
                    <h4>Soyez le premier à donner votre avis</h4>
                    <p>Dites-nous ce qui vous plaît et ce que vous aimeriez qu’on améliore afin de vous offrir la meilleure expérience possible avec SinusTic.</p>
                    <small>Votre satisfaction est notre priorité.</small>

                    <form id="form_avis" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea id="avis-message" name="message" class="form-control" rows="4" placeholder="Écrivez votre avis ici..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer mon avis</button>
                    </form>
                </div>
            </div>
            <div class="alert alert-info">
                <span class="glyphicon glyphicon-info-sign"></span>
                <p>Vous avez une question ou besoin spécifique ? N'hésitez pas à aller dans le
                    <a href="#" class="alert-link">forum de discussion</a> ou
                    <a href="#" class="alert-link">contacter-nous</a> directement !
                </p>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('js/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#form_update_password').on('submit', function (event) {
        event.preventDefault();
        var pwd_actu = $('#pwd2').val();
        var pwd_modif = $('#pwd3').val();

        $.ajax({
            type: "POST",
            url: "{{ url('/update-password') }}",
            data: { pwd_actu: pwd_actu, pwd_modif: pwd_modif },
            dataType: 'json',
            success: function (res) {
                $('#password-message')
                    .removeClass('alert-danger')
                    .addClass('alert alert-success')
                    .html("Mot de passe modifié avec succès !")
                    .show();
                $('#pwd2, #pwd3').val('');
            },
            error: function (xhr) {
                let response = xhr.responseJSON;
                let message = response && response.message ? response.message : "Erreur lors de la mise à jour.";
                $('#password-message')
                    .removeClass('alert-success')
                    .addClass('alert alert-danger')
                    .html(message)
                    .show();
            }
        });
    });

    $('#update-email-form').on('submit', function (e) {
        e.preventDefault();
        let newMail = $('#newMail').val();
        let token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ route('update.email') }}",
            method: "POST",
            data: { _token: token, newMail: newMail },
            success: function (response) {
                if (response.resultat === 'ok') {
                    $('#email-message').html('<div class="alert alert-success">Email mis à jour avec succès.</div>');
                    $('#mail').val(newMail);
                    $('#newMail').attr('placeholder', newMail);
                    $('#newMail').val('');
                } else {
                    $('#email-message').html('<div class="alert alert-danger">Une erreur s\'est produite.</div>');
                }
            }
        });
    });

    $('#form_avis').on('submit', function (event) {
        event.preventDefault();
        var message = $('#avis-message').val();

        $.ajax({
            type: "POST",
            url: "{{ url('/submit-avis') }}",
            data: { message: message },
            dataType: 'json',
            success: function (res) {
                if (res.resultat === 'ok') {
                    alert("Merci pour votre avis !");
                    $('#avis-message').val('');
                } else {
                    alert("Erreur lors de l'envoi de votre avis.");
                }
            },
            error: function (xhr) {
                alert("Erreur lors de la soumission de l'avis.");
            }
        });
    });

    $("#photo_profile").click(function () {
        $("#photo_image").click();
    });

    $("#photo_image").change(function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#photo_profile").attr('src', e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $('.updateProfil').on('click', function (event) {
        var formData = new FormData();
        formData.append('nom', $("#nom").val());
        formData.append('prenom', $("#prenom").val());
        formData.append('pseudo', $("#pseudo").val());
        formData.append('sex', $("#sex").val());
        formData.append('birthday', $("#birthday").val());
        formData.append('a_propos', $("#a_propos").val());
        formData.append('pays', $("#pays").val());
        formData.append('phone', $("#phone").val());
        formData.append('site', $("#site").val());
        formData.append('LinkedIn', $("#LinkedIn").val());
        formData.append('Facebook', $("#Facebook").val());
        formData.append('biographie', $("#biographie").val());
        var profile_photo = $("#photo_image").prop('files')[0];
        if (profile_photo) {
            formData.append('profile_photo', profile_photo);
        }
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            type: "POST",
            url: "{{ url('/formateur/update-profile') }}",
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                window.location.href = res.redirect + "?success=1";
            }
        });
    });
});

function modifier() {
    var user = document.getElementById('userInfo');
    var form = document.getElementById('formUser');
    if (user.style.display == 'block') {
        user.style.display = 'none';
        form.style.display = 'block';
    } else {
        user.style.display = 'block';
        form.style.display = 'none';
    }
}

function actuel(elm) {
    var ongletActuel = document.getElementById('actuelle');
    var onglet = document.getElementById('onglet');
    var onglet1 = document.getElementById('multiCollapseExample1');
    var onglet2 = document.getElementById('multiCollapseExample2');
    var onglet4 = document.getElementById('multiCollapseExample4');
    var text = $(elm).data('element');

    if (text == 'Profil') {
        onglet2.style.display = 'none';
        onglet4.style.display = 'none';
        onglet1.style.display = 'block';
        ongletActuel.innerHTML = text;
        onglet.innerHTML = text;
        if (user.style.display == 'none' && form.style.display == 'block') {
            user.style.display = 'block';
            form.style.display = 'none';
        }
    } else if (text == 'Parametres') {
        onglet1.style.display = 'none';
        onglet4.style.display = 'none';
        onglet2.style.display = 'block';
        ongletActuel.innerHTML = text;
        onglet.innerHTML = text;
    } else if (text == 'Avis') {
        onglet1.style.display = 'none';
        onglet2.style.display = 'none';
        onglet4.style.display = 'block';
        ongletActuel.innerHTML = text;
        onglet.innerHTML = 'Avis';
    }
}
</script>

@endsection