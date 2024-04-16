<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Peminjaman</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="/assets/css/ready.css">
    <link rel="stylesheet" href="/assets/css/demo.css">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a class="logo">
                    Penggunaan Ruang
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" aria-expanded="false"> <img src="{{asset('img')}}/{{ Auth::user()->foto }}" alt="user-img" width="45" height="45" class="img-circle"><span>{{ Auth::user()->name }}</span></span> </a>
                            <ul class="dropdown-menu dropdown-user">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('/use')}}"><i class="ti-settings"></i> Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"><i class="fa fa-power-off">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <img src="logo.png" width="60" height="60" class="d-inline-block align-top" alt="">
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{url('/redirects')}}">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/ruangans')}}">
                            <i class="la la-table"></i>
                            <p>Ruangan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/penggunaans')}}">
                            <i class="la la-keyboard-o"></i>
                            <p>Penggunaan Ruang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/peminjamans')}}">
                            <i class="la la-th"></i>
                            <p>Peminjaman Ruang</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/users')}}">
                            <i class="la la-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                    <li class="nav-item active">
						<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<i class="la la-book"></i>
							<p>Laporan</p> <span class="caret"></span>
						</a>
						<div class="collapse in" id="collapseExample" aria-expanded="true">
							<ul class="nav">
								<li>
									<a href="{{url('/pengguna')}}">
										<span class="link-collapse">Penggunaan Ruang</span>
									</a>
								</li>
								<li>
									<a href="{{url('/peminjam')}}">
										<span class="link-collapse">Peminjaman Ruang</span>
									</a>
								</li>
							</ul>
					</li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="row row-card-no-pd mt-4">
                        <h4 class="ml-3">Laporan Peminjaman Ruangan</h6>

                            <div class="container mt-4">
                                <form action="{{url('/pinjam')}}" method="GET">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" class="col-form-label" name="start_date" id="start_date" value="{{ old('start_date') }}">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" class="col-form-label" name="end_date" id="end_date" value="{{ old('end_date') }}">
                                    <button type="submit"class="btn btn-primary"><i class="la la-search"></i></button>
                                </form>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="footer">
        <div class="container-fluid">
        </div>
    </footer>
    </div>
    </div>
    </div>

</body>
<script src="/assets/js/core/jquery.3.2.1.min.js"></script>
<script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="/assets/js/core/popper.min.js"></script>
<script src="/assets/js/core/bootstrap.min.js"></script>
<script src="/assets/js/plugin/chartist/chartist.min.js"></script>
<script src="/assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="/assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="/assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/js/ready.min.js"></script>

</html>