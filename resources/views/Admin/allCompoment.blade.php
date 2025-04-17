@extends("Admin.app")
@section("content")

<div class="col-12 ">
    <div class="card">
                    <nav class="card-header " style="color:#055d9b;" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                          <a href="javascript:void(0);" class="row justify-align-center" id="actuelle">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item" id="fmtsSee" style="display:none">
                          <a href="javascript:void(0);"  onclick="formateur()";>Formations </a>
                        </li>
                        <li class="breadcrumb-item " id="fmtSee" style="display:none">Formation </li>
                      </ol>
                  </nav>
                    <div class="card-body">
                      <p class="card-text">Consulter vos informations personnelles et les modifier.</p>

                      <p class="demo-inline-spacing">
                        <a
                          class="btn btn-primary me-1"
                          data-bs-toggle="collapse"
                          href="#multiCollapseExample1"
                          role="button"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample1"
                          data-element = "Utilisateurs"
                          onclick="actuel(this)";
                          >Utilisateurs</a
                        >
                        <button
                          class="btn btn-primary me-1"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#multiCollapseExample2"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample2"
                          data-element = "Formateurs"
                          onclick="actuel(this)"

                        >
                          Formateurs
                          <button
                          class="btn btn-primary me-1"
                          type="button"
                          data-bs-toggle="collapse"
                          data-bs-target="#multiCollapseExample3"
                          aria-expanded="false"
                          aria-controls="multiCollapseExample3"
                          data-element = "Apprenants"
                          onclick="actuel(this)";

                        >
                          Apprenants
                          </button>
                      </p>
                        <div class="row">
                          <div class="collapse multi-collapse" id="multiCollapseExample1" >
                              @include('Admin.users')
                          </div>
                        </div>
                        <div class="col-xxl">
                          <div class="collapse multi-collapse" id="multiCollapseExample2">
                              @include('Admin.formateur')
                          </div>
                        </div>
                        <div class="col-xxl">
                          <div class="collapse multi-collapse" id="multiCollapseExample3">
                              @include('Admin.apprenant')
                          </div>
                        </div>

            </div>
    </div>
</div>

<script>
  
    function actuel(elm){
      fmtsSee.style.display = 'none';
      fmtSee.style.display = 'none';
        var ongletActuel = document.getElementById('actuelle');
        var create = document.getElementById('create');
        var aucun = document.getElementById('aucun');
        var fmt = document.getElementById('fmt');
        var onglet1 = document.getElementById('multiCollapseExample1');
        var onglet2 = document.getElementById('multiCollapseExample2');
        var onglet3 = document.getElementById('multiCollapseExample3');

        var text = $(elm).data('element');
        if(text == 'Utilisateurs'){
          ongletActuel.innerHTML = text;

            onglet2.style.display = 'none';
            onglet3.style.display = 'none';
            if(onglet1.style.display == 'none'){
              onglet1.style.display = 'block';
              for(var i=0; i<fmts.length; i++){
                fmts[i].style.display = 'none';
                formation_user[i].style.display = 'none';
                
              }              
            }
        }
        else if(text == 'Formateurs'){
          ongletActuel.innerHTML = text;
            onglet1.style.display = 'none';
            onglet3.style.display = 'none';
            onglet2.style.display = 'block';
            if(fmt.style.display == 'none'){
              fmt.style.display = 'block';
              for(var i=0; i<fmts.length; i++){
                  fmts[i].style.display = 'none';
              }  
              for(var i=0; i<formation_user.length; i++){
                formation_user[i].style.display = 'none';
              }
            
            }
        }
        else if(text == "Apprenants"){
          ongletActuel.innerHTML = text;

            onglet1.style.display = 'none';
            onglet2.style.display = 'none';
            onglet3.style.display = 'block';
            if(onglet3.style.display == 'none'){
              onglet3.style.display = 'block';
              for(var i=0; i<fmts.length; i++){
                fmts[i].style.display = 'none';
                formation_user[i].style.display = 'none';
              }              
            }
            
        }
       
    }
</script>
@endsection
