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
    <input type="text" id="searchCategory" class="form-control" placeholder="Rechercher une catégorie..." autocomplete="off">
    <ul id="categoryDropdown" class="list-group position-absolute w-100" style="z-index:1000; display:none; max-height:200px; overflow-y:auto;">
        @foreach($categories as $category)
            <li class="list-group-item category-option" data-category="{{ $category->id }}">{{ $category->nom }}</li>
        @endforeach
    </ul>
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
                    @endphp
<div class="col-lg-3 col-sm-6 mb-5 formation-card"
     data-category="{{ $one_formation->categorie_id }}"
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
                                        @if($one_formation->prix_formation == null)
                                            <span class="badge-custom badge-free">
                                                <i class="fa fa-unlock me-1"></i> Gratuit
                                            </span>
                                        @else
                                            @php
                                                $sommePrix = $one_formation->prix_formation + $one_formation->prix_certification;
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
    </style>
    <script>
const searchInput = document.getElementById('searchCategory');
const dropdown = document.getElementById('categoryDropdown');
const options = dropdown.querySelectorAll('.category-option');
const row = document.getElementById('formationsRow');

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
        searchInput.value = this.textContent;
        dropdown.style.display = 'none';

        fetch('/ajax/formations-by-category/' + catId)
            .then(response => response.json())
            .then(data => {
                row.innerHTML = '';
                // Cacher la pagination
                const pagination = document.querySelector('.pagination');
                if (pagination) pagination.style.display = 'none';

                if(!data.html || data.html.trim() === ''){
                    row.innerHTML = '<div class="col-12"><p class="text-center">Aucune formation disponible pour cette catégorie.</p></div>';
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
</script>
</section>

@endsection