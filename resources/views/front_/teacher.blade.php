@extends("front.app")
@section("content")
<!-- page title -->
<section class="page-title-section overlay" data-background="../theme/images/backgrounds/page-title.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb mb-2">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="/index">Home</a></li>
          <li class="list-inline-item text-white h3 font-secondary nasted">Our teacher</li>
        </ul>
        <p class="text-lighten mb-0">Our courses offer a good compromise between the continuous assessment favoured by some universities and the emphasis placed on final exams by others.</p>
      </div>
    </div>
  </div>
</section>
<!-- /page title -->

<!-- teachers -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- teacher category list -->
        <ul class="list-inline text-center filter-controls mb-5">
          <li class="list-inline-item m-3 text-uppercase active" data-filter="all">All</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="arts">arts</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="bio-science">biological science</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="business-study">business studies</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="law">law</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="pharmacy">pharmacy</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="science">science</li>
          <li class="list-inline-item m-3 text-uppercase" data-filter="social-science">social science</li>
        </ul>
      </div>
    </div>
    <!-- teacher list -->
    <div class="row filtr-container">
      <!-- teacher -->
      <div data-category="arts, law" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-1.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Jacke Masito</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="bio-science" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-2.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Clark Malik</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="business-study" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-3.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">John Doe</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="bio-science, science arts" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-1.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Alex Rook</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="law" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-2.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Din Martin</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="science" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-3.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Raka Jim</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="bio-science" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-1.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Devid Luis</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="pharmacy, social-science, arts" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-2.jpg" alt="teacher">
          <div class="card-body">
            <a href="/teacher-single">
              <h4 class="card-title">Zim Cook</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="https://facebook.com/themefisher"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://github.com/themefisher"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="https://instagram.com/themefisher/"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div data-category="business-study" class="col-lg-4 col-sm-6 mb-5 filtr-item">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="../theme/images/teachers/teacher-3.jpg" alt="teacher">
          <div class="card-body">
            <a href="teacher-single">
              <h4 class="card-title">Duis Riu</h4>
            </a>
            <p>Teacher</p>
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
</section>
<!-- /teachers -->

@endsection
</body>
</html>