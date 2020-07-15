<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet"
        href="{{asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">

        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <img src="{{asset('assets/images/logo.png')}}" alt="Jorunal" srcset=""
                    style="width:10%; margin-left:4%;">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="nav-user-info">
                                    <h6 class="mb-0 text-white nav-user-name" style="text-transform:capitalize">
                                        @csrf
                                        {{Auth::user()->name}}
                                    </h6>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                                aria-labelledby="navbarDropdownMenuLink2">
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="/logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Data
                            </li>
                            @if(Auth::user()->role == "2")
                            <li class="nav-item ">
                                <a class="nav-link {{ request()->is('siswa') ? 'active' : ''}}" href="#"
                                    data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
                                    aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Data Siswa <span
                                        class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/siswa/10/">Kelas X</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/siswa/11/">Kelas XI</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/siswa/12/">Kelas XII</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="/siswa"><i class=" fa fa-fw fa-user-circle"></i>Data
                                    Siswa</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('guru') ? 'active' : ''}}" href="/guru"><i
                                        class="fa fa-fw  fa-briefcase"></i>Data Guru</a>
                            </li>
                            <li class="nav-divider">
                                Menu
                            </li>
                            @if (Auth::user()->role == 1)
                            <li class="nav-item">
                                <a class="nav-link" href="/jurnal"><i class=" mdi mdi-border-color"></i>Jurnal
                                    Harian</a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="/jurnal/bulanan"><i class="fa fa-fw  fa-file-alt"></i>Print
                                    Jurnal</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-fw  fa-copy"></i>Laporan Bulanan</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
