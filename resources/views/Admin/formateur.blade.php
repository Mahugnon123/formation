<?php
$i=0;
$fmts = [];
$fmt_user = array();
$fmt_formateur =array();
?>
<div>

<a  href="#signupModal" data-toggle="modal" id="create" data-target="#signupModal" style="text-decoration:none"><button type="button" class="btn-primary py-2 pb-2 m-3" style="color:white;">Creer un formateur </button></a>
<!-- Modal -->
<div class="modal fade" id="signupModal" tab/="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Inscription</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <form method="POST" action="/formateur/create" class="row" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupPhone" name="nom" placeholder="Nom">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupName" name="prenom" placeholder="Prénom">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control mb-3" id="signupEmail" name="email" placeholder="Email">
                        </div>

                        <div class="col-12">
                             <select  class="form-control" name="sex">
                                  <option >
                                    Choisissez votre sexe
                                  </option>
                                  <option value="M">
                                    Masculin
                                  </option>
                                  <option value="F">
                                    Feminin
                                  </option>
                             </select>
                        </div> 

                        <div class="col-12 d-none">
                          <input type="hidden" name="role_id" value="2">
                        </div> 

                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="signupPassword" name="password" placeholder="Mot de passe">
                        </div>

                        <div class="d-flex">
                          <div class="col-6">
                              <button type="submit" class="btn btn-primary">S'inscrire</button>
                          </div>
                         
                        </div>
                        
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>

 @if(count($formateurs) == 0)
