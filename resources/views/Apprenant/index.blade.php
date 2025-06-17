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
      <div id="listUser" class="table-responsive table-responsive-sm m-3">
        <table class="table table-striped table-bordered col-9 mt-3 shadow p-3 mb-5 bg-body rounded">
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
                {{date('d/m/Y', strtotime($fmt['fmt']->created_at))}}
              </td>
              <td>
                @php
                  $progression = isset($fmt['progression']) ? round($fmt['progression'], 2) : 0;
                @endphp
                <div class="d-flex justify-content-center align-items-center">
                  @if($progression == 0)
                  <div class="bg-secondary border rounded-pill" style="padding:4px;color:white; width:60px">
                    <span class="text text-center m-2 fw-bold">{{$progression}}%</span>
                  </div>
                  @else
                  <div class="bg-success border rounded-pill" style="padding:4px;color:white; width:60px">
                    <span class="text text-center m-2 fw-bold">{{$progression}}%</span>
                  </div>
                  @endif
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class=" row">
        <div class="row ">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="../assets/img/icons/unicons/chart-success.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-bold d-block mb-1">Formation Terminees</span>
                <h3 class="card-title mb-2">
                  @if(isset($tauxFmt))
                    {{ $tauxFmt }}
                  @else
                    {{ collect($fmts)->where('progression', 100)->count() }}
                  @endif
                </h3>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 ">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="../assets/img/icons/unicons/wallet-info.png"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                </div>
                <span class="fw-bold d-block mb-1">Certification Obtenues </span>
                <h3 class="card-title mb-2">{{ $tauxCertif ?? 0 }}</h3>
              </div>
            </div>
          </div>
        </div> 
        <div class="m-1"></div>
      </div>
      @endif
      <script>
        $(document).ready(function() {
          var table_user = $('#listUser table').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
          });
          table_user.buttons().container()
            .appendTo('#listUser_wrapper .col-md-6:eq(0)');
        });
      </script>
@endsection