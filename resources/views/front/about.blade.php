@extends("front.app")
@section("content")
<!-- page title -->
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title1.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/index">Accueil</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">À propos</li>
        </ul>
        <!-- <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p> -->
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- about -->
<section class="section py-5" style="background: #f8faff;">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInLeft">
        <img src="/theme/images/about/about-page1.jpg" alt="SinusTic" class="img-fluid rounded-4 shadow" style="max-height:340px;object-fit:cover;">
      </div>
      <div class="col-lg-6 animate__animated animate__fadeInRight">
        <h2 class="fw-bold mb-3" style="color:#1a1a37;">Qui sommes-nous ?</h2>
        <p class="lead mb-3" style="color:#2979ff;">EduPulse, c'est l'excellence de la formation digitale en Afrique francophone.</p>
        <p>
          EduPulse propose des formations en ligne et en présentiel dans les domaines du numérique, de la data, de la programmation, du marketing digital, de la cybersécurité, et bien plus encore. Notre mission : <b>rendre la connaissance accessible à tous</b>, accompagner les apprenants et les professionnels dans leur montée en compétences, et favoriser l'employabilité grâce à des parcours certifiants, des ateliers pratiques et un accompagnement personnalisé.
        </p>
        <ul class="list-unstyled mt-3">
          <li><i class="fa fa-check-circle text-primary me-2"></i> Formations certifiantes et ateliers pratiques</li>
          <li><i class="fa fa-check-circle text-primary me-2"></i> Coaching, mentorat et suivi personnalisé</li>
          <li><i class="fa fa-check-circle text-primary me-2"></i> Communauté active et réseau professionnel</li>
        </ul>
      </div>
    </div>

    <!-- Bloc chiffres clés -->
    <div class="row text-center mt-5">
      <div class="col-md-3 mb-4 mb-md-0 animate__animated animate__fadeInUp">
        <div class="funfact-box p-4 rounded-4 shadow-sm bg-white">
          <div class="funfact-icon mb-2"><i class="fa fa-users text-primary fa-2x"></i></div>
          <h2 class="count text-primary mb-1" data-count="1000">0</h2>
          <div class="fw-bold">Apprenants</div>
        </div>
      </div>
      <div class="col-md-3 mb-4 mb-md-0 animate__animated animate__fadeInUp" style="animation-delay:0.1s;">
        <div class="funfact-box p-4 rounded-4 shadow-sm bg-white">
          <div class="funfact-icon mb-2"><i class="fa fa-chalkboard-teacher text-primary fa-2x"></i></div>
          <h2 class="count text-primary mb-1" data-count="60">0</h2>
          <div class="fw-bold">Enseignants</div>
        </div>
      </div>
      <div class="col-md-3 mb-4 mb-md-0 animate__animated animate__fadeInUp" style="animation-delay:0.2s;">
        <div class="funfact-box p-4 rounded-4 shadow-sm bg-white">
          <div class="funfact-icon mb-2"><i class="fa fa-book text-primary fa-2x"></i></div>
          <h2 class="count text-primary mb-1" data-count="50">0</h2>
          <div class="fw-bold">Cours</div>
        </div>
      </div>
      <div class="col-md-3 animate__animated animate__fadeInUp" style="animation-delay:0.3s;">
        <div class="funfact-box p-4 rounded-4 shadow-sm bg-white">
          <div class="funfact-icon mb-2"><i class="fa fa-smile text-primary fa-2x"></i></div>
          <h2 class="count text-primary mb-1" data-count="3737">0</h2>
          <div class="fw-bold">Satisfaction</div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /about -->

{{-- <!-- funfacts -->
<section class="section-sm bg-primary">
  <div class="container">
    <div class="row">
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="60">0</h2>
          <h5 class="text-white">ENSEIGNANTS(ES)</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="50">0</h2>
          <h5 class="text-white">COURS</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="1000">0</h2>
          <h5 class="text-white">APPRENANTS</h5>
        </div>
      </div>
      <!-- funfacts item -->
      <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
        <div class="text-center">
          <h2 class="count text-white" data-count="3737">0</h2>
          <h5 class="text-white">SATISFACTION</h5>
        </div>
      </div>
    </div>
  </div>
</section> --}}
<!-- /funfacts -->

<!-- success story -->
<!-- <section class="section bg-cover" data-background="../theme/images/backgrounds/success-story.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-4 position-relative success-video">
        <a class="play-btn venobox" href="https://youtu.be/nA1Aqp0sPQo" data-vbtype="video">
          <i class="ti-control-play"></i>
        </a>
      </div>
      <div class="col-lg-6 col-sm-8">
        <div class="bg-white p-5">
          <h2 class="section-title">Success Stories</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- /success story -->

<!-- teachers -->
<!-- <section class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
          <h2 class="section-title">Our Teachers</h2>
        </div>
      
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-1.jpg" alt="teacher">
            <div class="card-body">
              <a href="/teacher-single">
                <h4 class="card-title">Jacke Masito</h4>
              </a>
              <div class="d-flex justify-content-between">
                <span>Teacher</span>
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-2.jpg" alt="teacher">
            <div class="card-body">
              <a href="/teacher-single">
                <h4 class="card-title">Clark Malik</h4>
              </a>
              <div class="d-flex justify-content-between">
                <span>Teacher</span>
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
       
        <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
          <div class="card border-0 rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-3.jpg" alt="teacher">
            <div class="card-body">
              <a href="/teacher-single">
                <h4 class="card-title">John Doe</h4>
              </a>
              <div class="d-flex justify-content-between">
                <span>Teacher</span>
                <ul class="list-inline">
                  <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
                  <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- /teachers -->
  
  @endsection

@push('scripts')
<!-- Animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script>
// Animation des compteurs
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.count').forEach(function(el) {
    let target = +el.getAttribute('data-count');
    let count = 0;
    let step = Math.ceil(target / 60);
    function update() {
      count += step;
      if(count > target) count = target;
      el.textContent = count;
      if(count < target) requestAnimationFrame(update);
    }
    update();
  });
});
</script>
@endpush

<style>
.funfact-box {
  transition: transform 0.2s, box-shadow 0.2s;
}
.funfact-box:hover {
  transform: translateY(-8px) scale(1.04);
  box-shadow: 0 8px 32px rgba(41,121,255,0.10);
}
.bg-cover {
     background-size: cover;
     background-repeat: no-repeat;
     background-position: center center;
   }
</style>