<h4 class="m-3 text-center" id="aucun">Aucun formateur  😓</h4>
@else
            <div  class="table-responsive table-responsive-sm m-3" id="fmt">

              <table id="listFormateur" class="table table-striped  table-bordered col-9 mt-3  shadow  p-3 mb-5 bg-body rounded ">
              <thead class="mt-3">
                  <tr class="bg-dark" style="color:white;">
                  <th scope="col" style="color:white;">Nom</th>
                  <th scope="col" style="color:white;">Prenom</th>
                  <th scope="col" style="color:white;">Email</th>

                  <th scope="col" style="color:white;">Formations</th>
                  <th scope="col" style="color:white;">Compte </th>


                  </tr>
              </thead>
              <tbody>
                   @foreach($formateurs as $formateur)
                  <tr>
                  <td>
                    @if($formateur->deleted_at!=null)

                     <span class="text-danger">{{$formateur->nom}}  </span> 
                    @else
                    {{$formateur->nom}}
                    @endif

                  </td>
                  <td>
                        @if($formateur->deleted_at!=null)

                        <span class="text-danger">{{$formateur->prenom}} </span> 
                        @else
                        {{$formateur->prenom}}
                        @endif
                  </td>
                  <td>
                    @if($formateur->deleted_at!=null)

                        <span class="text-danger">{{$formateur->email}}  </span> 
                        @else
                        {{$formateur->email}}
                    @endif
                  </td>
                  <td> 
                    @foreach($formations as $formation)
                        @if($formation->user_slug == $formateur->slug)
                            <?php array_push($fmt_formateur,$formation); ?>
                        @endif
                    @endforeach
                    <?php $fmt_user[$i]=$fmt_formateur ?>

                    @if(count($fmt_user[$i])==0)
                        Aucune
                    @else
                        {{count($fmt_user[$i])}} realisée(s)
                        @php($fmts = $fmt_user)
                        <button type="submit" class="btn rounded-pill btn-primary" data-element="formateur{{$i}}" onclick="formateur(this)";>voir tout</button>

                    @endif

                  </td>
                  <td>
                    <div id="">
                        <form action="javascript:void(0)" method="post">
                            @csrf
                            <input type="hidden" class="d-none" name="actions[]" id="slug{{$i}}"  value="{{$formateur->slug}}">
                            <button class="btn bg-warning" type="submit" data-element="{{$i}}"  id="desactive{{$i}}">
                           <span id="desactiver{{$i}}">
                            @if($formateur->deleted_at==null)
                                Desactiver
                                @else
                                Activer
                                @endif
                           </span>
                            
                            </button>
                        </form>
                    </div>
                  </td>
                  @php($i++)
                  </tr>
                  <?php $fmt_formateur= array() ?>
                  @endforeach
              
              </tbody>
              <tfoot>
              <tr class="bg-dark" style="color:white;">
                  <th scope="col" style="color:white;">Nom</th>
                  <th scope="col" style="color:white;">Prenom</th>
                  <th scope="col" style="color:white;">Email</th>
                  <th scope="col" style="color:white;">Formations</th>
                  <th scope="col" style="color:white;">Compte </th>
                  </tr>
              </tfoot>
              </table>

            </div>

            @for($j=0;$j< count($fmts);$j++)
            <div class="content-wrapper formations" style="display:none;background-color:#e4e5e7" id="" data-element="fmts{{$j}}">
            @php($k=0)
              <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                  <div class="col-lg-12 col-md-12 order-1">
                    <div class="row">
                        @foreach($fmts[$j] as $one_formation)
                        @if($fmts!= [] )
                          <?php $formts[$k] = $one_formation ?>
                        @endif
                        
                      <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card p-0 border-primary rounded-0 hover-shadow">
                          @if($formation->status == 'Valider')
                            <button class=" btn btn-info btn-sm">Status: {{$formation->status}}</button>
                          @else
                          <button class=" btn btn-warning btn-sm">Status: {{$formation->status}}</button>
                          @endif
                          <img class="card-img-top rounded-0" src="{{asset($one_formation->image_url)}}" alt="course thumb">
                          <div class="card-body">
                          <h4 class="text-color text-dark" href="course-single/{{$one_formation->slug}}">{{$one_formation->titre}} </h4>
                            <ul class="list-inline mb-2">
                            <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{$one_formation->created_at}}</li>
                            </ul>
                            <ul class="list-inline mb-2">
                              <li class="list-inline-item text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                                <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                                <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                              </svg> <strong class="text-dark">Certificat:</strong> 
                                @if( $one_formation->prix_certification!=null)
                                {{$one_formation->prix_certification}} XOF
                                @else
                                  Gratuite
                                @endif</li><br>
                                <li class="list-inline-item text-dark mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>  <strong class="text-dark"> Durée:</strong> {{$one_formation->duree}}
                              </li><br>
                              <li class="list-inline-item text-dark mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-credit-card-2-back" viewBox="0 0 16 16">
                                <path d="M11 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1z"/>
                                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm13 2v5H1V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm-1 9H2a1 1 0 0 1-1-1v-1h14v1a1 1 0 0 1-1 1z"/>
                              </svg> <strong class="text-dark">Prix:</strong> @if( $one_formation->prix_formation!=null)
                                {{$one_formation->prix_formation}} XOF
                                @else
                                  Gratuite
                                @endif</li>
                                <br>
                            </ul>
                              <button class=" btn btn-primary btn-sm" data-element="{{$k}}"  onclick="details(this)"; desabled>Voir le contenu</button>
                       
                      </div>
                    </div>
                  </div>
                      @php($k++)
                    @endforeach
                  </div>
                </div> 
              </div>
            </div>
          </div>

          @if($formts != [])  
          @for($i=0;$i< count($formts);$i++)
          <?php $formation = $formts[$i]; ?>
          <section class="section-sm formation_user" id="" style="display:none;" data-element="{{$j}}fmt{{$i}}">
          @if($formation->status!='Valider')
            <button type="button" class="btn btn-warning m-3" id="buttonValider{{$i}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
            </svg>&nbsp;Status: {{$formation->status}}</button>
            @else
            <button type="button" class="btn btn-success m-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check-square-fill" viewBox="0 0 16 16">
              <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
            </svg>&nbsp;Status: {{$formation->status}}</button>
            @endif

                <div class="row align-items-center ml-3 mb-5">
                  <div class="col-xl-3 order-1 col-sm-6 mb-4 mb-xl-0">
                    <h3>{{$formation->titre}}</h3>
                  </div>
                  <div class="col-xl-6 order-sm-3 order-xl-2 col-12 order-2">
                    <ul class="list-inline text-xl-center">
                      <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                          <i class="ti-book text-primary icon-md mr-2"></i>
                          <div class="text-left">
                            <h6 class="mb-0">Durée</h6>
                            <p class="mb-0">{{$formation->duree}}</p>
                          </div>
                        </div>
                      </li>
                    
                      <li class="list-inline-item mr-4 mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                          <i class="ti-wallet text-primary icon-md mr-2"></i>
                          <div class="text-left">
                            <h6 class="mb-0">Prix</h6>
                            @if($formation->prix_formation==null)
                            <p class="mb-0">0 FCFA</p>
                            @else
                            <p class="mb-0">{{$formation->prix_formation}} fcfa</p>
                            @endif
                            <!-- <p class="mb-0">From: $699</p> -->
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                 
                  <!-- border -->
                  <div class="col-12 ml-3 order-4">
                    <div class="border-bottom border-primary"></div>
                  </div>
                </div>
                <!-- course details -->
                <div class="row ml-3">
                  <div class="col-12 mb-4">
                    <h3>A propos de la formation</h3>
                    <p>{{$formation->a_propos}}</p>
                  </div>

                  <?php 
                    $besoin=json_decode($formation->besoin);
                    $contenu=json_decode($formation->Contenu);
                    $competence=json_decode($formation->competence);
                    $chapitre = json_decode($formation->chapitre);
                    ?>
                  <div class="col-12 mb-12">
                    <h3 class="mb-3">Pre-requis necessaires</h3>
                    <div class="col-12 px-0">
                      <div class="row">
                        <div class="col-md-12">
                          <ul class="list-styled">
                            @foreach($besoin as $one_besoin)
                            <li>{{$one_besoin->value}}</li>
                            @endforeach
                          </ul>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-4 m-3">
                    <h3 class="mb-3">Ce que vous allez apprendre</h3>
                    <ul class="list-styled">
                      @foreach($contenu as $one_contenu)
                      <li>{{$one_contenu->value}}</li>
                      @endforeach
                    </ul>
                  </div>

                  <div class="col-12 mb-4">
                    <h3 class="mb-3">Compétence à acqueri</h3>
                    <ul class="list-styled">
                      @foreach($competence as $one_competence)
                      <li>{{$one_competence->value}}</li>
                      @endforeach
                    </ul>
                  </div>



                  <div class="container m-3">
                <div class="row">

                  
                  <div class="col-md-11">
                        @foreach($chapitre as $one_chapitre)
                      <div class="d-md-table mb-4 w-100 border-bottom hover-shadow">
                        <div class="d-md-table-cell px-4 vertical-align-middle mb-4 mb-md-0">
                          <span class="  h3 mb-3 d-block text-dark">{{$one_chapitre->intitule}}</span>
                          <div class="col-xl-6 col-sm-4  col-md-7 ">
                            <video width="100%"  height="100%" controls > <source src="{{$one_chapitre->video_url}}" type=video/ogg>
                          </video>
                          </div>
                         
                          @if(strlen($one_chapitre->chapitre_description)>200)
                          <p class="mb-0"> {{substr($one_chapitre->chapitre_description,0,200)}}...</p>
                          @else
                          <p class="mb-0"> {{$one_chapitre->chapitre_description}}</p>
                          @endif
                        </div>
                      </div>
                    @endforeach
                  </div>
                  
                  @if($one_formation->status!='Valider')
                  <form action="javascript:void(0)" method="post">
                          @csrf 
                          <input type="hidden" id="status{{$i}}" value="Valider">
                          <input type="hidden" name="status[]" data-element="{{$i}}" id="slug_status{{$i}}" value="{{$one_formation->slug}}">

                          <button type="submit" class="btn btn-outline-success" id="VldStatus{{$i}}"><h3>Valider la formation</h3> 
                            </button>
                        </form>
                        @endif
                </div>
                  
                </div>
              </div>
            </section>
            @endfor
            @endif

          @endfor
  @endif
   
