@extends("Apprenant.app")
@section("content")

@php
use Illuminate\Support\Str;
$rand = random_int(100, 900);
@endphp

@if (session()->has('message'))
<div class="container mt-4">
    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Annonce :</strong> {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
    </div>
</div>
@endif

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-primary">Mes messages privés</h3>
        <button class="btn btn-newmsg" onclick="showForm('formMessage')">Nouveau message privé</button>
    </div>

    {{-- Formulaire nouveau message --}}
    <div class="card mt-4 mb-4 d-none" id="formMessage">
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

    @if($requetes->isEmpty())
        <div class="alert alert-warning text-center">Aucun message privé pour le moment.</div>
    @else
        @php
            // Regrouper les requêtes par formation (titre)
            $groupedByFormation = [];
            foreach ($requetes as $requete) {
                $fmt = $formations[$requete->id] ?? null; // formation associée
                $formationId = $fmt->id ?? ('x_'.$requete->id);
                $formationTitre = $fmt->titre ?? 'Formation inconnue';
                if (!isset($groupedByFormation[$formationId])) {
                    $groupedByFormation[$formationId] = [
                        'titre' => $formationTitre,
                        'slug' => $fmt->slug ?? Str::slug($formationTitre.'-'.$formationId),
                        'requetes' => collect(),
                    ];
                }
                $groupedByFormation[$formationId]['requetes']->push($requete);
            }
        @endphp

        <div id="accordionFormations">
            @foreach($groupedByFormation as $fid => $group)
                @php
                    $collapseId = 'formation-'.$fid;
                    // Détecter s'il y a au moins une discussion avec nouveau message dans ce groupe
                    $hasPendingInGroup = false;
                    foreach ($group['requetes'] as $reqTmp) {
                        if (($requete_has_pending[$reqTmp->id] ?? false) === true) { $hasPendingInGroup = true; break; }
                    }
                @endphp
                <div class="card mb-3">
                    <div class="card-header p-0" id="heading-{{ $fid }}">
                        <button class="btn btn-link text-start w-100 d-flex justify-content-between align-items-center px-3 py-3 formation-toggle position-relative"
                                type="button"
                                data-target="#{{ $collapseId }}"
                                aria-expanded="false"
                                aria-controls="{{ $collapseId }}"
                                style="text-decoration:none; font-weight:700; color:#1a1a37;">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-folder2-open me-2"></i>{{ $group['titre'] }}
                            </span>
                            <span class="badge bg-secondary">{{ $group['requetes']->count() }} discussion(s)</span>
                            @if($hasPendingInGroup)
                                <span class="notif-emoji" aria-label="Nouveaux messages">📧</span>
                            @endif
                        </button>
                    </div>
                    <div id="{{ $collapseId }}" class="formation-collapse">
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach($group['requetes'] as $requete)
                                    @php
                                        $last = $reponse[$requete->id]->first() ?? null;
                                        $lastDate = $last ? $last->updated_at->format('d/m/Y H:i') : 'Aucun';
                                        $lastAuteur = $last ? ($users[$last->user_id]->nom ?? 'Inconnu') : '';
                                        $fmt = $formations[$requete->id] ?? null;
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <a href="{{ url('/requete/'.$rand.'-'.$requete->nom) }}" class="text-decoration-none text-dark">
                                            <div class="card shadow-sm hoverable h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between align-items-center">
                                                        <span><i class="bi bi-chat-dots me-2"></i>{{ Str::limit($requete->nom, 30, '...') }}</span>
                                                        @if ($requete_has_pending[$requete->id] ?? false)
                                                            <span class="badge badge-newmsg">🔔 Nouveau message</span>
                                                        @endif
                                                    </h5>
                                                    <p class="text-muted mb-1">
                                                        Formation : {{ Str::limit($fmt->titre ?? 'Inconnue', 40, '...') }}
                                                    </p>
                                                    <p class="mb-0 text-muted small">
                                                        Dernier message : {{ $lastDate }} 
                                                        @if($lastAuteur)
                                                            par <strong>{{ $lastAuteur }}</strong>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.hoverable:hover { background-color: #f8f9fa; transition: 0.3s; }
.formation-toggle:hover { background:#f8f9fa; }
/* Slide/Fade for formation collapse */
.formation-collapse { max-height: 0; opacity: 0; overflow: hidden; transition: max-height .35s cubic-bezier(.4,0,.2,1), opacity .25s ease; }
.formation-collapse.open { opacity: 1; }
/* Emoji message en haut à droite */
.formation-toggle .notif-emoji {
    position: absolute;
    top: 8px;
    right: 10px;
    font-size: 1rem;
    line-height: 1;
}
/* Badge Nouveau message - bleu doux */
.badge-newmsg {
    background: #e7f1ff; /* bleu très clair */
    color: #0d6efd;      /* bleu bootstrap */
    border: 1px solid #bfd6ff;
    font-weight: 600;
    letter-spacing: .2px;
}
/* Bouton Nouveau message privé - style cohérent */
.btn-newmsg{
    background: linear-gradient(135deg, #0d6efd 0%, #4da3ff 100%);
    color:#fff;
    border: none;
    border-radius: 10px;
    padding: 10px 16px;
    font-weight: 700;
    letter-spacing: .2px;
    box-shadow: 0 8px 18px rgba(13,110,253,0.25);
    transition: transform .15s ease, box-shadow .2s ease, filter .2s ease;
}
.btn-newmsg:hover{
    filter: brightness(1.05);
    transform: translateY(-1px);
    box-shadow: 0 10px 22px rgba(13,110,253,0.28);
}
.btn-newmsg:active{ transform: translateY(0); box-shadow: 0 6px 14px rgba(13,110,253,0.22); }
</style>

<script>
function showForm(elm) {
    let element = document.getElementById(elm);
    element.classList.toggle('d-none');
}

// Toggle custom fluide: un seul ouvert; re-clic referme (slide + fade)
(function(){
  document.addEventListener('click', function(e){
    const btn = e.target.closest('.formation-toggle');
    if(!btn) return;
    e.preventDefault();
    const targetSel = btn.getAttribute('data-target');
    if(!targetSel) return;
    const target = document.querySelector(targetSel);
    if(!target) return;

    const isOpen = target.classList.contains('open');

    // fermer tous avec animation
    document.querySelectorAll('.formation-collapse').forEach(el => {
      el.style.maxHeight = '0px';
      el.classList.remove('open');
      el.style.opacity = '0';
    });
    document.querySelectorAll('.formation-toggle').forEach(b => b.setAttribute('aria-expanded','false'));

    // si n'était pas ouvert, ouvrir celui-ci
    if(!isOpen){
      target.classList.add('open');
      target.style.maxHeight = target.scrollHeight + 'px';
      target.style.opacity = '1';
      btn.setAttribute('aria-expanded','true');
    }
  });

  // Ajuster la hauteur si le contenu interne change (par prudence)
  const ro = new ResizeObserver(entries => {
    entries.forEach(entry => {
      const el = entry.target;
      if (el.classList.contains('open')) {
        el.style.maxHeight = el.scrollHeight + 'px';
      }
    });
  });
  document.querySelectorAll('.formation-collapse').forEach(el => ro.observe(el));
})();
</script>

@endsection
