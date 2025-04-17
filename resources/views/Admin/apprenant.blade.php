
<?php
$i=0;
$j=0;

?>

<div>

 @if(count($students) == 0)
<h4 class="m-3 text-center">Aucun apprenant  😓</h4>
@else
            <div class="table-responsive table-responsive-sm m-3">

              <table id="listUser" class="table table-striped  table-bordered col-9 mt-3  shadow  p-3 mb-5 bg-body rounded ">
              <thead class="mt-3">
                  <tr class="bg-dark" style="color:white;">
                  <th scope="col" style="color:white;">Nom</th>
                  <th scope="col" style="color:white;">Prenom</th>
                  <th scope="col" style="color:white;">Inscrit.e à</th>
                  <!-- <th scope="col" style="color:white;">Certificat obtenu</th> -->
                  <th scope="col" style="color:white;">Compte </th>


                  </tr>
              </thead>
              <tbody>
                   @foreach($students as $student)
                   @php( $formations = (is_array($student->formations))?$student->formations:json_decode($student->formations, true))
                  <tr>
                  <td>
                    @if($users[$student->id]['deleted_at']!=null)
                        <span class="text-danger">{{$users[$student->id]["nom"]}}   </span> 
                    @else
                        {{$users[$student->id]["nom"]}} 
                    @endif
                      
                  </td>
                  <td>
                    @if($users[$student->id]['deleted_at']!=null)
                        <span class="text-danger">{{$users[$student->id]["prenom"]}}   </span> 
                    @else
                        {{$users[$student->id]["prenom"]}}
                    @endif
                     
                  </td>
                  <td>
                    @if($users[$student->id]['deleted_at']!=null)
                        <span class="text-danger">  {{count($formations)}} formation(s)  </span> 
                    @else
                        {{count($formations)}} formation(s)
                    @endif
                  <td>
                    @foreach($formations as $formation)
                        @if($formation['status'] == 'certifier')
                            @php($i++)
                        @endif
                    @endforeach
                    @if($i==0)
                        Aucun
                    @else
                        {{$i}} certificat(s)
                    @endif

                      
                  </td>
                  <td>
                    <div >
                        <form action="javascript:void(0)" method="post">
                            @csrf 
                            <input type="hidden" id="slg{{$j}}" name="acts[]" value="{{$users[$student->id]['slug']}}">
                            <button class="btn bg-warning" type="submit" id="desactivation{{$j}}" data-element="{{$j}}" >
                              <span id="desabled{{$j}}">
                                @if($users[$student->id]['deleted_at']==null)
                                Desactiver
                                @else
                                Activer
                                @endif
                              </span>
                            
                            </button>

                        </form>
                    </div>
                    
                       
                        
                  </td>
                  </tr>
                  @php($j++)
                  @endforeach
              
              </tbody>
              <tfoot>
                <tr class="bg-dark" style="color:white;">
                    <th scope="col" style="color:white;">Nom</th>
                    <th scope="col" style="color:white;">Prenom</th>
                    <th scope="col" style="color:white;">Inscrit.e à</th>
                    <th scope="col" style="color:white;">Certificat obtenu</th>
                    <th scope="col" style="color:white;">Compte </th>
                  </tr>
              </tfoot>
              </table>

            </div>
            @endif
</div>
    <script>
        $(document).ready(function ()
        {
            var table_user = $('#listUser').DataTable( {
                lengthChange: false,
                buttons: ['excel', 'pdf']
            } );
         
            table_user.buttons().container()
                .appendTo( '#listUser_wrapper .col-md-6:eq(0)' );
        });

$(document).ready( function () {
    var trueResp = [];
    $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
            });

            $('input[name="acts[]"]').each((item, i) => {
              trueResp[item] = $(i).data('element');
              
            });

          $(trueResp).each((item, i) => {

            $('body').on('click', '#desactivation'+item, function (event) {
              var slug  = $("#slg"+item).val();
              var typeAction = $("#desabled"+item).html();
              
               // ajax
               $.ajax({
                      type:"POST",
                      url: typeAction.localeCompare('Activer') ?"{{ url('/active') }}": "{{ url('/desactive') }}",
                      data: {
                        slug : slug,
                        _token: '{{csrf_token()}}',
                      },
                      dataType: 'json',
                      success: function(res){
                        $("#desabled"+item).css('display', 'none');
                        console.log(res);
                        if(typeAction.localeCompare('Activer')){
                          $("#desactivation"+item).html('Activer');
                          } 
                          else if (typeAction.localeCompare('Desactiver')){
                            $("#desactivation"+item).html('Desactiver');
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