</div>
<script>
        $(document).ready(function ()
        {
            var table_user = $('#listFormateur').DataTable( {
                lengthChange: false,
                buttons: ['excel', 'pdf']
            } );
         
            table_user.buttons().container()
                .appendTo( '#listFormateur_wrapper .col-md-6:eq(0)' );
        });
   </script>
        <script>


        let formation_user = document.getElementsByClassName('formation_user');
        let fmt = document.getElementById('fmt');
        let fmtsSee = document.getElementById('fmtsSee');
        let fmtSee = document.getElementById('fmtSee');

        let fmts = document.getElementsByClassName('formations');
        function formateur(elm){

         fmateur = $(elm).data('element');
     
          for(var i=0; i<fmts.length; i++){
            var formation = $(fmts[i]).data('element');
            if( formation.substr(4)  == fmateur.substr(9) && fmts[i].style.display == 'none' ){
              fmt.style.display = 'none';
              fmts[i].style.display = 'block';
              fmtsSee.style.display = 'block';
              console.log(fmtsSee);

              for(var j=0; j<formation_user.length; j++){
                formation_user[j].style.display = 'none';
              }
              break;
            }
          }
          
        }

        function details(elm){
          for(var j=0; j<formation_user.length; j++){
            var fmtn = $(formation_user[j]).data('element');
            var elmActuel = $(elm).data('element')
          
            if( fmtn.substr(4)  == elmActuel && fmtn.substr(0,1) == fmateur.substr(9) && formation_user[j].style.display == 'none' ){
              for(var i=0; i<fmts.length; i++){
                fmts[i].style.display = 'none';
              }
              formation_user[j].style.display = 'block';
              fmtSee.style.display = 'block';
              break;
          }
        }
        }

