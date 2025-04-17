@extends("Apprenant.app")
@section("content")
<?php
$i=0;
$rand = random_int(100,900);
?>
@if (session()->has('message'))

                      <div
                        class=" m-3 bs-toast toast fade show bg-success"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true"
                      >
                        <div class="toast-header">
                          <i class="bx bx-bell me-2"></i>
                          <div class="me-auto fw-semibold">Annonce</div>
                          <small>A l'instant</small>
                          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                        {{session()->get('message')}}
                        </div>
                      </div>
    @endif
                   

<a href="#form" class="" style="text-decoration:none"><h3 class="text-center mt-2 pb-4 ">Mes messages prives</h3></a>
<button type="button" class="btn-primary py-2 pb-2 m-3" style="color:white;" onclick="showForm('formMessage')";>Nouveau message prive</button>


<div>
  <form action="/requete" method="POST">
    @csrf
  <button type="submit" class="btn-primary py-2 pb-2 m-2 " id="supb" style="color:white; display:none;" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
  </svg><h4 id="sup" style="color:white;"></h4></button>
  <input type="hidden" class="d-none" name="total_checked" id="total_checked" >
</form>
<p class="m-3 " id="alerte"></p>
@if(count($requetes)==0)
    <h5 class="text text-center">Aucun message prive pour le moment.</h5>
    @else

<table class="table ">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" name="all_sup" id="all_sup" onclick="check()"> </th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col" class="text-dark">Dernier Message</th>
    </tr>
  </thead>
  <tbody>
    
    @foreach($requetes as $requete)
      <tr class="hoverable">
          <td><input type="checkbox" name="supprimer" data-element="{{$requete->id}}"  class="check " onclick="checkOnce(this)"></td>
          <td> 
                    <h5 class="col"><a href="/requete/{{$rand}}-{{$requete->nom}}" style="text-decoration:none " style="">{{$requete->nom}} </a></h5>
                    <p class="col">envoyer dans <strong> </strong> </p>

          </td>
          @if(count($reponse[$requete->id])==0)
          <td><h4> 
            0 Message </h4></td>
          <td>
                    <p class="col"> Aucun </p>
        </td>
        @else
        <td><h4> 
            {{count($reponse[$requete->id])}} Message(s)</h4></td>
          <td>
          <td>
                    <p class="col">{{date('d/m/Y H:i:s', strtotime($reponse[$requete->id][count($reponse[$requete->id])-1]['updated_at']))}}  par <strong>{{$users[$reponse[$requete->id][count($reponse[$requete->id])-1]['user_id']]->nom}} , </strong> </p>
        </td>
      @endif
      </a>

      </tr>
   @endforeach
  </tbody>
</table>
</div>
<button type="button" class="btn-primary py-2 pb-2 m-3" style="color:white;" onclick="showForm('formMessage')";>Nouveau message prive</button>
@endif

<div class="col-6 m-3 pb-2" style="display:none;" id="formMessage">
    <h5>Nouveau message prive</h5>
    <form action="/apprenant-requete" method="post" id="#form" class="" style="">
                    @csrf
                <div class="form-row">
                    <div class="d-flex">
                        <div class="col m-2">
                            <label>Titre</label>
                            <input type="text" class="form-control" id="titre" required="required" name="titre" value="">
                          </div>
                        <div class="col m-2">
                            <label>Formaition</label><br>
                            <select name="fmt_id"  id="fmt_id" class="form-control @error('category_id') is-invalid @enderror" id="" required="required" autofocus rows="2" cols="60">
                            @foreach($formation_iscrt as $fmt)
                            <option value="{{$fmt->id}}" >{{$fmt->titre}}</option>
                            @endforeach
                            </select>                    
                        </div>
                    </div>
                    <div class="col m-2">
                        <label>Description</label><br>
                        <textarea name="description" id="description" cols="70" rows="10" required="required"></textarea>
                    </div>
                    <button type="submit" class="button btn btn-primary   align-items-center"><span>Envoyer</span></button>
                </div>
                
                
            </form>
</form>
</div>
<style>
  .hoverable:hover{
    background-color:pink;
  }
  .hoverable:hover{
    background-color:indigo;
    color:white;
  }
</style>
<script>
  function showForm(elm){
        var element = document.getElementById(elm);

        if( element.style.display == 'none'){
          element.style.display = 'block';
        }else{
          element.style.display = 'none';

        }
      }

      var alerte = document.getElementById('alerte');
        var supText = document.getElementById('sup');
        var supButton = document.getElementById('supb');
        var total_checked = document.getElementById('total_checked');
        var val_checked=[];
      function check(){
        let i;
        let checks = document.getElementsByClassName('check');
        var element = document.getElementById('all_sup');
        
        if( element.checked == true){
          for( i=0; i<checks.length; i++){
            console.log(checks[i]);
            checks[i].checked = true;
            console.log($(checks[i]).data('element'));
            val_checked[i]= $(checks[i]).data('element');
          }
          
        }else{
          for(let j=0; j<checks.length; j++){
            checks[j].checked = false;
            val_checked =[];
          }
           
        }
        if(val_checked.length ==0){
          alerte.style.display = 'none';
          supButton.style.display = 'none';
        } else{
          alerte.style.display = 'block';
          supButton.style.display = 'block';
          alerte.innerHTML = 'Vous avez selectionne(e) '+ val_checked.length +' message(s)';
          supText.innerHTML = 'SUPRIMER '+ val_checked.length+' MESSAGE(S)';
        }
        
          total_checked.value = val_checked ;
          console.log(total_checked.value);

      }

      
      function checkOnce(checks){
          var element = $(checks).data('element');
            if( checks.checked == true){
              val_checked.push(element);
              alerte.style.display = 'block';
              supButton.style.display = 'block';
              alerte.innerHTML = 'Vous avez selectionne(e) '+ val_checked.length +' message(s)';
              supText.innerHTML = 'SUPRIMER '+val_checked.length+' MESSAGE(S)';
            }
            else if(checks.checked == false){
              if(val_checked.indexOf(element) !== -1){
                val_checked = val_checked.filter(val_check => val_check != element);
              }
            }
            if(val_checked.length ==0){
            alerte.style.display = 'none';
            supButton.style.display = 'none';
          }
            total_checked.value = val_checked ;

        console.log(total_checked.value);
      }
     


       
</script>
@endsection
