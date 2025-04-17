@extends("Apprenant.app")
@section("content")
<div class="container">
  <h5 class="text-center mt-2"> <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#015a98" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
    <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
    <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
    <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
    </svg> Voir et modifier vos divers resumes des chapitres de chaque formation en toute faciliter.
    <div class="bg-secondary row align-self-center col-12" style="w-100; height: 1px"></div>

  </h5>
</div>
            @if($fmts == null)
            <div class="text-center">
              <img src="{{asset('no-formation.svg')}}" alt="" height="250px"><br><br>
              <h4 style="color:#015a98">Aucune formation </h4>
            </div> 
            @else
            <div id="listUser" class="table-responsive table-responsive-sm m-3">

              <table class="table table-striped  table-bordered col-9 mt-3  shadow  p-3 mb-5 bg-body rounded ">
              <thead class="mt-3">
                  <tr class="bg-dark" style="color:white;">
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
              <tfoot>
              <tr class="bg-dark" style="color:white;">
                  <th scope="col" style="color:white;">Formations</th>
                  <th scope="col" style="color:white;">Inscription</th>
                  <th scope="col" style="color:white;">Progression</th>
                  <th scope="col" style="color:white;">Certificat</th>

                  </tr>
              </tfoot>
              </table>

            </div>
          @endif
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
   </script>

@endsection
