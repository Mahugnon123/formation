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

@php
    \Log::info('Début du rendu de la vue suivi.blade.php');
    \Log::info('Valeur de $fmts: ' . print_r($fmts, true));
@endphp

<pre style="background: #f5f5f5; padding: 10px; margin: 10px; border: 1px solid #ddd;">

</pre>

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
                    @php
                        \Log::info('Traitement de la formation dans la vue: ' . json_encode($fmt));
                    @endphp
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
                                \Log::info('Progression calculée: ' . $progression);
                            @endphp
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    @if($progression == 0)
                                        <div class="bg-secondary border rounded-pill" style="padding:4px;color:white; width:50px">
                                            <span class="text text-center m-2 fw-bold">{{$progression}}%</span>
                                        </div>
                                    @else
                                        <div class="bg-success border rounded-pill" style="padding:4px;color:white; width:50px">
                                            <span class="text text-center m-2 fw-bold">{{$progression}}%</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="progress flex-grow-1" style="height: 20px;">
                                    <div class="progress-bar {{$progression == 0 ? 'bg-secondary' : 'bg-success'}}" 
                                         role="progressbar" 
                                         style="width: {{$progression}}%;" 
                                         aria-valuenow="{{$progression}}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        {{$progression}}%
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<script>
    $(document).ready(function() {
        var table_user = $('#listUser').DataTable({
            lengthChange: false,
            buttons: ['excel', 'pdf']
        });
        
        table_user.buttons().container()
            .appendTo('#listUser_wrapper .col-md-6:eq(0)');
    });
</script>

@endsection
