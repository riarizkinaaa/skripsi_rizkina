<div class="page-main-header">
    <div class="main-header-right row m-0">
        
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="<?php echo e(route('login')); ?>">
                    <img class="img-fluid" src="<?php echo e(asset('assets/images/logo/icon-logo.png')); ?>" alt="">
                    <span style="margin-left: 5px;">PMKS</span>
                </a>
            </div>

            <div class="dark-logo-wrapper"><a href="<?php echo e(route('login')); ?>"><img class="img-fluid"
                        src="<?php echo e(asset('assets/images/logo/dark-logo.png')); ?>" alt=""></a></div>
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
                    <a href="<?php echo e(route('logout')); ?>" class="btn btn-primary-light" type="button"><i
                            data-feather="log-out"></i>Log out</a>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>

<?php /**PATH C:\Users\ASUS\Downloads\tugas akhir\tugas akhir\skripsi\pmks_pengembangan_2-master\resources\views/layouts/survior/partials/header.blade.php ENDPATH**/ ?>