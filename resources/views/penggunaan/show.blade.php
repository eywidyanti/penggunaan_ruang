<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Penggunaan</title>
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
                                <a class="dropdown-item" ><i class="fa fa-power-off">
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
                    <img src="../logo.png" width="60" height="60" class="d-inline-block align-top" alt="">
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
                    <li class="nav-item active">
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
                    <li class="nav-item">
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
                        <h4 class="ml-3">Detail penggunaan Ruangan</h4>
                        <hr color="blue">
                        <div class="container">
                            <div class="row mt-4">
                                <div class="col-6 ml-5">
                                    <table>
                                        <tr>
                                            <td width="100" height="50">NIM</td>
                                            <td width="50">:</td>
                                            <td>{{$penggunaan->nim}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Nama</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->nama}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Kelas</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->kelas}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Telepon</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->telp}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Tanggal</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->tanggal}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-5">
                                    <table>
                                        <tr>
                                            <td width="100" height="50">Jam Masuk</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->jam_masuk}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Jam Keluar</td>
                                            <td width="50">:</td>
                                            <td>{{$penggunaan->jam_keluar}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Status</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->status}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">Ruangan</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->ruang}}</td>
                                        </tr>
                                        <tr>
                                            <td width="100" height="50">User</td>
                                            <td>:</td>
                                            <td>{{$penggunaan->user}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>



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