///** */
/**Changer le status d'une formation a valider */

$(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });

            $('input[name="status[]"]').each((item, i) => {
              trueResp[item] = $(i).data('element');
              
            });

          $(trueResp).each((item, i) => {

            $('body').on('click', '#VldStatus'+item, function (event) {
              var status  = $("#status"+item).val();
              var slug  = $("#slug_status"+item).val();              

               // ajax
               $.ajax({
                type:"POST",
                      url: "{{ url('/formation-status') }}",
                      data: {
                        status : status,
                        slug : slug,


                        _token: '{{csrf_token()}}',
                      },
                      dataType: 'json',
                      success: function(res){
                        
                        console.log(res);
                        $("#VldStatus"+item).css('display', 'none');
                        $("#buttonValider"+item).html("Status: "+res);

                      },
                      error: function (data, textStatus, errorThrown) {
                     console.log(data);
                      },

                    });
                    

      });
          });
});


/** */
$(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });
            $('input[name="actions[]"]').each((item, i) => {
              trueResp[item] = $(i).data('element');
            });

          $(trueResp).each((item, i) => {

            $('body').on('click', '#desactive'+item, function (event) {
              var urlStatus;
              var slug  = $("#slug"+item).val();
              var typeAction = $("#desactiver"+item).html();
              typeAction = typeAction.split(' ').join('');
             // var des = 'Desactiver';
              console.log(typeAction);
                 urlStatus = (typeAction.localeCompare("Desactiver"))? "{{ url('/desactive/formateur') }}" : "{{ url('/active/formateur') }}";
              
               // ajax
               $.ajax({
                      type:"POST",
                      url: urlStatus,
                      data: {
                        slug : slug,
                        _token: '{{csrf_token()}}',
                      },
                      dataType: 'json',
                      success: function(res){

                        if(typeAction.localeCompare("Activer")){
                          $("#desactiver"+item).css('display', 'none');
                          $("#desactive"+item).html('Desactiver');
                        }else if(typeAction.localeCompare("Desactiver")) {
                          $("#desactiver"+item).css('display', 'none');

                          $("#desactive"+item).html('Activer');
                          console.log('Activer');
                        }

                      },
                      error: function (data, textStatus, errorThrown) {
                     console.log(data);
                      },

                    });
                    

      });
          });
        });
          

            </script>

