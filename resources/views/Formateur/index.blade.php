@extends("Formateur.app")
@section("content")
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">

<div class="col-lg-12 col-md-12 order-1">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/eye.jpg"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt3"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                
                              </button>
                              
                            </div>
                          </div>
                          <span>Nombre de vue</span>
                          <h3 class="card-title text-nowrap mb-1">{{ $nombreVues }}</h3>

                         <!--  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/apprenant.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="{{ route('formateur.apprenants') }}">Plus de details</a>
                              </div>
                            </div>  
                          </div>
                          <span>Apprenants</span>
                          <h3 class="card-title text-nowrap mb-1">{{ $nombreApprenants }}</h3>
                         <!--  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-6 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="../assets/img/icons/unicons/question.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="{{ route('formateur.requetes.index') }}">Plus de details</a>
                               
                              </div>
                            </div>  
                          </div>
                          <span>Questions</span>
                          <h3 class="card-title text-nowrap mb-1">{{ $nombreQuestions }}</h3>
                         <!--  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                      </div>
                    </div>


                     <div class="col-lg-3 col-md-3 col-6 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                             <a href="{{ url('/formations/'.Auth()->user()->slug)}}"> <img
                                src="../assets/img/icons/unicons/formation.png"
                                alt="Credit Card"
                                class="rounded"
                              /></a>
                            </div>
                            <div class="dropdown">
                              <button
                                class="btn p-0"
                                type="button"
                                id="cardOpt6"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                <a class="dropdown-item" href="{{ url('/formations/'.Auth()->user()->slug) }}">Plus de details</a>
                               
                              </div>
                            </div>  
                          </div>
                          <span>Formations</span>
                          <h3 class="card-title text-nowrap mb-1">{{ $nombreFormations }}</h3>
                         <!--  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 


         
              </div>
            </div>
            <!-- / Content -->

             <div class="col-12 mb-4">
              <div class="card shadow mx-4" style="border-radius: 16px; background: #fff;">
                <div class="card-body">
                  <h6 class="card-title" style="font-weight:600; color:#2563eb; margin-bottom:12px;">
                    <i class="fa fa-chart-line me-2"></i> Progression des vues
                  </h6>
                  <div id="vueChart" style="height: 320px; width: 100%;"></div>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'area',
                height: 340,
                width: '100%',
                toolbar: { show: false },
                zoom: { enabled: false },
                fontFamily: 'Inter, Arial, sans-serif',
                background: 'transparent'
            },
            series: [{
                name: 'Vues',
                data: @json($data)
            }],
            xaxis: {
                categories: @json($labels),
                title: {
                    text: 'Jours', // <-- Ajout du titre de l’axe X
                    style: { fontSize: '13px', color: '#64748b', fontWeight: 400 }
                },
                labels: {
                    rotate: -20,
                    style: { fontSize: '12px', colors: '#94a3b8' },
                    show: true,
                    // Affiche chaque date sous chaque point
                    formatter: function (val) {
                        return val;
                    }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                title: {
                    text: 'Nombre de vues', // <-- Ajout du titre de l’axe Y
                    style: { fontSize: '13px', color: '#64748b', fontWeight: 400 }
                },
                labels: {
                    style: { fontSize: '12px', colors: '#94a3b8' },
                    formatter: function (val) {
                        return Math.round(val); // Affiche sans virgule
                    }
                },
                min: 0,
                tickAmount: 4
            },
            colors: ['#2563eb'],
            stroke: {
                width: 4,
                curve: 'smooth',
                lineCap: 'round'
            },
            markers: {
                size: 7,
                colors: ['#fff'],
                strokeColors: '#2563eb',
                strokeWidth: 4,
                hover: { size: 11 }
            },
            grid: {
                borderColor: '#e0e7ef',
                row: { colors: ['#f1f5fd', 'transparent'], opacity: 0.6 }
            },
            tooltip: {
                theme: 'light',
                style: { fontSize: '15px', fontFamily: 'Inter, Arial, sans-serif' },
                marker: { show: true }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    gradientToColors: ['#60a5fa'],
                    inverseColors: false,
                    opacityFrom: 0.7,
                    opacityTo: 0.15,
                    stops: [0, 100]
                }
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                fontSize: '15px',
                fontWeight: 600
            }
        };
        var chart = new ApexCharts(document.querySelector("#vueChart"), options);
        chart.render();
    });
</script>
@endsection