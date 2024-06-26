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
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('pimpinan.index')); ?>" href="<?php echo e(route('pimpinan.index')); ?>"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('data-anak.index')); ?>" href="<?php echo e(route('data-anak.index')); ?>"><i data-feather="user"></i><span>Data Anak</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('belum_verifikasi')); ?>" href="<?php echo e(route('belum_verifikasi')); ?>"><i data-feather="x-circle"></i><span>Belum Verifikasi</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('sudah_verifikasi')); ?>" href="<?php echo e(route('sudah_verifikasi')); ?>"><i data-feather="check-square"></i><span>Sudah Verifikasi</span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header><?php /**PATH C:\Users\ASUS\Downloads\pmks_pengembangan_2-master\resources\views/layouts/pimpinan/partials/sidebar.blade.php ENDPATH**/ ?>