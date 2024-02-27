<header class="main-nav">
    <div class="sidebar-user text-center">
        <a href="user-profile.html">
            <p class="mb-0 font-roboto">Selamat datang, <?php echo e(Auth::user()->username); ?></p>
            <h6 class="mt-3 f-14 f-w-600 text-uppercase">
                <?php
                    // Dapatkan id_kecamatan dari sesi
                    $id_kecamatan = Session::get('id_kecamatan');
                    // Ambil data kecamatan berdasarkan id_kecamatan
                    $kecamatan = App\Models\Kecamatan::find($id_kecamatan);
                    // Jika data kecamatan ditemukan, tampilkan namanya
                    if ($kecamatan) {
                        echo $kecamatan->nama_kecamatan;
                    } else {
                        echo 'Kecamatan tidak ditemukan';
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
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('data_koordinator.index')); ?>" href="<?php echo e(route('data_koordinator.index')); ?>"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('anak_koordinator.index')); ?>" href="<?php echo e(route('anak_koordinator.index')); ?>"><i data-feather="check-square"></i><span>Verifikasi</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(request()->routeIs('sdh-verifikasi') ? 'active' : ''); ?>" href="<?php echo e(route('sdh-verifikasi')); ?>"><i data-feather="users"></i><span>Anak Yatim</span></a>
                    </li>
                </ul>

            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header><?php /**PATH C:\Users\ASUS\Downloads\pmks_pengembangan_2-master\resources\views/layouts/koordinator/partials/sidebar.blade.php ENDPATH**/ ?>