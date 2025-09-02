@extends("front.app")
@section("content")
<?php
$i = 1;
?>
<!-- page title -->
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="index">Accueil</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Nos formations</li>
        </ul>
        <!-- <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p> -->
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<div class="container my-4">
    <h2 class="text-center fw-bold mb-4" style="color: #181c32;">
        Dans quel domaine souhaitez-vous vous former ?
    </h2>
    <div class="mb-3">
    <div class="position-relative w-25 ">
    <input type="text" id="searchCategory" class="form-control" placeholder="   Filtrer par catégorie..." autocomplete="off">
    <ul id="categoryDropdown" class="list-group position-absolute w-100" style="z-index:1000; display:none; max-height:200px; overflow-y:auto;">
        @foreach($categories as $category)
            <li class="list-group-item category-option" data-category="{{ $category->id }}">{{ $category->nom }}</li>
        @endforeach
    </ul>
</div>
</div>
<!-- Nouveaux sélecteurs gratuits/payants -->
<div class="mb-4">
    <label class="form-label fw-bold mb-3" style="color: #181c32; font-size: 1.1rem;">
        <i class="fa fa-filter me-2"></i>Filtrer par type de formation
    </label>
    <div class="d-flex gap-4 flex-wrap">
        <div class="filter-option">
            <input class="filter-radio" type="radio" name="formationType" id="filterFreeFormation" value="free_formation">
            <label class="filter-label" for="filterFreeFormation">
                <i class="fa fa-graduation-cap me-2"></i>
                <span>Formation gratuite</span>
            </label>
        </div>
        <div class="filter-option">
            <input class="filter-radio" type="radio" name="formationType" id="filterFreeFormationPaidCert" value="free_formation_paid_cert">
            <label class="filter-label" for="filterFreeFormationPaidCert">
                <i class="fa fa-certificate me-2"></i>
                <span>Formation en PROMO</span>
            </label>
        </div>
        <div class="filter-option">
            <input class="filter-radio" type="radio" name="formationType" id="filterPaidFormation" value="paid_formation">
            <label class="filter-label" for="filterPaidFormation">
                <i class="fa fa-credit-card me-2"></i>
                <span>Formation payante</span>
            </label>
        </div>
        <div class="filter-option">
            <input class="filter-radio" type="radio" name="formationType" id="filterAllFormations" value="all_formations" checked>
            <label class="filter-label" for="filterAllFormations">
                <i class="fa fa-list me-2"></i>
                <span>Toutes les formations</span>
            </label>
        </div>
    </div>
</div>
</div>

<hr class="category-separator">

<section class="section-sm">
    <div class="container">
        <div class="row" id="formationsRow">
            @php
                $aosEffects = ['fade-up', 'fade-down', 'zoom-in', 'zoom-in-up', 'flip-left', 'flip-right', 'fade-zoom-in', 'flip-up'];
                shuffle($aosEffects);
            @endphp
            @forelse($formations->chunk(4) as $row)
                @foreach($row as $one_formation)
                    @php
                        $effect = $aosEffects[array_rand($aosEffects)];
                        $delay = ($loop->index % 4) * 100;
                        // Déterminer le type de formation pour le filtrage
                        $formationType = '';
                        // Debug: afficher les valeurs pour comprendre
                        // echo "Debug: payant_ou_non=" . $one_formation->payant_ou_non . ", prix_certification=" . $one_formation->prix_certification . "<br>";
                        
                        if ($one_formation->payante_ou_non == 'Non' && ($one_formation->prix_certification == 0 || $one_formation->prix_certification == null)) {
                            $formationType = 'free_formation';
                        } elseif ($one_formation->payante_ou_non == 'Non' && $one_formation->prix_certification > 0) {
                            $formationType = 'free_formation_paid_cert';
                        } elseif ($one_formation->payante_ou_non == 'Oui') {
                            $formationType = 'paid_formation';
                        }
                    @endphp
