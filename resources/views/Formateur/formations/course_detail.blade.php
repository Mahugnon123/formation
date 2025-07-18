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
                    <h5 class="card-title mb-3" style="font-weight: bold; color: #2c3e50;">
                        Chapitre {{ $index + 1 }} : {{ $one_chapitre->intitule }}
                    </h5>
                    @if(isset($formation->type) && $formation->type == 'texte')
                        <p class="card-text" style="font-size: 1.1em; color: #444;">
                            {{ $one_chapitre->contenu_texte ?? 'Aucun contenu texte.' }}
                        </p>
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
                        <p class="card-text" style="font-size: 1.1em; color: #444;">
                            {{ $one_chapitre->chapitre_description }}
                        </p>
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
</script>
@endsection
