<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    .table-responsive {
        min-width: 100%;
        overflow-x: auto;
    }
    #listUser {
        width: 100% !important;
        font-size: 14px;
    }
    #listUser th, #listUser td {
        white-space: nowrap;
        padding: 8px;
    }
    @media (max-width: 768px) {
        #listUser th, #listUser td {
            font-size: 12px;
            padding: 4px;
        }
    }
</style>

<div class="table-responsive table-responsive-sm m-3">
    <table id="listUser" class="table table-striped table-bordered col-12 mt-3 shadow p-3 mb-5 bg-body rounded">
        <thead class="mt-3">
            <tr style="background-color:rgb(96, 96, 98);  font-family:'Roboto', sans-serif;">
                <th scope="col" style="color:white;">NOM</th>
                <th scope="col" style="color:white;">PRÉNOM</th>
                <th scope="col" style="color:white;">INSCRIT.E À</th>
                <th scope="col" style="color:white;">CERTIFICATS</th>
                <th scope="col" style="color:white;">COMPTE</th>
            </tr>
        </thead>
        <tbody></tbody>
     {{--    <tfoot>
            <tr class="bg-dark" style="color:white; font-family:'Roboto', sans-serif;">
                <th scope="col">NOM</th>
                <th scope="col">PRÉNOM</th>
                <th scope="col">INSCRIT.E À</th>
                <th scope="col">CERTIFICATS</th>
                <th scope="col">COMPTE</th>
            </tr>
        </tfoot> --}}
    </table>
</div>

<!-- jQuery et DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
   $(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#listUser')) {
        $('#listUser').DataTable().destroy();
    }

    var table_user = $('#listUser').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route("admin.students.data") }}',
        columns: [
            { data: 'nom', name: 'nom' },
            { data: 'prenom', name: 'prenom' },
            { data: 'formations', name: 'formations' },
            { data: 'certificats', name: 'certificats' },
            {
                data: 'compte',
                name: 'compte',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    var isActive = data.includes('Désactiver');
                    var iconClass = isActive ? 'fa-lock-open' : 'fa-lock';
                     var colorClass = isActive ? 'bg-primary' : 'bg-danger'; // couleur de fond bleue ou rouge
                     var actionText = isActive ? 'Désactiver' : 'Activer';
                      return `
                         <input type="hidden" id="slg${row.id}" value="${row.slug}">
                         <div class="${colorClass}" style="display: inline-block; padding: 6px; border-radius: 5px;">
                            <i class="fas ${iconClass}" id="desactivation${row.id}" style="cursor: pointer; color: white; font-size: 30px;" title="${actionText}"></i>
                        </div>
                        <span id="desabled${row.id}" style="display: none;">${actionText}</span>
                        `;
                }

            }
        ],
        lengthChange: false,
        paging: true,
        searching: true,
        dom: 'Bfrtip',
        buttons: ['excel', 'pdf'],
          language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
    }
    });

    table_user.buttons().container().appendTo('#listUser_wrapper .col-md-6:eq(0)');

    var trueResp = [];
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    table_user.on('draw', function () {
        $('i[id^="desactivation"]').off('click').on('click', function () {
            var id = $(this).attr('id').replace('desactivation', '');
            var slug = $("#slg" + id).val();
            var typeAction = $("#desabled" + id).html().trim();

            $.ajax({
                type: "POST",
                url: typeAction === 'Activer'
                    ? '/users/' + slug + '/activate'
                    : '/users/' + slug + '/deactivate',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (res) {
                    $("#desabled" + id).css('display', 'none');
                    // Mettre à jour l'icône et le texte après l'action
                    var newActionText = typeAction === 'Activer' ? 'Désactiver' : 'Activer';
                    var newIconClass = typeAction === 'Activer' ? 'fas fa-lock text-danger' : 'fas fa-lock-open text-primary';
                    $("#desactivation" + id).removeClass().addClass(newIconClass);
                    $("#desabled" + id).html(newActionText);
                    table_user.ajax.reload();
                },
                error: function (data, textStatus, errorThrown) {
                    console.log(data.responseText);
                }
            });
        });
    });
});
</script>