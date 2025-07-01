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
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">Plus de details</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
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
                                <a class="dropdown-item" href="javascript:void(0);">Plus de details</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
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
                                <a class="dropdown-item" href="javascript:void(0);">Plus de details</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                              </div>
                            </div>  
                          </div>
                          <span>Question</span>
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
                                <a class="dropdown-item" href="javascript:void(0);">Plus de details</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
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
              <div class="card shadow" style="border-radius: 16px; background: #fff;">
                <div class="card-body">
                  <h6 class="card-title" style="font-weight:600; color:#2563eb; margin-bottom:12px;">
                    <i class="fa fa-chart-line me-2"></i> Progression des vues
                  </h6>
                  <div id="vueChart" style="height: 320px;"></div>
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
                height: 320,
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
                labels: {
                    rotate: -30,
                    style: { fontSize: '12px', colors: '#b0b0b0' },
                    show: true,
                    formatter: function (val, idx) {
                        return (idx % 4 === 0) ? val : '';
                    }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { fontSize: '12px', colors: '#b0b0b0' } },
                min: 0,
                tickAmount: 4
            },
            colors: ['#2563eb'],
            stroke: {
                width: 2.5,
                curve: 'smooth'
            },
            markers: {
                size: 3,
                colors: ['#fff'],
                strokeColors: '#2563eb',
                strokeWidth: 2,
                hover: { size: 6 }
            },
            grid: {
                borderColor: '#f1f1f1',
                row: { colors: ['#f8fafd', 'transparent'], opacity: 0.3 }
            },
            tooltip: {
                theme: 'light',
                style: { fontSize: '14px', fontFamily: 'Inter, Arial, sans-serif' },
                marker: { show: true }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.2,
                    gradientToColors: ['#93c5fd'],
                    inverseColors: false,
                    opacityFrom: 0.35,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },
            legend: { show: false }
        };
        var chart = new ApexCharts(document.querySelector("#vueChart"), options);
        chart.render();
    });
</script>
@endsection