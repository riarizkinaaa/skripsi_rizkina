<header class="main-nav">
    <nav class="mt-3">
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title {{routeActive('superadmin')}}" href="{{route('superadmin')}}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{ prefixActive('anak.index') }}" href="{{ route('anak.index') }}"><i data-feather="users"></i><span>Anak</span></a></li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Data Master</h6>
                        </div>
                    </li>

                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('pekerjaan.index')}}" href="{{ route('pekerjaan.index') }}"><i data-feather="box"></i><span>Pekerjaan</span></a></li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('pendidikan.index')}}" href="{{ route('pendidikan.index') }}"><i data-feather="book"></i><span>Pendidikan</span></a></li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('kelaspendidikan.index')}}" href="{{ route('kelaspendidikan.index') }}"><i data-feather="folder-plus"></i><span>Kelas Pendidikan</span></a></li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('kecamatan.index')}}" href="{{ route('kecamatan.index') }}"><i data-feather="map"></i><span>Kecamatan</span></a></li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('desa.index')}}" href="{{ route('desa.index') }}"><i data-feather="map-pin"></i><span>Desa</span></a></li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('dusun.index')}}" href="{{ route('dusun.index') }}"><i data-feather="map-pin"></i><span>Dusun</span></a></li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Pengguna</h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('survior*')}}" href="{{ route('survior.index') }}"><i data-feather="users"></i><span>Pendata</span></a></li>
                    <li class="dropdown" hidden><a class="nav-link menu-title link-nav {{routeActive('verifikator.index')}}" href="{{ route('verifikator.index') }}"><i data-feather="users"></i><span>Verifikator</span></a></li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('koordinator.index')}}" href="{{ route('koordinator.index') }}"><i data-feather="users"></i><span>Koordinator</span></a></li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Manajemen User</h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title link-nav {{routeActive('userlog.index')}}" href="{{ route('userlog.index') }}"><i data-feather="user"></i><span>Userlog</span></a></li>

                    <li class="dropdown"><a class="nav-link menu-title {{ prefixActive('/user') }}" href="javascript:void(0)"><i data-feather="user-check"></i><span>Manajemen User</span></a>
                        <ul class="nav-submenu menu-content" style="display: {{ prefixBlock('/user') }};">
                            <li><a class="submenu {{routeActive('user.userlog')}}" href="{{ route('userlog.index') }}">Userlog</a></li>
                            <li><a class="submenu {{routeActive('role')}}" href="{{ route('role.index') }}">Role</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>