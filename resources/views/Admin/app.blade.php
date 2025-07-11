<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Tableau de bord des Administrateurs</title>
  <meta name="description" content="" />

  <link rel="icon" type="image/x-icon" href="/assets/img/favicon/bleuEdupulse.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>

  <!-- Boxicons -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

  <!-- Core CSS -->
  <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="/assets/css/demo.css" />

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />

  <!-- Bootstrap 4 CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- DataTables CSS (compatible with Bootstrap 4) -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

  <!-- Summernote CSS (compatible with Bootstrap 4) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" />

  <!-- Helpers -->
  <script src="/assets/vendor/js/helpers.js"></script>
  <script src="/assets/js/config.js"></script>
</head>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="/" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">
              <img src="{{ asset('blancEdupulse.png') }}"  width="100px">
            </span>
          </a>
          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1" style="background-color: #f8f9fa;">
          <!-- Dashboard -->
          <li class="menu-item active">
            <a href="/home" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div data-i18n="Analytics">Tableau de bord</div>
            </a>
          </li>

          <!-- Utilisateurs -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Utilisateurs</span>
          </li>
          <li class="menu-item {{ request()->is('users*', 'categorie*', 'formations*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-file"></i>
              <div>Utilisateurs</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                <a href="{{ url('/users') }}" class="menu-link">
                  <div>Les utilisateurs</div>
                </a>
              </li>
            </ul>
          </li>

          <!-- Formations -->
<li class="menu-header small text-uppercase">
  <span class="menu-header-text">Formations</span>
</li>

@php
  $formationMenuActive = request()->is('formations*') || 
                         request()->is('categorie*') || 
                         request()->is('categories*') || 
                         request()->is('message*') || 
                         request()->is('admin/notification*');
@endphp

<li class="menu-item open">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
    <i class="menu-icon tf-icons bx bx-dock-top"></i>
    <div>Formations</div>
  </a>
  <ul class="menu-sub">
   <li class="menu-item {{ request()->routeIs('formations.categorieSelection') ? 'active' : '' }}">
  <a href="{{ route('formations.categorieSelection') }}" class="menu-link">
    <div>Formations</div>
  </a>
</li>

    <li class="menu-item {{ request()->is('categorie*') || request()->is('categories*') ? 'active' : '' }}">
      <a href="{{ url('/categorie') }}" class="menu-link">
        <div>Les Catégories</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('message*') ? 'active' : '' }}">
      <a href="{{ url('/message') }}" class="menu-link">
        <div>Messages</div>
      </a>
    </li>

    <li class="menu-item {{ request()->is('admin/notification*') ? 'active' : '' }}">
      <a href="{{ url('/admin/notification') }}" class="menu-link">
        <div>Demandes</div>
      </a>
    </li>
  </ul>
</li>

        

          <!-- Support -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Support</span>
          </li>
          <li class="menu-item {{ request()->is('support') ? 'active' : '' }}">
            <a href="{{ url('/support') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-support"></i>
              <div>Support</div>
            </a>
          </li>
          <li class="menu-item {{ request()->fullUrlIs('https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/*') ? 'active' : '' }}">
            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="menu-link">
              <i class="menu-icon tf-icons bx bx-file"></i>
              <div>Documentation</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-light shadow-sm" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center w-100" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              

              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow d-flex flex-column align-items-center" href="#" data-toggle="dropdown">
                      <div class="avatar avatar-online mb-1">
                      <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="w-px-40 h-auto rounded-circle">
                     </div>
                   </a>
                      <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if(Auth::check() && Auth::user()->photo_profil)
                                                              <img src="{{ asset('storage/photo_profil/' . Auth::user()->photo_profil) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='{{ asset('assets/img/avatars/1.png') }}';" />
                                                                    @else
                                                                       <img src="{{ asset('assets/img/avatars/1.png') }}" class="rounded-circle" style="width: 40px; height: 40px;" />
                                                                    @endif

                                                      </div>
                                                   </div>

                                                 <div class="flex-grow-1">
                                    @if(Auth::check())
        <span class="fw-semibold d-block">{{ Auth::user()->nom }}</span>
    @else
        <span class="fw-semibold d-block text-muted">Utilisateur</span>
    @endif
</div>

                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
    <li>
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bx bx-power-off me-2"></i>
        <span class="align-middle">Se déconnecter</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </li>
  </ul>
</li>

            </ul>
          </div>
        </nav>
        <!-- / Navbar -->

        @if (request()->is('home'))
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card">
                <div class="d-flex align-items-center row">
                  <div class="col-sm-8">
                    <div class="card-body">
  <h4 class="card-title text-primary">Bienvenue, <span class="text-dark">{{ Auth::user()->nom }}</span> 👋</h4>
  <p class="mb-3">
    Ravi de vous retrouver dans votre espace d’administration. <br>
    En tant qu'administrateur, vous jouez un rôle clé dans le bon fonctionnement de la plateforme. <br>
    Merci pour votre implication et votre professionnalisme.
  </p>
</div>

                  </div>
                  <div class="col-sm-4 text-center">
                    <img
                      src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}"
                      height="120"
                      alt="Admin Illustration"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

        @yield("content")

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
              © <script>document.write(new Date().getFullYear());</script>,
              <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">Sinustic</a>
            </div>
            <div>
              <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
              <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
              <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
            </div>
          </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <!-- Core JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="/assets/vendor/js/menu.js"></script>
  <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="/assets/js/main.js"></script>
  <script src="/assets/js/dashboards-analytics.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- DataTables JS (compatible with Bootstrap 4) -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

  <!-- Summernote JS (compatible with Bootstrap 4) -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-fr-FR.min.js"></script>

  <!-- Section pour les scripts personnalisés -->
  @yield('scripts')

  <style>
    /* Pour éviter le débordement du menu utilisateur */
.dropdown-menu.dropdown-menu-end {
  right: 0 !important;
  left: auto !important;
  min-width: 180px;
}

.dropdown-item .bx {
  font-size: 1.2em;
  vertical-align: middle;
}

@media (max-width: 576px) {
  .dropdown-menu.dropdown-menu-end {
    min-width: 140px;
  }
  .dropdown-item span.align-middle {
    font-size: 13px;
  }
}
  </style>
</body>
</html>