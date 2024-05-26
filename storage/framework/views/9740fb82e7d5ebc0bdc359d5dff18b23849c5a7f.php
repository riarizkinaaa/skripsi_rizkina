<header class="main-nav">
    <div class="sidebar-user text-center">
        <a href="user-profile.html">
            <p class="mb-0 font-roboto">
                Selamat datang, <?php echo e(Auth::user()->username); ?> dari desa
                <?php
                    $id_desa = Session::get('id_desa');
                    $desa = App\Models\Desa::find($id_desa);
                    if ($desa) {
                        echo $desa->nama_desa;
                    } else {
                        echo 'desa tidak ditemukan';
                    }
                ?>
            </p>

            <h6 class="mt-3 f-14 f-w-600 text-uppercase">
                <?php
                    // Dapatkan objek pengguna yang saat ini masuk
                    $user = Auth::user();

                    // Tampilkan username jika pengguna ada
                    if ($user) {
                        echo $user->username;
                    } else {
                        echo 'Pengguna tidak ditemukan';
                    }
                ?>
            </h6>

        </a>
        <?php
            $id_role = Auth::user()->id_role;
        ?>
        <p class="mb-0 font-roboto">
            <?php if($id_role == 1): ?>
                Superadmin
            <?php elseif($id_role == 2): ?>
                Pimpinan
            <?php elseif($id_role == 3): ?>
                Verifikator
            <?php elseif($id_role == 4): ?>
                Pendata
            <?php elseif($id_role == 5): ?>
                Koordinator
            <?php endif; ?>
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
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('dashboard_survior')); ?>"
                            href="<?php echo e(route('dashboard_survior')); ?>"><i
                                data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('anak_pendata.index')); ?>"
                            href="<?php echo e(route('anak_pendata.index')); ?>"><i data-feather="user"></i><span>Data
                                Anak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('index')); ?>"
                            href="<?php echo e(route('kontak')); ?>"><i data-feather="phone-call"></i><span>Kontak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title  <?php echo e(routeActive('data_survior.index')); ?>"
                            href="<?php echo e(route('data_survior.index')); ?>"><i data-feather="user"></i><span>Profile</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
<?php /**PATH C:\Users\ASUS\Music\pmks_pengembangan_2-master\resources\views/layouts/survior/partials/sidebar.blade.php ENDPATH**/ ?>