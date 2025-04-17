<div>

 @if(count($users) == 0)
<h4 class="m-3 text-center">Aucun utilisateur  😓</h4>
@else
<div>



           <div class="table-responsive table-responsive-sm m-3">

              <table id="listUsers"  class="table table-striped  table-bordered col-9 mt-3  shadow  p-3 mb-5 bg-body rounded ">
              <thead class="mt-3">
                  <tr class="bg-dark" style="color:white;">
                  <th scope="col" style="color:white;">Nom</th>
                  <th scope="col" style="color:white;">Prenom</th>
                  <th scope="col" style="color:white;">Date d'inscription</th>
                  <th scope="col" style="color:white;">type</th>
                  <th scope="col" style="color:white;">Compte </th>
                  <th scope="col" style="color:white;">Action </th>

                  </tr>
              </thead>
              <tbody>
                   @foreach($users as $user)
                  <tr>
                  <td>
                        
                        {{$user["nom"]}} 
                    
                      
                  </td>
                  <td>
                   
                        {{$user["prenom"]}}
                     
                  </td>
                  <td>
                  {{date('jS M Y', strtotime($user["created_at"]))}} à {{date('H:i:s', strtotime($user["created_at"]))}}
                  <td>
                   @if($user["role_id"]==1)
                    Apprenant 
                    @elseif($user["role_id"]==2)
                        Formateur
                    @endif
                      
                  </td>
                  <td>
                  @if($user["deleted_at"]==null)
                   <span class="text-success">Activer </span>  
                    @else
                        <span class="text-danger">Achiver </span>  
                    @endif

                  </td>
                  <td>
                    <a href="">
                        <button class="btn-info">Voir plus</button>
                    </a>
                  </td>
                  </tr>
                  @endforeach
              
              </tbody>

              <tfoot>
                <tr class="bg-dark" style="color:white;">
                    <th scope="col" style="color:white;">Nom</th>
                    <th scope="col" style="color:white;">Prenom</th>
                    <th scope="col" style="color:white;">Date d'inscription</th>
                    <th scope="col" style="color:white;">type</th>
                    <th scope="col" style="color:white;">Compte </th>
                    <th scope="col" style="color:white;">Action </th>

                    </tr>
              </tfoot>
              </table>

            </div> 
            @endif
            </div>             
    <script>
        $(document).ready(function ()
        {
            var table_user = $('#listUsers').DataTable( {
                lengthChange: false,
                buttons: ['excel', 'pdf']
            } );
         
            table_user.buttons().container()
                .appendTo( '#listUsers_wrapper .col-md-6:eq(0)' );
        });
   </script>
            
