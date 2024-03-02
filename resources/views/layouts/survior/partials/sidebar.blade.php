<header class="main-nav">
    <div class="sidebar-user text-center">
        <p class="mb-0 font-roboto">PMKS</p>
        <a href="user-profile.html">
            <p class="mb-0 font-roboto">Selamat datang, {{ Auth::user()->username }}</p>
            <h6 class="mt-3 f-14 f-w-600 text-uppercase">
                @php
                    // Dapatkan id_kecamatan dari sesi
                    $id_desa = Session::get('id_desa');
                    // Ambil data kecamatan berdasarkan id_desa
                    $desa = App\Models\Desa::find($id_desa);
                    // Jika data desa ditemukan, tampilkan namanya
                    if ($desa) {
                        echo $desa->nama_desa;
                    } else {
                        echo 'Kecamatan tidak ditemukan';
                    }
                @endphp
            </h6>
        </a>
        @php
            $id_role = Auth::user()->id_role;
        @endphp
        <p class="mb-0 font-roboto">
            @if ($id_role == 1)
                Superadmin
            @elseif($id_role == 2)
                Pimpinan
            @elseif($id_role == 3)
                Verifikator
            @elseif($id_role == 4)
                Pendata
            @elseif($id_role == 5)
                Koordinator
            @endif
        </p>
    </div>
    <nav class="mt-3">
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title {{ routeActive('dashboard_survior') }}"
                            href="{{ route('dashboard_survior') }}"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title {{ routeActive('anak_pendata.index') }}"
                            href="{{ route('anak_pendata.index') }}"><i data-feather="user"></i><span>Data
                                Anak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title {{ routeActive('index') }}"
                            href="{{ route('kontak') }}"><i data-feather="phone-call"></i><span>Kontak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title  {{ routeActive('data_survior.index') }}"
                            href="{{ route('data_survior.index') }}"><i data-feather="user"></i><span>Profile</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