<div class="col-lg-3 col-sm-6 mb-5 formation-card"
     data-category="{{ $one_formation->categorie_id }}"
     data-formation-type="{{ $formationType }}"
     data-aos="{{ $effect }}" data-aos-delay="{{ $delay }}">                        <a href="{{ url('/apprenant-course-detail/'.$one_formation->slug)}}">
                            <div class="card p-0 border-primary rounded-0 hover-shadow">
                                <div style="height: 200px; overflow: hidden;">
                                    <img class="card-img-top rounded-0" src="{{asset($one_formation->image_url)}}" alt="{{$one_formation->titre}}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body">
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{\Carbon\Carbon::parse($one_formation->created_at)->format('d M Y')}}</li>
                                    </ul>
                                    <h4 class="card-title d-flex justify-content-space-between" style="min-height: 2.4em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;text-align:center;">
                                        @php
                                            $maxLengthPerLine = 20; // Estimation pour une ligne
                                            $maxLines = 2; // Maximum 2 lignes
                                            $maxLength = $maxLengthPerLine * $maxLines; // 40 caractères maximum
                                            $title = $one_formation->titre;
                                            $words = explode(' ', $title); // Sépare les mots
                                            $currentLength = 0;
                                            $currentLine = 1;
                                            $displayedTitle = '';
          
                                            foreach ($words as $word) {
                                                $wordLength = strlen($word) + 1; // +1 pour l'espace
                                                if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                                    $displayedTitle .= ($displayedTitle ? ' ' : '') . $word;
                                                    $currentLength += $wordLength;
                                                } else {
                                                    if ($currentLine < $maxLines) {
                                                        $currentLine++; // Passe à la ligne suivante
                                                        $displayedTitle .= ' ' . $word;
                                                        $currentLength = $wordLength; // Réinitialise pour la nouvelle ligne
                                                    } else {
                                                        break; // Arrête si on dépasse le nombre de lignes
                                                    }
                                                }
                                            }
          
                                            if (strlen($title) > $maxLength) {
                                                $displayedTitle = substr($displayedTitle, 0, $maxLength - 3) . '...'; // Tronque et ajoute "..."
                                            } else {
                                                $remainingCharacters = $maxLength - strlen($displayedTitle);
                                                $padding = str_repeat(' ', $remainingCharacters); // Espace insécable
                                                $displayedTitle .= $padding;
                                            }
          
                                            echo $displayedTitle;
                                        @endphp
                                    </h4>
                                    @if(strlen($one_formation->description) > 50)
                                    <p class="card-text mb-4" style="min-height: 2.8em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        @php
                                            $maxLengthPerLine = 25; // Estimation pour une ligne (ajuste selon la largeur)
                                            $maxLines = 2; // Maximum 2 lignes
                                            $maxLength = $maxLengthPerLine * $maxLines; // 50 caractères maximum
                                            $description = $one_formation->description;
                                            $words = explode(' ', $description); // Sépare les mots
                                            $currentLength = 0;
                                            $currentLine = 1;
                                            $displayedDescription = '';
                                
                                            foreach ($words as $word) {
                                                $wordLength = strlen($word) + 1; // +1 pour l'espace
                                                if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                                    $displayedDescription .= ($displayedDescription ? ' ' : '') . $word;
                                                    $currentLength += $wordLength;
                                                } else {
                                                    if ($currentLine < $maxLines) {
                                                        $currentLine++; // Passe à la ligne suivante
                                                        $displayedDescription .= ' ' . $word;
                                                        $currentLength = $wordLength; // Réinitialise pour la nouvelle ligne
                                                    } else {
                                                        break; // Arrête si on dépasse le nombre de lignes
                                                    }
                                                }
                                            }
                                
                                            if (strlen($description) > $maxLength) {
                                                $displayedDescription = substr($displayedDescription, 0, $maxLength - 3) . '...'; // Tronque et ajoute "..."
                                            }
                                
                                            echo $displayedDescription;
                                        @endphp
                                    </p>
                                @else
                                    <p class="card-text mb-4" style="min-height: 2.8em !important; display: -webkit-box !important; -webkit-line-clamp: 2 !important; -webkit-box-orient: vertical !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                        @php
                                            $maxLengthPerLine = 25; // Estimation pour une ligne
                                            $maxLines = 2; // Maximum 2 lignes
                                            $maxLength = $maxLengthPerLine * $maxLines; // 50 caractères maximum
                                            $description = $one_formation->description;
                                            $words = explode(' ', $description); // Sépare les mots
                                            $currentLength = 0;
                                            $currentLine = 1;
                                            $displayedDescription = '';
                                
                                            foreach ($words as $word) {
                                                $wordLength = strlen($word) + 1; // +1 pour l'espace
                                                if ($currentLength + $wordLength <= $maxLengthPerLine * $currentLine) {
                                                    $displayedDescription .= ($displayedDescription ? ' ' : '') . $word;
                                                    $currentLength += $wordLength;
                                                } else {
                                                    if ($currentLine < $maxLines) {
                                                        $currentLine++; // Passe à la ligne suivante
                                                        $displayedDescription .= ' ' . $word;
                                                        $currentLength = $wordLength; // Réinitialise pour la nouvelle ligne
                                                    } else {
                                                        break; // Arrête si on dépasse le nombre de lignes
                                                    }
                                                }
                                            }
                                
                                            $remainingCharacters = $maxLength - strlen($displayedDescription);
                                            $padding = str_repeat(' ', $remainingCharacters); // Espace insécable
                                            $displayedDescription .= $padding;
                                
                                            echo $displayedDescription;
                                        @endphp
                                    </p>
                                @endif
                                    <div class="d-flex justify-content-center mb-3">
                                        @if($one_formation->payante_ou_non == 'Non' && ($one_formation->prix_certification == 0 || $one_formation->prix_certification == null))
                                            <span class="badge-custom badge-free">
                                                <i class="fa fa-unlock me-1"></i> Gratuit
                                            </span>
                                        @elseif($one_formation->payante_ou_non == 'Non' && $one_formation->prix_certification > 0)
                                            <span class="badge-custom badge-price">
                                                <i class="fa fa-bolt me-1"></i> EN PROMO
                                            </span>
                                        @elseif($one_formation->payante_ou_non == 'Oui')
                                            @php
                                                $sommePrix = ($one_formation->prix_formation ?? 0) + ($one_formation->prix_certification ?? 0);
                                            @endphp
                                            <span class="badge-custom badge-price">
                                                <i class="fa fa-credit-card me-1"></i> {{ $sommePrix }} fcfa
                                            </span>
                                        @endif
                                    </div>
                                   {{--  <a href="{{ url('/apprenant-course-detail/'.$one_formation->slug)}}" class="btn btn-primary btn-sm">Voir plus</a> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @empty
                <div class="col-12">
                    <p class="text-center">Aucune formation disponible pour cette catégorie.</p>
                </div>
            @endforelse
        </div>
        {{ $formations->links('vendor.pagination.bootstrap-5') }}
    </div>
    <style>
        .cat:hover{
            background-color: green;
            color:white;
        }
        .card {
            transition: transform 0.2s ease-in-out; /* Ajoute une transition pour l'effet */
        }

        .card:hover {
            transform: scale(1.03); /* Tu peux garder ou enlever cet effet de zoom */
            z-index: 10;
            box-shadow: none; /* Plus d'ombre au survol */
        }
        .card-body {
            padding: 20px; /* Ajustez la valeur selon vos besoins */
            transition: background-color 0.3s ease; /* Ajoute une transition pour l'effet de survol */
        }
        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5em;
            padding: 0.45em 1.2em;
            border-radius: 999px;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            margin-bottom: 0.5em;
            text-align: center;
            border: none;
            box-shadow: 0 2px 8px rgba(24,28,50,0.04);
        }
        .badge-free {
            background: #e3f0ff;         /* Bleu très clair */
            color: #1a1a37;              /* Bleu foncé */
            border: 1.5px solid #b6d4fe;
        }
        .badge-price {
            background: #f4f8fb;         /* Gris-bleu très clair */
            color: #0d6efd;              /* Bleu principal Bootstrap */
            border: 1.5px solid #b6d4fe;
        }
        .badge-custom i {
            font-size: 1.1em;
            background: #0d6efd;
            color: #fff;
            border-radius: 50%;
            padding: 0.25em 0.35em;
            margin-right: 0.3em;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .badge-price i {
            background: #e3f0ff;
            color: #0d6efd;
        }
        .category-list {
            margin-top: 1.5em;
            margin-bottom: 1.5em;
            gap: 18px 18px; /* espace vertical puis horizontal */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .category-pill-custom {
            margin: 0 !important; /* enlève tout margin résiduel */
            display: inline-block;
            padding: 0.8em 2.2em;
            border-radius: 999px;
            background: #f4f8fb;
            color: #1a1a37;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            border: 2px solid #e3e6ed;
            box-shadow: 0 2px 8px rgba(24,28,50,0.04);
            transition: 
                background 0.22s cubic-bezier(.4,2,.3,1),
                color 0.22s,
                border 0.22s,
                transform 0.18s;
            letter-spacing: 0.01em;
        }
        .category-pill-custom:hover, .category-pill-custom:focus {
            background:#1a1a37;
            color: #fff;
           
            text-decoration: none;
            outline: none;
            
        }
        .category-separator {
            border: none;
            border-top: 2.5px solid #e3e6ed;
            width: 74%;
            margin: 2.5rem auto 2.5rem auto;
            opacity: 1;
        }
        .filter-option {
            margin-bottom: 10px;
            margin-right: 16px; /* espace horizontal entre les boutons */
        }
        .filter-radio {
            display: none;
        }
        .filter-label {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .filter-label:hover {
            background: #e9ecef;
            border-color: #6c757d;
        }
        .filter-radio:checked + .filter-label {
            background: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }
        .formation-card.hidden {
            display: none !important;
        }
    </style>
         <script>
const searchInput = document.getElementById('searchCategory');
const dropdown = document.getElementById('categoryDropdown');
const options = dropdown.querySelectorAll('.category-option');
const row = document.getElementById('formationsRow');
const formationCards = document.querySelectorAll('.formation-card');

// Variables pour le filtrage
let currentCategoryFilter = null;
let currentFormationTypeFilter = 'all_formations';

// Fonction de filtrage des formations
function filterFormations() {
    // Supprimer les anciens messages d'erreur
    const oldMessages = row.querySelectorAll('.col-12 p.text-center');
    oldMessages.forEach(msg => {
        if (msg.textContent.includes('Aucune formation disponible')) {
            msg.parentElement.remove();
        }
    });
    
    let visibleCount = 0;
    formationCards.forEach(card => {
        const categoryMatch = !currentCategoryFilter || card.getAttribute('data-category') == currentCategoryFilter;
        const formationTypeMatch = currentFormationTypeFilter === 'all_formations' || 
                                 card.getAttribute('data-formation-type') === currentFormationTypeFilter;
        
        if (categoryMatch && formationTypeMatch) {
            card.classList.remove('hidden');
            visibleCount++;
        } else {
            card.classList.add('hidden');
        }
    });
    
    // Vérifier s'il y a des formations visibles
    if (visibleCount === 0) {
        // Afficher un message si aucune formation n'est visible
        const noResultsMessage = document.createElement('div');
        noResultsMessage.className = 'col-12';
        noResultsMessage.innerHTML = '<p class="text-center">Aucune formation disponible pour les critères sélectionnés.</p>';
        row.appendChild(noResultsMessage);
    }
}

// Écouteurs d'événements pour les filtres de type de formation
document.querySelectorAll('.filter-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        const type = this.value;
        currentFormationTypeFilter = type;

        // Si on revient à toutes les formations sans catégorie sélectionnée, recharger l'état initial
        if (type === 'all_formations' && !currentCategoryFilter) {
            window.location.reload();
            return;
        }

        // Appel combiné si une catégorie est sélectionnée ou si on filtre par type
        fetch(`/ajax/formations-filter?type=${encodeURIComponent(type)}${currentCategoryFilter ? `&category_id=${encodeURIComponent(currentCategoryFilter)}` : ''}`)
            .then(response => response.json())
            .then(data => {
                row.innerHTML = '';
                const pagination = document.querySelector('.pagination');
                if (pagination) pagination.style.display = 'none';

                if (!data.html || data.html.trim() === '') {
                    row.innerHTML = '<div class="col-12"><p class="text-center">Aucune formation disponible pour ces critères.</p></div>';
                } else {
                    row.innerHTML = data.html;
                }
            })
            .catch(() => {
                row.innerHTML = '<div class="col-12"><p class="text-center">Erreur lors du chargement des formations.</p></div>';
            });
    });
});

// Affiche la liste au focus
searchInput.addEventListener('focus', () => {
    dropdown.style.display = 'block';
    filterDropdown();
});

// Filtre la liste au fur et à mesure de la saisie
searchInput.addEventListener('input', function() {
    filterDropdown();
    if (this.value.trim() === '') {
        window.location.reload(); // Recharge la page pour revenir à l'affichage initial
    }
});

function removeAccents(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

// Fonction pour filtrer la dropdown
function filterDropdown() {
    const val = removeAccents(searchInput.value.toLowerCase());
    let hasVisible = false;
    options.forEach(opt => {
        const optText = removeAccents(opt.textContent.toLowerCase());
        if (optText.includes(val)) {
            opt.style.display = 'block';
            hasVisible = true;
        } else {
            opt.style.display = 'none';
        }
    });
    dropdown.style.display = hasVisible ? 'block' : 'none';
}

searchInput.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        // Cherche une catégorie visible qui correspond exactement à la saisie
        const val = removeAccents(searchInput.value.toLowerCase().trim());
        let found = false;
        options.forEach(opt => {
            const optText = removeAccents(opt.textContent.toLowerCase().trim());
            if (optText === val && opt.style.display !== 'none') {
                found = true;
                opt.click(); // Déclenche le clic sur la catégorie
            }
        });
        // Si aucune catégorie visible ne correspond exactement, affiche le message
        if (!found) {
            row.innerHTML = '<div class="col-12"><p class="text-center">Aucune formation disponible pour cette catégorie.</p></div>';
            // Cacher la pagination
            const pagination = document.querySelector('.pagination');
            if (pagination) pagination.style.display = 'none';
        }
    }
});

// Clique sur une catégorie
options.forEach(opt => {
    opt.addEventListener('click', function() {
        const catId = this.getAttribute('data-category');
        currentCategoryFilter = catId;
        searchInput.value = this.textContent;
        dropdown.style.display = 'none';

        // Utiliser le filtre combiné avec le type courant
        fetch(`/ajax/formations-filter?category_id=${encodeURIComponent(catId)}&type=${encodeURIComponent(currentFormationTypeFilter)}`)
            .then(response => response.json())
            .then(data => {
                row.innerHTML = '';
                const pagination = document.querySelector('.pagination');
                if (pagination) pagination.style.display = 'none';

                if(!data.html || data.html.trim() === ''){
                    row.innerHTML = '<div class="col-12"><p class="text-center">Aucune formation disponible pour ces critères.</p></div>';
                } else {
                    row.innerHTML = data.html;
                }
            });
    });
});

// Clique en dehors pour fermer la liste
document.addEventListener('click', function(e) {
    if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.style.display = 'none';
    }
});

// Initialiser le filtrage au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    filterFormations();
});
</script>
</section>

@endsection