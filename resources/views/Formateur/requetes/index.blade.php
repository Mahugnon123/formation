@extends('Formateur.app')

@section('content')
    <div class="container-xxl">
    <h3 class="text-center mt-2 pb-4">📩 Requêtes des apprenants</h3>
    </div>

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
    @php
        $grouped = [];
        foreach ($requetes as $rq) {
            $fmtTitle = $formations_associees[$rq->id]->titre ?? 'Formation inconnue';
            if (!isset($grouped[$fmtTitle])) { $grouped[$fmtTitle] = []; }
            $grouped[$fmtTitle][] = $rq;
        }
    @endphp
    <div class="container-xxl">
        <div class="accordion" id="formateurRequetes">
            @foreach ($grouped as $formationTitle => $items)
                @php $collapseId = 'collapse_'.Str::slug($formationTitle, '_'); @endphp
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header bg-white formation-toggle d-flex align-items-center position-relative rounded-4" 
                         data-target="#{{ $collapseId }}" style="cursor:pointer;">
                        <h5 class="mb-0">
                            <i class="bi bi-book me-2"></i> {{ $formationTitle }}
                        </h5>
                        <div class="ms-auto badge-wrapper me-1">
                            <span class="badge badge-discussion-count">{{ count($items) }} discussion{{ count($items) > 1 ? 's' : '' }}</span>
                            @php
                                $groupHasPending = false;
                                foreach ($items as $it) { if (($requete_has_pending[$it->id] ?? false) === true) { $groupHasPending = true; break; } }
                            @endphp
                            @if ($groupHasPending)
                                <span class="notif-emoji" title="Nouveaux messages">📧</span>
                            @endif
                        </div>
                    </div>
                    <div id="{{ $collapseId }}" class="formation-collapse">
                        <div class="card-body">
                            <div class="row g-3">
                                @foreach ($items as $requete)
                                    @php
                                        $lastReponse = $reponse[$requete->id]->sortBy('created_at')->last();
                                        $lastDate = $lastReponse ? date('d/m/Y H:i', strtotime($lastReponse->updated_at)) : 'Aucun';
                                        $lastAuteur = $lastReponse ? ($users[$lastReponse->user_id]->nom ?? 'Inconnu') : '';
                                    @endphp
                                    <div class="col-12 col-md-6">
                    <a href="{{ route('requete.show', $requete->slug) }}" class="text-decoration-none text-dark">
                        <div class="card shadow border-0 hoverable h-100 rounded-4">
                            <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-chat-dots me-2"></i>{{ Str::limit($requete->nom, 40, '...') }}</span>
                                        @if ($requete_has_pending[$requete->id] ?? false)
                                                            <span class="badge badge-new-message">🔔 Nouveau message</span>
                                        @endif
                                </h5>
                                <p class="mb-1">
                                    <i class="bi bi-person me-1 text-secondary"></i>
                                    <strong>Apprenant :</strong>
                                    {{ $users[$requete->user_id]->prenom ?? '' }} {{ $users[$requete->user_id]->nom ?? 'Inconnu' }}
                                </p>
                                                    <p class="mb-0 text-muted small">
                                                        <i class="bi bi-clock me-1"></i>
                                                        Dernier message : {{ $lastDate }}
                                                        @if($lastAuteur) par <strong>{{ $lastAuteur }}</strong> @endif
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
    </div>
    
    @endif

    <style>
        .hoverable { transition: all 0.3s ease-in-out; }
        .hoverable:hover { background-color: #f9fbff; transform: translateY(-4px); box-shadow: 0 12px 24px rgba(0,0,0,0.08); }
        .formation-toggle { padding-top: .9rem; padding-bottom: .9rem; }
        .formation-toggle:hover { background:#f6f8fc; box-shadow: inset 0 -1px 0 rgba(0,0,0,0.03); }
        .formation-collapse { max-height: 0; opacity: 0; overflow: hidden; transition: max-height .35s cubic-bezier(.4,0,.2,1), opacity .25s ease; }
        .formation-collapse.open { opacity: 1; }
        .badge-wrapper { position: relative; display: inline-block; }
        .badge-wrapper .notif-emoji { position: absolute; top: -8px; right: -8px; font-size: .95rem; line-height: 1; filter: drop-shadow(0 1px 1px rgba(0,0,0,.15)); }
        /* Style des titres de formation */
        .formation-toggle h5 { color:#111111; font-weight:700; letter-spacing:.2px; }
        .formation-toggle:hover h5 { color:#333333; }
        /* Badge compteur discussions */
        .badge-discussion-count { background: linear-gradient(135deg,#7f8fa6 0%, #5a6b7e 100%); color:#fff; font-weight:700; letter-spacing:.3px; border-radius: 999px; padding:.45rem .9rem; box-shadow: 0 6px 16px rgba(90,107,126,.25); text-transform: uppercase; }
        /* Badge nouveau message (style bleu doux) */
        .badge-new-message { background:#e9f2ff; color:#0d6efd; border:1px solid rgba(13,110,253,.35); font-weight:800; letter-spacing:.6px; text-transform:uppercase; border-radius:12px; padding:.45rem .9rem; box-shadow: inset 0 1px 0 rgba(255,255,255,.7); }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, i) => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, i * 60);
            });

            document.addEventListener('click', function(e){
                const btn = e.target.closest('.formation-toggle');
                if(!btn) return;
                e.preventDefault();
                const targetSel = btn.getAttribute('data-target');
                if(!targetSel) return;
                const target = document.querySelector(targetSel);
                if(!target) return;

                const isOpen = target.classList.contains('open');

                document.querySelectorAll('.formation-collapse').forEach(el => {
                  el.style.maxHeight = '0px';
                  el.classList.remove('open');
                  el.style.opacity = '0';
                });

                if(!isOpen){
                  target.classList.add('open');
                  target.style.maxHeight = target.scrollHeight + 'px';
                  target.style.opacity = '1';
                }
            });

            const ro = new ResizeObserver(entries => {
              entries.forEach(entry => {
                const el = entry.target;
                if (el.classList.contains('open')) {
                  el.style.maxHeight = el.scrollHeight + 'px';
                }
              });
            });
            document.querySelectorAll('.formation-collapse').forEach(el => ro.observe(el));
        });
    </script>
@endsection
