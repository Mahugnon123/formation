<footer>
  {{-- <!-- newsletter -->
  <div class="newsletter">
    <div class="container">
      <div class="row">
        <div class="col-md-9 ml-auto bg-primary py-5 newsletter-block">
          <h3 class="text-white">Abonnez-vous maintenant</h3>
          <form action="#">
            <div class="input-wrapper">
              <input type="email" class="form-control border-0" id="newsletter" name="newsletter" placeholder="Entrer votre Email...">
              <button type="submit" value="send" class="btn btn-primary">Rejoindre</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> --}}
 
 <!-- footer content -->
<div class="footer bg-footer section border-bottom" style="padding-top:30px; margin-top:0;">
      <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
          <!-- logo -->
          <a class="logo-footer" href="index"><img class="img-fluid mb-4" src="{{ asset('bleuEdupulse.png') }}" width="100px;" alt="logo"></a>
          <p class="text-color mt-3 mb-4" style="font-size: 0.9em; line-height: 1.6;">
  Votre partenaire numérique pour l'innovation et la formation technologique au Bénin.
</p>
        </div>
        <!-- company -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">Accès rapide</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="/about">À propos</a></li>
            <li class="mb-3"><a class="text-color" href="/courses">Formation</a></li>
            <li class="mb-3"><a class="text-color" href="/contact">Contact</a></li>
            {{-- <li class="mb-3"><a class="text-color" href="/blog">Blog</a></li>
            <li class="mb-3"><a class="text-color" href="/blog">Events</a></li> --}}
          </ul>
        </div>
        <!-- links -->
        <!-- <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">LINKS</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="/courses">Courses</a></li>
            <li class="mb-3"><a class="text-color" href="/events">Events</a></li>
            
            <li class="mb-3"><a class="text-color" href="/scholarship">Scholarship</a></li>
          </ul>
        </div> -->
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">SUPPORT</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="#">Forums</a></li>
            <li class="mb-3"><a class="text-color" href="#">Documentation</a></li>
            
          </ul>
        </div>
        <!-- support -->
         <!-- support -->
<div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
  <h4 class="text-white mb-5">Contact</h4>
  <ul class="list-unstyled" style="color:#888;">
    <li class="mb-3">Adresse :<br>Bénin / Villa BCEAO,<br>Cité Houeyiho<br>non loin de la SBEE</li>
    <li class="mb-3">Tel :<br>(+229) 01 01 01 01<br>01 00 00 00 00</li>
    <li class="mb-3">contact@EduPulse.com</li>
  </ul>
</div>
      </div>
    </div>
  </div>
  <!-- copyright -->
  <div class="copyright py-4 bg-footer">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <p class="mb-0">Copyright &copy;
            <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script> 
            , designed & developed by <a href="#" class="text-muted">EduPulse</a>
          </p>
        </div>
        <div class="col-sm-5 text-sm-right text-center">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-facebook text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-twitter-alt text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-github text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-instagram text-primary"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
 

</footer>

  <style>
    .footer .text-color {
    color: #888 !important; /* gris doux */
}
.footer .text-color:hover {
    color: #fff !important; /* blanc au survol */
}
@media (max-width: 767.98px) {
    .footer .row {
        flex-wrap: wrap;
    }
    .footer .col-lg-2, .footer .col-lg-4 {
        margin-bottom: 2rem;
    }
    .footer .logo-footer {
        margin-bottom: 1rem;
    }
    .footer h4 {
        margin-bottom: 1rem !important;
    }
}
  </style>

<!-- /footer -->

