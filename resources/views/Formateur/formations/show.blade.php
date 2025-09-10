<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>{{ $formation->titre ?? 'Formation' }} — Parcours</title>
		<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
		<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css' rel='stylesheet'>
		<link rel="icon" type="image/x-icon" href="{{ asset('bleuEdupulse.png') }}" />
		<style>
			body { background: #f3f6fb; }
			.layout { min-height: 100vh; }
			.sidebar-card { position: sticky; top: 20px; border: 0; border-radius: 16px; }
			.sidebar-header { font-weight: 800; color: #1e3a8a; }
			.partie-title { color: #1976d2; font-weight: 700; }
			.nav-chapter { width: 100%; text-align: left; border-radius: 10px; }
			.nav-chapter.active { background: #125ea2; color: #fff; }
			.content-area { padding-top: 10px; }
			.chapter-card { border: 0; border-radius: 16px; overflow: hidden; box-shadow: 0 6px 18px rgba(0,0,0,0.06); }
			.chapter-card .card-header { background: linear-gradient(135deg,#e3f2fd,#f8fafc); }
			.chapter-title { font-weight: 800; color: #2c3e50; letter-spacing: 0.2px; }
			.chapter-sub { font-weight: 800; color: #1976d2; }
			.chapter-description { color: #5b6b7c; }
			.btn-navigation { padding: 0.8rem 1.5rem; border-radius: 10px; }
			.video-chapitre { max-height: 320px; width: 100%; object-fit: cover; background: #000; transition: object-fit 0.3s ease; border-radius: 12px; }
			.video-chapitre:fullscreen,
			.video-chapitre:-webkit-full-screen,
			.video-chapitre:-moz-full-screen,
			.video-chapitre:-ms-fullscreen { max-height: none !important; height: 100% !important; width: 100% !important; object-fit: contain !important; background: #000 !important; display: block; }
			:fullscreen .video-chapitre,
			:-webkit-full-screen .video-chapitre,
			:-moz-full-screen .video-chapitre,
			:-ms-fullscreen .video-chapitre { max-height: none !important; height: 100% !important; width: 100% !important; object-fit: contain !important; background: #000 !important; display: block; }
		</style>
	</head>
	<body>
		<?php
			$parties = json_decode($formation->chapitre ?? '[]');
			if (!is_array($parties)) { $parties = []; }
			$linearIndex = 0;
		?>
		<div class="container-fluid layout py-4">
			<div class="row g-4">
				<div class="col-lg-3 col-md-4">
					<div class="card sidebar-card shadow-sm">
						<div class="card-body p-3 p-md-4">
							<div class="d-flex align-items-center mb-3">
								<i class="bi bi-journal-text me-2" style="color:#125ea2;font-size:1.4rem;"></i>
								<h5 class="sidebar-header mb-0">{{ $formation->titre ?? 'Navigation' }}</h5>
							</div>
							<div class="small text-muted mb-2">Parcourez les parties et chapitres</div>
							<div class="mt-3" id="chapters-nav">
								@foreach($parties as $pIndex => $partie)
									<div class="mb-3">
										<div class="partie-title">Partie {{ $partie->num_partie ?? ($pIndex+1) }} — {{ $partie->titre ?? 'Sans titre' }}</div>
										@if(isset($partie->chapitres) && is_array($partie->chapitres))
											@foreach($partie->chapitres as $cIndex => $chap)
												<?php $currentIndex = $linearIndex; $linearIndex++; ?>
												<button type="button" class="btn btn-light nav-chapter mt-2" data-target-index="{{ $currentIndex }}">
													<i class="bi bi-play-circle me-2"></i>
													Chapitre {{ $chap->num_chapitre ?? ($cIndex+1) }} — {{ $chap->intitule ?? 'Sans intitulé' }}
												</button>
											@endforeach
										@endif
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>

				<?php $totalChapters = $linearIndex; $linearIndex = 0; ?>

				<div class="col-lg-9 col-md-8">
					@foreach($parties as $pIndex => $partie)
						@if(isset($partie->chapitres) && is_array($partie->chapitres))
							@foreach($partie->chapitres as $cIndex => $one_chapitre)
								<?php $currentIndex = $linearIndex; $linearIndex++; ?>
								<div class="chapter-block" data-index="{{ $currentIndex }}" style="display:none;">
									<div class="card chapter-card mb-4">
										<div class="card-header p-3 p-md-4">
											<div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
												<div>
													<div class="text-muted">Partie {{ $partie->num_partie ?? ($pIndex+1) }} — {{ $partie->titre ?? 'Sans titre' }}</div>
													<h4 class="chapter-title mt-1 mb-0">Chapitre {{ $one_chapitre->num_chapitre ?? ($cIndex+1) }} : <span class="chapter-sub">{{ $one_chapitre->intitule ?? 'Sans intitulé' }}</span></h4>
												</div>
												<div class="d-flex align-items-center text-muted small">
													<i class="bi bi-collection-play me-1"></i> {{ $currentIndex+1 }} / {{ $totalChapters }}
												</div>
											</div>
										</div>
										<div class="card-body p-3 p-md-4 content-area">
											<div class="chapter-description mb-3">
												<h6 class="mb-2" style="color:#125ea2;font-weight:700;">Présentation du chapitre</h6>
												<p class="mb-0">{{ $one_chapitre->chapitre_description ?? '' }}</p>
											</div>
											<hr class="my-3" />
											@if(isset($formation->type) && $formation->type == 'texte')
												<div class="card-text" style="font-size: 1.05rem; color: #3c4753; line-height:1.8;">
													{!! isset($one_chapitre->summernote) ? htmlspecialchars_decode($one_chapitre->summernote) : ($one_chapitre->contenu_texte ?? ($one_chapitre->contenu ?? 'Aucun contenu texte.')) !!}
												</div>
											@else
												@if(isset($one_chapitre->video_url) && $one_chapitre->video_url)
													<div class="video-wrapper mb-3">
														<video src="{{ asset($one_chapitre->video_url) }}" controls class="video-chapitre"></video>
													</div>
												@else
													<p class="text-danger">Pas de vidéo pour ce chapitre.</p>
												@endif
												@if(isset($one_chapitre->editordata_video) && $one_chapitre->editordata_video)
													<div class="card-text" style="font-size: 1.05rem; color: #3c4753; line-height:1.8;">
														{!! htmlspecialchars_decode($one_chapitre->editordata_video) !!}
													</div>
												@endif
											@endif
										</div>
										<div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
											<div class="d-flex justify-content-between">
												@if($currentIndex > 0)
													<button class="btn btn-outline-secondary btn-lg btn-navigation btn-precedent" type="button" data-index="{{ $currentIndex }}">
														<i class="bi bi-arrow-left"></i> Précédent
													</button>
												@else
													<span></span>
												@endif
												@if($currentIndex < ($totalChapters - 1))
													<button class="btn btn-primary btn-lg btn-navigation btn-suivant" type="button" data-index="{{ $currentIndex }}">
														Suivant <i class="bi bi-arrow-right"></i>
													</button>
												@endif
											</div>
										</div>
									</div>
								</div>
							@endforeach
						@endif
					@endforeach
				</div>
			</div>
		</div>

		<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>
		<script>
			document.addEventListener('fullscreenchange', function () {
				const videos = document.querySelectorAll('.video-chapitre');
				videos.forEach(video => {
					if (document.fullscreenElement === video) {
						video.style.objectFit = 'contain';
					} else {
						video.style.objectFit = 'cover';
					}
				});
			});

			document.addEventListener('DOMContentLoaded', function() {
				const blocks = Array.from(document.querySelectorAll('.chapter-block'));
				const navButtons = Array.from(document.querySelectorAll('.nav-chapter'));

				function showByIndex(targetIndex) {
					blocks.forEach((b, i) => { b.style.display = (i === targetIndex) ? '' : 'none'; });
					updateNavActive(targetIndex);
					window.scrollTo({ top: 0, behavior: 'smooth' });
				}

				function updateNavActive(activeIndex) {
					navButtons.forEach(btn => {
						const idx = parseInt(btn.getAttribute('data-target-index'), 10);
						if (idx === activeIndex) { btn.classList.add('active'); }
						else { btn.classList.remove('active'); }
					});
				}

				// Initialisation: afficher le premier chapitre si présent
				if (blocks.length > 0) { showByIndex(0); }

				// Navigation via la liste
				navButtons.forEach(btn => {
					btn.addEventListener('click', function() {
						const target = parseInt(this.getAttribute('data-target-index'), 10);
						showByIndex(target);
					});
				});

				// Précédent / Suivant
				document.querySelectorAll('.btn-suivant').forEach(function(btn) {
					btn.addEventListener('click', function() {
						const current = parseInt(this.getAttribute('data-index'), 10);
						const next = current + 1;
						if (next < blocks.length) showByIndex(next);
					});
				});
				document.querySelectorAll('.btn-precedent').forEach(function(btn) {
					btn.addEventListener('click', function() {
						const current = parseInt(this.getAttribute('data-index'), 10);
						const prev = current - 1;
						if (prev >= 0) showByIndex(prev);
					});
				});
			});
		</script>
	</body>
</html>