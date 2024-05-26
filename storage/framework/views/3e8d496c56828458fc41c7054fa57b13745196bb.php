<?php $__env->startSection('title'); ?>Pendata <?php echo e($title); ?>

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
<div class="caontainer-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row p-3">
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" hidden data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                        
                    </div>

                    <div class="col-md-10">

                        <div class="row">
                            <?php echo Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']); ?>

                            <div class="row justify-content-end">

                                <div class="col-md-4 ">
                                    <?php echo Form::text('q', request('q'), ['class' => 'form-control form-control-sm', 'placeholder' => 'Cari Nama Lengkap']); ?>

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i> Filter</button>
                                    <a href="<?php echo e(route($routePrefix. '.index')); ?>" class="btn btn-sm btn-danger"><i class="fa fa-filter"></i> Clear</a>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="table table-striped table-hover table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                $i = $models->firstItem();
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?php echo e($item->username); ?></td>
                                    <td><?php echo e($item->nama_lengkap); ?></td>
                                    <td><?php echo e($item->nik); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('survior.show', $item->id_survior)); ?>" class="btn btn-sm btn-info"> <i class="fa fa-eye"></i></a>
                                        <form onsubmit="return confirm('Are You Sure ?');" action="survior/<?php echo e($item->id_survior); ?>" method="POST" class="d-inline ">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger btn-square "><i class="fa fa-trash"></i></button>
                                        </form>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Music\pmks_pengembangan_2-master\resources\views/superadmin/survior/index.blade.php ENDPATH**/ ?>