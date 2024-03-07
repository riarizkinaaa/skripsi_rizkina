<?php $__env->startSection('title'); ?>
    <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <h4><?php echo e($title); ?></h4>
</div>

<?php if(session('success')): ?>
<div class="alert alert-primary outline-2x" role="alert">
    <p><?php echo e(session('success')); ?></p>
</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger outline-2x " role="alert">
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row m-3">
                    <div class="col-md-2">
                        <a href="<?php echo e(route($routePrefix. '.create')); ?>" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                    <div class="col-md-10">
                        <?php echo Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <?php echo Form::select('id_pendidikan', $pendidikan, request('id_pendidikan'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Pendidikan',
                                ]); ?>

                            </div>
                            <div class="col-md-4">
                                <?php echo Form::select('id_kelas_pendidikan', $kelas_pendidikan, request('id_kelas_pendidikan'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Kelas Pendidikan',
                                ]); ?>

                            </div>
                            <div class="col-md-4">
                                <?php echo Form::text('q', request('q'), ['class' => 'form-control ', 'placeholder' => 'Cari NIK ']); ?>

                            </div>
                            <div class="col-md-4">
                                <?php echo Form::select('id_desa', $desa, request('id_desa'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Desa',
                                ]); ?>

                            </div>
                        </div>
                        <div class="row mt-2 justify-content-end">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i> Filter</button>
                                <a href="<?php echo e(route($routePrefix. '.index')); ?>" class="btn btn-sm btn-danger"><i class="fa fa-filter"></i> Clear</a>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-md">
                        <a href="view_anak" class="btn btn-warning btn-sm"><i class="fa fa-upload"></i> Import </a>
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-download"></i> Export </button>
                        <a href="download" class="btn btn-info btn-sm"><i class="fa fa-download"></i> Download </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm m-0" id="myTable">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>
                                    <th style="width: 300px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $models->firstItem();
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($item->nama_anak); ?></td>
                                    <td><?php echo e($item->nomor_nik); ?></td>
                                    <td>
                                        <?php if($item->jenis_kelamin == 1): ?>
                                        Laki Laki
                                        <?php else: ?>
                                        Perempuan
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->usia); ?></td>
                                    <td class="text-center">
                                        <?php echo Form::open([
                                        'route' => [$routePrefix .'.destroy', $item->id_anak],
                                        'method' => 'DELETE',
                                        'onsubmit' => 'return confirm("Yakin ingin menghapus data ini ?")',
                                        ]); ?>

                                        <a href="<?php echo e(route('detail', $item->id_anak)); ?>" class="btn btn-sm btn-info"> <i class="fa fa-eye"></i></a>
                                        <a href="<?php echo e(route($routePrefix .'.edit', $item->id_anak)); ?>" class="btn btn-sm btn-warning"> <i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <?php echo Form::close(); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6">Data tidak ada</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($models->hasPages()): ?>
                <div class="card-footer pagination justify-content-end pagination-primary">
                    <?php echo e($models->links()); ?>

                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Large modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Filter Data Export</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="export_anak" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <?php echo Form::select('id_pendidikan', $pendidikan, request('id_pendidikan'), [
                            'class' => 'js-example-basic-single',
                            'placeholder' => 'All Pendidikan',
                            ]); ?>

                        </div>
                        <div class="col-md-4">
                            <?php echo Form::select('id_kelas_pendidikan', $kelas_pendidikan, request('id_kelas_pendidikan'), [
                            'class' => 'js-example-basic-single',
                            'placeholder' => 'All Kelas Pendidikan',
                            ]); ?>

                        </div>
                        <div class="col-md-4">
                            <?php echo Form::select('id_desa', $desa, request('id_desa'), [
                            'class' => 'js-example-basic-single',
                            'placeholder' => 'All Desa',
                            ]); ?>

                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Export</button>
                            <a href="<?php echo e(route($routePrefix. '.index')); ?>" class="btn btn-sm btn-danger"><i class="fa fa-filter"></i> Clear</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- <script src="<?php echo e(asset('assets/js/jquery.table2excel.js')); ?>"></script>
<script>
    $("#btn-excel").on('click', function() {
        // console.log("oke")
        $("#myTable").table2excel();
    });
</script> -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.survior.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks_pengembangan_2-master\resources\views/survior/anak/index.blade.php ENDPATH**/ ?>