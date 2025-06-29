<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Rahat Combined')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- App CSS -->
    
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" id="app-style" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/custom_css.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="{{ asset('assets/js/head.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Hindi&display=swap" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: "Tiro Devanagari Hindi", serif;
        }

        .card-custom {
            border-radius: 1rem;
            padding: 1rem;
            background: white;
            height: 100%;
        }

        .status-badge {
            border-radius: 1rem;
            padding: 0.3rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .nav-pills .nav-link {
            color: black;
        }

        .nav-link {
            margin: 2px;
        }

        .nav-pills .nav-link.active {
            color: white !important;
            background-color: #0d6efd;
        }

        @media (min-width:1024px) {
            .media {
                margin-left: 110px;
                margin-right: 110px;
            }
        }
    </style>
</head>

<body data-menu-color="light" data-sidebar="default">
    <div id="app-layout">
        <!-- Navbar / Topbar -->
        <div class="topbar-custom">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li>
                            <button class="button-toggle-menu nav-link">
                                <i data-feather="menu" class="noti-icon"></i>
                            </button>
                        </li>
                    </ul>
                    <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" data-toggle="fullscreen">
                                <i data-feather="maximize" class="fullscreen noti-icon"></i>
                            </button>
                        </li>
                        <li class="d-none d-sm-flex">
                            <button type="button" class="btn nav-link" id="light-dark-mode">
                                <i data-feather="moon" class="dark-mode"></i>
                                <i data-feather="sun" class="light-mode"></i>
                            </button>
                        </li>

                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                                role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/user-13.jpg') }}" class="rounded-circle" />
                                <span class="pro-user-name ms-1">{{ Auth::user()->name ?? '' }} <i
                                        class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome {{ Auth::user()->name ?? '' }} !</h6>
                                </div>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item notify-item">
                                        <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end Navbar -->
