<?php $__env->startSection('title'); ?><?php echo e($title); ?>

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
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                    </div>
                    <div class="col-md-10">

                        <div class="row">
                            <?php echo Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']); ?>

                            <div class="row justify-content-end">

                                <div class="col-md-4 ">
                                    <?php echo Form::text('q', request('q'), ['class' => 'form-control form-control-sm', 'placeholder' => 'Cari Pendidikan']); ?>

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
                        <table class="table table-bordered table-striped table-hover table-sm m-0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Pendidikan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = $models->firstItem();
                                ?>
                                <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($item->pendidikan); ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn-square tombol-ubah" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#tomboUbah" data-id="<?php echo e($item->id_pendidikan); ?>"><i class="fa fa-edit"></i></button>
                                        <form onsubmit="return confirm('Are You Sure ?');" action="pendidikan/<?php echo e($item->id_pendidikan); ?>" method="POST" class="d-inline ">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger btn-square "><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3">Data tidak ada</td>
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
<!-- mmodal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('pendidikan.store')); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Pendidikan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3 draggable">
                        <input type="hidden" name="id" id="id">
                        <label for="input-text-1">Pendidikan</label>
                        <input class="form-control btn-square <?php $__errorArgs = ['pendidikan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pendidikan" name="pendidikan" type="text" placeholder="Pendidikan " autocomplete="off">
                        <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="help-block"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tomboUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content form-ubah">
            <form action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Ubah Pendidikan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3 draggable">
                        <input type="hidden" name="id_ubah" id="id_ubah">
                        <label for="input-text-1">Pendidikan</label>
                        <input class="form-control btn-square <?php $__errorArgs = ['pendidikan_ubah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pendidikan_ubah" name="pendidikan_ubah" type="text" placeholder="Pendidikan " required autocomplete="off">
                        <?php $__errorArgs = ['pendidikan_ubah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="help-block"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="submit">Update </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->startPush('scripts'); ?>



<script>
    $(function() {

        $('.tombol-ubah').on('click', function() {
            const id = $(this).data('id')
            $('.form-ubah form').attr('action', 'pendidikan/' + id)
            // console.log(id);

            $.ajax({
                url: `pendidikan/` + id + `/edit`,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    $('#id_ubah').val(data.id_pendidikan)
                    $('#pendidikan_ubah').val(data.pendidikan)
                }
            })
        })
    })
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks_pengembangan_2-master\resources\views/superadmin/pendidikan/index.blade.php ENDPATH**/ ?>