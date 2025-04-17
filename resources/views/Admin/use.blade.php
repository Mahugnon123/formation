<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bootstrap 5 Black Color Datatable Example</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('datatables/js/jquery/jquery-ui.css')}}" media="screen,projection">
    <link rel="stylesheet" type="text/css" href="{{asset('datatables/css/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('datatables/css/datatable/buttons.bootstrap5.min.css')}}">
  </head>

  <body>
  <div class="container my-5" style="min-height: 63vh">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white text-center text-danger">
                   Liste des utilisateurs de la plateforme
                </div>
                <div class="card-body">
                   
           <table id="listUser" class="table table-bordered table-striped" style="width:100%">
           <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
                
                <tbody>
                <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>

            </table>
         </div>
            </div>
        </div>
    </div>

</div>
<script src="{{asset('datatables/js/jquery/jquery-3.6.0.min.js')}}"></script>
      <script src="{{asset('datatables/js/jquery/jquery-ui.js')}}"></script>   
      <script src="{{asset('datatables/js/bootstrap.js')}}"></script>
      <script src="{{asset('datatables/js/popper.min.js')}}"></script>
  <script src="{{asset('datatables/js/datatable/jquery.dataTables.min.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/dataTables.bootstrap5.min.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/dataTables.buttons.min.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/buttons.bootstrap5.min.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/jszip.min.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/pdfmake.min.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/vfs_fonts.js')}}" defer></script>
    <script src="{{asset('datatables/js/datatable/buttons.html5.min.js')}}" defer></script>

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
  </body>
</html>