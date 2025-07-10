<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Tableau de bord des Formateurs')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/SinusTic.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @yield('styles')
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">
                            <img src="{{ asset('SinusTic.png') }}" height="50px" width="100px">
                        </span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1" style="background-color:#f8f9fa;">
                    <li class="menu-item active">
                        <a href="/home" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Tableau de bord</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Formation</span>
                    </li>
<li class="menu-item {{ request()->is(
    'formations*',
    'questions*',
    'formateur/requetes*',
    'formateur/questions*',
    'formateur/messages*',
    'formateur/requetes*',
    'Vos formations*',
    'Nouvelle formation*',
    'Vos apprenants*',
    'Preocupations*',
    'Messages*',
    'gestion-questions-test*'
) ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Layouts">Formations</div>
                        </a>
                        <ul class="menu-sub">
    <li class="menu-item {{ (request()->is('formations') || request()->is('formations/'.Auth::user()->slug)) ? 'active' : '' }}">
        <a href="{{ url('/formations/'.Auth()->user()->slug) }}" class="menu-link">
            <div data-i18n="Container">Vos formations</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('formations/create') ? 'active' : '' }}">
        <a href="{{ url('/formations/create') }}" class="menu-link">
            <div data-i18n="Container">Nouvelle formation</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('layouts-without-navbar*') ? 'active' : '' }}">
        <a href="layouts-without-navbar.html" class="menu-link">
            <div data-i18n="Without navbar">Vos apprenants</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('formateur/requetes*') ? 'active' : '' }}">
        <a href="{{ route('formateur.requetes.index') }}" class="menu-link">
            <div data-i18n="Container">Préoccupations</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('formateur/messages*') ? 'active' : '' }}">
        <a href="{{ route('formateur.messages.index') }}" class="menu-link">
            <div data-i18n="Blank">Messages</div>
        </a>
    </li>
    <li class="menu-item {{ request()->is('questions*') ? 'active' : '' }}">
        <a href="{{ route('formateur.questions.index') }}" class="menu-link">
            <div data-i18n="Container">Questions de Test</div>
        </a>
    </li>
</ul>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Compte</span>
                    </li>
                    <li class="menu-item {{ request()->is('compte*', 'Compte*', 'Profil*', 'formateur/profil*') ? 'open' : '' }}">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">Compte</div>
    </a>
    <ul class="menu-sub">
        <li class="menu-item {{ request()->is('compte*', 'Compte*', 'Profil*', 'formateur/profil*') ? 'active' : '' }}">
            <a href="{{ route('formateur.profile') }}" class="menu-link">
                <div data-i18n="Account">Profil</div>
            </a>
        </li>
        {{-- Autres sous-menus éventuels --}}
    </ul>
</li>
                    <li class="menu-header small text-uppercase"><span class="menu-header-text">Support</span></li>
                    <li class="menu-item">
                        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-support"></i>
                            <div data-i18n="Support">Support</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Documentation">Documentation</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        @if(Auth::user()->photo_profil != null)
                                            <img src="{{ asset('storage/photo_profil/' . Auth::user()->photo_profil) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='{{ asset('assets/img/avatars/1.png') }}'"/>
                                        @else
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                        @endif
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        @if(Auth::user()->photo_profil != null)
                                                            <img src="{{ asset('storage/photo_profil/' . Auth::user()->photo_profil) }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" onerror="this.src='{{ asset('assets/img/avatars/1.png') }}'"/>
                                                        @else
                                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth()->user()->nom }}</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('formateur.profile') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Mon profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('formateur.profile') }}">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Réglages</span>
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

                @yield("content")

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
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>

    <style>
        .menu-item.active > .menu-link {
    background-color: #e9ecef !important;
    color: #0d6efd !important;
    font-weight: bold;
    border-radius: 5px;
}
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @yield('scripts')
    @stack('scripts')
</body>
</html>