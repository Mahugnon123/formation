@extends("Apprenant.app")
@section("content")

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-12 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Deja de retour 🎉 Bienvenu  <span class="text-dark">{{auth()->user()->nom}}</span>!</h5>
                <p class="mb-4">
                  Vous vous etes inscrit.e à <span class=" fw-bold" style="font-size:22px;">{{count($fmts)}}</span> formation(s) sur la platform. Dans votre espace apprenant, vous avez la possibilite de voir et suivre l'evolution de vos differentes formations.
                </p>
                <a href="/apprenant-formation" class="btn btn-sm btn-outline-primary">Mes Formations</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="../assets/img/illustrations/man-with-laptop-light.png"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div> 
      <div class="container">
        <h3 class=" text-secondary  text-start pb-1">
          Les cours suivis
        </h3>
        <div class="bg-info row align-self-center col-12 mt-1" style=" height: 1px; width:100%;"></div>
      </div>
      @if(empty($fmts))
      <div class="text-center">
        <img src="{{asset('no-formation.svg')}}" alt="" height="250px"><br><br>
        <h4 style="color:#015a98">Aucune formation</h4>
      </div> 
      @else
      <div id="listUser" class="table-responsive m-2">
<pre>
@foreach($fmts as $fmt)
    Formation: {{ $fmt['fmt']->titre ?? '' }} | Date inscription: {{ $fmt['date_inscription'] ?? 'Aucune' }}
@endforeach
</pre>        <table class="table table-striped table-bordered table-sm w-100 mt-2 mb-2">
          <thead class="mt-3">
            <tr class="bg-dark" style="color:white;">
              <th scope="col" style="color:white;">Formations</th>
              <th scope="col" style="color:white;">Inscription</th>
              <th scope="col" style="color:white;">Progression</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fmts as $fmt)
            <tr>
              <td>
                <a href="/apprenant-suivi/{{$fmt['fmt']->slug}}" class="text-decoration-none">
                  {{$fmt['fmt']->titre}}
                </a>
              </td>
              <td>
    @php
        $date = isset($fmt['date_inscription']) ? \Carbon\Carbon::parse($fmt['date_inscription'])->format('d/m/Y') : '';
    @endphp
    {{ $date }}
</td>
              <td>
                @php
                  $progression = isset($fmt['progression']) ? round($fmt['progression'], 2) : 0;
                  if($progression == 100) {
                      $badgeColor = 'background-color:#18804b;'; // vert foncé
                  } elseif($progression == 0) {
                      $badgeColor = 'background-color:#6c757d;'; // gris
                  } else {
                      $badgeColor = 'background-color:#1976d2;'; // bleu vif pour 1-99%
                  }
                @endphp
                <div class="d-flex justify-content-center align-items-center">
                  <div class="border rounded-pill"
                       style="padding:4px; color:white; width:60px; height:32px; {{$badgeColor}} display:flex; align-items:center; justify-content:center;">
                    <span class="text text-center fw-bold" style="font-size:0.95em; width:100%;">{{$progression}}%</span>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="row g-4 mb-4">
        <div class="col-12 col-md-6">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
              <div class="icon-box me-3">
                <i class="bi bi-mortarboard graduation-icon"></i>
              </div>
              <div>
                <div class="fw-bold text-secondary mb-1" style="font-size:1.1em;">Formation Terminées</div>
                <div class="display-5 fw-bold" style="color:#1976d2;">{{ isset($tauxFmt) ? $tauxFmt : collect($fmts)->where('progression', 100)->count() }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="card h-100 shadow-sm border-0">
            <div class="card-body d-flex align-items-center">
              <div class="icon-box me-3">
                <i class="bi bi-award award-icon"></i>
              </div>
              <div>
                <div class="fw-bold text-secondary mb-1" style="font-size:1.1em;">Certification Obtenues</div>
                <div class="display-5 fw-bold" style="color:#1976d2;">{{ $tauxCertif ?? 0 }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      <script>
        $(document).ready(function() {
          var table_user = $('#listUser table').DataTable({
            lengthChange: false,
            responsive: true,
            scrollX: true,
            buttons: ['excel', 'pdf']
          });
          table_user.buttons().container()
            .appendTo('#listUser_wrapper .col-md-6:eq(0)');
        });
      </script>
@endsection

<style>
.icon-box {
  background: #e3f0fc;
  border-radius: 12px;
  padding: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.graduation-icon {
  color: #1976d2;
  font-size: 2.5rem;
}
.award-icon {
  color:rgb(8, 89, 47);
  font-size: 2.5rem;
}
@media (max-width: 767px) {
  .icon-box {
    padding: 12px;
  }
  .graduation-icon, .award-icon {
    font-size: 2rem;
  }
}
</style>