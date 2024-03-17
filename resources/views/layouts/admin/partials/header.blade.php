<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="{{ route('login') }}">
                    <img class="img-fluid" src="{{ asset('assets/images/logo/icon-logo.png') }}" alt="">
                    <span style="margin-left: 5px;">PMKS</span>
                </a>
            </div>

            <div class="dark-logo-wrapper"><a href="{{ route('login') }}"><img class="img-fluid"
                        src="{{ asset('assets/images/logo/dark-logo.png') }}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center" id="sidebar-toggle">
                </i></div>
        </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <form class="form-inline search-form">
                        <div class="search-bg"><i class="fa fa-search"></i>
                            <input class="form-control-plaintext" placeholder="Search here.....">
                        </div>
                    </form>
                    <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
                </li>
            </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>
                <li class="onhover-dropdown p-0">
                    {{-- <div class="dropdown">
            <button class="btn btn-primary-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Kecamatan
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              @foreach ($kecamatan as $kc)
                <a class="dropdown-item" href="#">{{ $kc->nama_kecamatan }}</a>
              @endforeach
            </div>
          </div>
          </div>   --}}
                </li>
                <!-- Pastikan variabel $kecamatan tersedia di dalam tampilan -->
                <li class="onhover-dropdown p-0">
                    <a href="{{ route('logout') }}" class="btn btn-primary-light" type="button"><i
                            data-feather="log-out"></i>Log out</a>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
