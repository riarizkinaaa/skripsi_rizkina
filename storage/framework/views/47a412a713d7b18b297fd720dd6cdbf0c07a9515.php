<header class="main-nav">
    <div class="sidebar-user text-center">
        <a href="user-profile.html">
            <h6 class="mt-3 f-14 f-w-600"><?php echo e(Auth::user()->username); ?></h6>
        </a>
        <p class="mb-0 font-roboto">Verifikator</p>

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
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('data_verifikator.index')); ?>" href="<?php echo e(route('data_verifikator.index')); ?>"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(routeActive('anak_verifikator.index')); ?>" href="<?php echo e(route('anak_verifikator.index')); ?>"><i data-feather="check-square"></i><span>Verifikasi</span></a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link link-nav menu-title <?php echo e(prefixActive('sudah-verifikasi')); ?>" href="<?php echo e(route('sudah-verifikasi')); ?>"><i data-feather="users"></i><span>Anak Yatim</span></a>
                    </li>
                </ul>

            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks_pengembangan_2-master\resources\views/layouts/verifikator/partials/sidebar.blade.php ENDPATH**/ ?>