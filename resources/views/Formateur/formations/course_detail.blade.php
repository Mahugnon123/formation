@extends("Formateur.app")
@section("content")

<?php 

$chapitre = json_decode($formation->chapitre);

 ?>
  <div class="content-wrapper">
     <div class="container-xxl flex-grow-1 container-p-y">
       <div class="row">
         <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
            	@foreach($chapitre as $index => $one_chapitre)
            	<div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-3" style="font-weight: bold; color: #2c3e50; font-size: 2.1rem; letter-spacing: 0.5px;">
                        Chapitre {{ $index + 1 }} : <span style="font-size:2.3rem; font-weight:800; color:#1976d2;">{{ $one_chapitre->intitule }}</span>
                    </h5>
                    <div class="chapter-description mt-4" style="font-size:1.25rem;">
                        <h3 style="font-size:1.5rem; font-weight:600; color:#125ea2;">Petite description de la formation</h3>
                        <p>{{ $one_chapitre->chapitre_description }}</p><br>
                    </div>
                    <hr style="border-top: 2px solid #d1d5db; margin: 2rem 0;">
                    @if(isset($formation->type) && $formation->type == 'texte')
                        <div class="card-text" style="font-size: 1.18em; color: #444; line-height:1.8;">
                            {!! isset($one_chapitre->summernote) ? htmlspecialchars_decode($one_chapitre->summernote) : ($one_chapitre->contenu_texte ?? 'Aucun contenu texte.') !!}
                        </div>
                    @else
                        @if(isset($one_chapitre->video_url) && $one_chapitre->video_url)
                            <div class="w-100 mb-3" style="background: #f8f9fa; border-radius: 10px; overflow: hidden;">
                                <video 
                                    src="{{ asset($one_chapitre->video_url) }}" 
                                    controls 
                                    class="video-chapitre"
                                    style="width: 100%; object-fit: cover; background: #000;">
                                </video>
                            </div>
                        @else
                            <p class="text-danger">Pas de vidéo pour ce chapitre.</p>
                        @endif
                        
                        @if(isset($one_chapitre->editordata_video) && $one_chapitre->editordata_video)
                            <div class="card-text" style="font-size: 1.18em; color: #444; line-height:1.8;">
                                {!! htmlspecialchars_decode($one_chapitre->editordata_video) !!}
                            </div>
                        @endif
                    @endif
                </div>
                <div class="d-flex justify-content-between mt-4 mb-4 px-4">
                    @if($index > 0)
                        <button class="btn btn-secondary btn-lg btn-navigation btn-precedent" type="button" data-chapter="{{ $index }}"> <i class="bi bi-arrow-left"></i> Précédent</button>
                    @else
                        <div></div>
                    @endif
                    @if($index < count($chapitre) - 1)
                        <button class="btn btn-primary btn-lg btn-navigation btn-suivant" type="button" data-chapter="{{ $index }}">Suivant <i class="bi bi-arrow-right"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
          @endforeach
        </div>
       </div> 
  </div>
</div>
</div>
          
@endsection

<style>
.video-chapitre {
    max-height: 300px;
    width: 100%;
    object-fit: cover;
    background: #000;
    transition: object-fit 0.3s ease;
}


/* Pour tous les modes plein écran */
.video-chapitre:fullscreen,
.video-chapitre:-webkit-full-screen,
.video-chapitre:-moz-full-screen,
.video-chapitre:-ms-fullscreen {
    max-height: none !important;
    height: 100% !important;
    width: 100% !important;
    object-fit: contain !important;
    background: #000 !important;
    display: block;
}

/* Parfois le parent passe en fullscreen, donc on cible aussi la vidéo à l'intérieur d'un parent fullscreen */
:fullscreen .video-chapitre,
:-webkit-full-screen .video-chapitre,
:-moz-full-screen .video-chapitre,
:-ms-fullscreen .video-chapitre {
    max-height: none !important;
    height: 100% !important;
    width: 100% !important;
    object-fit: contain !important;
    background: #000 !important;
    display: block;
}
</style>
@section('scripts')
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
    // Masquer tous les chapitres sauf le premier
    var chapters = document.querySelectorAll('.row.mb-4');
    chapters.forEach(function(chap, idx) {
        if(idx !== 0) chap.style.display = 'none';
    });

    // Navigation
    document.querySelectorAll('.btn-suivant').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var current = parseInt(this.getAttribute('data-chapter'));
            chapters[current].style.display = 'none';
            chapters[current+1].style.display = '';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
    document.querySelectorAll('.btn-precedent').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var current = parseInt(this.getAttribute('data-chapter'));
            chapters[current].style.display = 'none';
            chapters[current-1].style.display = '';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
});
</script>
@endsection
