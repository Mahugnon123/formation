<div>
    @if(count($users) == 0)
        <h4 class="m-3 text-center text-muted">Aucun utilisateur 😓</h4>
    @else
        <div class="table-responsive m-3">
            <table id="listUsers" class="table table-striped table-bordered mt-3 shadow p-3 mb-5 bg-body rounded">
                <thead>
                    <tr style="background-color: rgb(96, 96, 98); font-family: 'Roboto', sans-serif;">
                        <th scope="col" style="color: white;">NOM</th>
                        <th scope="col" style="color: white;">PRÉNOM</th>
                        <th scope="col" style="color: white;">DATE D'INSCRIPTION</th>
                        <th scope="col" style="color: white;">TYPE</th>
                        <th scope="col" style="color: white;">ÉTAT</th>
                        <th scope="col" style="color: white;">COMPTE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user["nom"] }}</td>
                            <td>{{ $user["prenom"] }}</td>
                            <td>{{ date('d M Y à H:i', strtotime($user["created_at"])) }}</td>
                            <td>
                                @if($user["role_id"] == 1)
                                    Apprenant
                                @elseif($user["role_id"] == 2)
                                    Formateur
                                @endif
                            </td>
                            <td>{{ $user->deleted_at ? 'Inactif' : 'Actif' }}</td>
                            <td>
                                @if($user->role_id == 1) <!-- Apprenant -->
                                    @if($user->deleted_at == null) <!-- Actif = ouvert = bleu -->
                                        <form action="{{ route('users.deactivate', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn shadow-sm p-2" style="background-color: #0d6efd; border: 1px solid #0d6efd;">
                                                <i class="bi bi-unlock-fill text-white fs-5"></i>
                                            </button>
                                        </form>
                                    @else <!-- Inactif = fermé = rouge -->
                                        <form action="{{ route('users.activate', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn shadow-sm p-2" style="background-color: #dc3545; border: 1px solid #dc3545;">
                                                <i class="bi bi-lock-fill text-white fs-5"></i>
                                            </button>
                                        </form>
                                    @endif
                                @elseif($user->role_id == 2) <!-- Formateur -->
                                    @if($user->deleted_at == null) <!-- Actif = ouvert = bleu -->
                                        <form action="{{ route('users.archive', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn shadow-sm p-2" style="background-color: #0d6efd; border: 1px solid #0d6efd;">
                                                <i class="bi bi-unlock-fill text-white fs-5"></i>
                                            </button>
                                        </form>
                                    @else <!-- Inactif = fermé = rouge -->
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn shadow-sm p-2" style="background-color: #dc3545; border: 1px solid #dc3545;">
                                                <i class="bi bi-lock-fill text-white fs-5"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success m-3">
            {{ session('message') }}
        </div>
    @endif

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            min-width: 800px;
        }
        th {
            text-transform: uppercase;
            font-weight: 500;
        }
        .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .btn i {
            margin: 0;
        }
        #listUsers_wrapper .dt-buttons {
            float: left;
            margin-bottom: 1rem;
        }
        #listUsers_wrapper .dataTables_filter {
            float: right;
            margin-bottom: 1rem;
        }
        #listUsers_wrapper .dataTables_filter input {
            width: 200px;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.25rem;
            border: 1px solid #ced4da;
        }
        #listUsers_wrapper .dataTables_filter label {
            font-size: 0.875rem;
            color: #606264;
        }
    </style>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function () {
            var table_user = $('#listUsers').DataTable({
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: ' btn-sm'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        className: ' btn-sm'
                    }
                ],
                language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json"
    },
                order: [[2, 'desc']], // Trier par date d'inscription par défaut
                pageLength: 10
            });
        });
    </script>
</div>