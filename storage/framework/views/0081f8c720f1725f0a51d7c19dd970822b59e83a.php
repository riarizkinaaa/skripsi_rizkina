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
    <div class="caontainer-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row p-3">
                        <div class="col-md-2">
                            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                                data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                        </div>
                        <div class="col-md-10">

                            <div class="row">
                                <?php echo Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']); ?>

                                <div class="row justify-content-end">

                                    <div class="col-md-4 ">
                                        <?php echo Form::text('q', request('q'), [
                                            'class' => 'form-control form-control-sm',
                                            'placeholder' => 'Cari Nama Kecamatan',
                                        ]); ?>

                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i>
                                            Filter</button>
                                        <a href="<?php echo e(route($routePrefix . '.index')); ?>" class="btn btn-sm btn-danger"><i
                                                class="fa fa-filter"></i> Clear</a>
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
                                        <th>Nama Kecamatan</th>
                                        <th>geojson</th>
                                        
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
                                            <td><?php echo e($item->nama_kecamatan); ?></td>
                                            <td>
                                                <?php if($item->geojson): ?>
                                                    <?php echo e(basename($item->geojson, '.' . pathinfo($item->file1, PATHINFO_EXTENSION))); ?>

                                                <?php else: ?>
                                                    Tidak Ada File
                                                <?php endif; ?>
                                            </td>


                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning btn-square tombol-ubah" type="button"
                                                    data-bs-toggle="modal" data-original-title="test"
                                                    data-bs-target="#tomboUbah" data-id="<?php echo e($item->id_kecamatan); ?>"><i
                                                        class="fa fa-edit"></i></button>
                                                <form onsubmit="return confirm('Are You Sure ?');"
                                                    action="kecamatan/<?php echo e($item->id_kecamatan); ?>" method="POST"
                                                    class="d-inline ">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-sm btn-danger btn-square "><i
                                                            class="fa fa-trash"></i></button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('kecamatan.store')); ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kecamatan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3 draggable">
                            <input type="hidden" name="id" id="id">
                            <label for="input-text-1">Nama Kecamatan</label>
                            <input class="form-control btn-square <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="kecamatan"
                                name="kecamatan" type="text" placeholder="Nama Kecamatan " autocomplete="off">
                            <?php $__errorArgs = ['kecamatan'];
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
                        <div class="mb-3 draggable">
                            <label for="geojson">File Peta Wilayah (.geojson)</label>
                            <input type="file" name="geojson"
                                class="form-control btn-square <?php $__errorArgs = ['geojson'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['geojson'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="invalid-feedback"><?php echo e($message); ?></p>
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
    <div class="modal fade" id="tomboUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content form-ubah">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Ubah Kecamatan</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3 draggable">
                            <input type="hidden" name="id_ubah" id="id_ubah">
                            <label for="input-text-1">Nama Kecamatan</label>
                            <input class="form-control btn-square <?php $__errorArgs = ['kecamatan_ubah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="kecamatan_ubah" name="kecamatan_ubah" type="text" placeholder="Nama kecamatan"
                                required autocomplete="off">
                            <?php $__errorArgs = ['kecamatan_ubah'];
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
                    $('.form-ubah form').attr('action', 'kecamatan/' + id)
                    // console.log(id);

                    $.ajax({
                        url: `kecamatan/` + id + `/edit`,
                        method: 'get',
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data)
                            $('#id_ubah').val(data.id_kecamatan)
                            $('#kecamatan_ubah').val(data.nama_kecamatan)

                        }
                    })
                })
            })
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Music\pmks_pengembangan_2-master\resources\views/superadmin/kecamatan/index.blade.php ENDPATH**/ ?>