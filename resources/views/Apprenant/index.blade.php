@extends("Apprenant.app")
@section("content")

<?php 
$formation=($userformation == null)?[]:json_decode($userformation->formations);
//$formations = $userformation->formations;
$formations = $formation_all ;
$tauxFmt=0;
$tauxCertif=0;
$fmts = [];
$j=0;
foreach($formation as $fmt){
  if($fmt->progression ==100){
    $tauxFmt+=1;
  }
  if($fmt->status =='certifier'){
    $tauxCertif+=1;
  }
}

$formation=($userformation == null)?[]:json_decode($userformation->formations,true);

foreach($formations as $frmt){
  foreach($formation as $fmt){
    if($frmt->id==$fmt['id']){
          $fmts[$j]= [
              "fmt" =>$frmt,
              "progression"=> $fmt['progression'],
              
          ];
          $j++;
  }
  }
}

$taux =(count($formation)==0)?0 : round(($tauxFmt*100)/count($formation),2);
/**les formation et leur suivis */

 ?>
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
                            Vous vous etes inscrit.e à <span class=" fw-bold" style="font-size:22px;">{{count($formation)}}</span> formation(s) sur la platform. Dans votre espace apprenant, vous avez la possibilite de voir et suivre l'evolution de vos differentes formations.
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
            @if($fmts == null)
            <h4 class="mt-3">Aucune formation inscrite 😓</h4>
            @else
            <div class="table-responsive table-responsive-sm">

              <table class="table table-striped  table-bordered col-9 mt-3  shadow  p-3 mb-5 bg-body rounded ">
              <thead class="mt-3">
                  <tr class="bg-dark" >
                  <th scope="col" style="color:white;">Formations</th>
                  <th scope="col" style="color:white;">Inscription</th>
                  <th scope="col" style="color:white;">Progression</th>
                  <th scope="col" style="color:white;">Certificat</th>

                  </tr>
              </thead>
              <tbody>
                  @for($i=0;$i< count($fmts); $i++)
                  <tr>
                  <td><a href="/apprenant-suivi/{{$fmts[$i]['fmt']->slug}}" class=" text-decoration-none">
                      {{$fmts[$i]["fmt"]->titre}} </a>
                  </td>
                  <td>
                  {{date('d/m/Y ', strtotime($fmts[$i]["fmt"]->created_at))}}
                      
                  </td>
                  <td class="col ">
                    @if($fmts[$i]['progression']==0)
                    <div class=" bg-secondary border rounded-pill mb-2" style="margin:8px,0px,8px; padding:4px;color:white; width:50px"><span class="text text-center m-2 fw-bold">{{$fmts[$i]['progression']}}%</span></div>
                    @else
                    <div class=" bg-success border rounded-pill mb-2" style="margin:8px,0px,8px; padding:4px;color:white; width:50px"><span class="text text-center m-2 fw-bold">{{$fmts[$i]['progression']}}%</span></div>
                    @endif
                      <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: {{$fmts[$i]['progression']}}%;" aria-valuenow="{{$fmts[$i]['progression']}}" aria-valuemin="0" aria-valuemax="100"><span class="text-dark"></span></div>
                      </div>
                  </td>
                  <td>
                  
                    @if($fmts[$i]['progression'] == 100)
                      <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                        </svg> 
                        <p><a href="">Obtenir le certificat</a></p>
                      </div>
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="gray" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                      <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                      <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                      </svg>
                      @endif
                      
                  </td>
                  </tr>
                  @endfor
              
              </tbody>
              </table>
            </div>
                <!-- Total Revenue -->
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
                          <h3 class="card-title mb-2">{{$taux}}%</h3>
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
                          <h3 class="card-title mb-2">{{$tauxCertif}}</h3>
                        </div>
                      </div>
                    </div>
                </div> 
                <div class="m-1"></div>
                
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 ">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-3">Suivi des Formations</h5>
                        <div id="totalRevenueChart" class="px-2"></div>
                      </div>
                      <div class="col-md-4">
                        <div class="card-body">
                          <div class="text-center">
                            <div class="dropdown">
                              <button
                                class="btn btn-sm btn-outline-primary dropdown-toggle"
                                type="button"
                                id="growthReportId"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                              >
                                2022
                              </button>
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                <a class="dropdown-item" href="javascript:void(0);">2019</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="growthChart"></div>
                        <div class="text-center fw-semibold pt-3 mb-2">62% De formation suivies</div>

                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2022</small>
                              <h6 class="mb-0">60%</h6>
                            </div>
                          </div>
                          <div class="d-flex">
                            <div class="me-2">
                              <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                            </div>
                            <div class="d-flex flex-column">
                              <small>2021</small>
                              <h6 class="mb-0">41.2%</h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div> 
               
                <!--/ Transactions -->
              </div>
            </div>
          </div>
            <!-- / Content -->
          

              @endif


@endsection