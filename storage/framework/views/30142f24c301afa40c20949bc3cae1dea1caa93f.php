<?php $__env->startSection('title'); ?><?php echo e($title); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="caontainer-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">

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
                <div class="card-header">
                    <h5>Form <?php echo e($title); ?></h5>
                </div>
                <div class="card-body">
                    <?php echo Form::model($model, ['route' => $route, 'method' => $method, 'enctype'=>"multipart/form-data"]); ?>

                    <div class="row">

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama" type="text" name="nama" autocomplete="off" value="<?php echo e(old('nama', $model->nama_anak)); ?>">
                                <?php $__errorArgs = ['nama'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Nomor KK</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="kk" type="number" name="kk" placeholder="" autocomplete="off" value="<?php echo e(old('kk', $model->nomor_kk)); ?>">
                                <?php $__errorArgs = ['kk'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="nik" type="number" name="nik" placeholder="" autocomplete="off" value="<?php echo e(old('nik', $model->nomor_nik)); ?>">
                                <?php $__errorArgs = ['nik'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="alamat" type="text" name="alamat" placeholder="" autocomplete="off" value="<?php echo e(old('alamat', $model->alamat)); ?>">
                                <?php $__errorArgs = ['alamat'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select name="jk" id="jk" class="form-control">
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="1" <?php if($model->jenis_kelamin=='1'): ?> selected='selected' <?php endif; ?>>Laki Laki</option>
                                    <option value="0" <?php if($model->jenis_kelamin=='0'): ?> selected='selected' <?php endif; ?>>Perempuan</option>
                                </select>
                                <?php $__errorArgs = ['jk'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="tempat_lahir" type="text" name="tempat_lahir" required autocomplete="off" value="<?php echo e(old('tempat_lahir', $model->tempat_lahir)); ?>">
                                <?php $__errorArgs = ['tempat_lahir'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Lahir </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="tgl_lahir" type="date" name="tgl_lahir" autocomplete="off" value="<?php echo e(old('tgl_lahir', $model->tgl_lahir)); ?>">
                                <?php $__errorArgs = ['tgl_lahir'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Nama Wali </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama_wali" type="text" name="nama_wali" autocomplete="off" value="<?php echo e(old('nama_wali', $model->nama_wali)); ?>">
                                <?php $__errorArgs = ['nama_wali'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Alamat Sekolah </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="alamat_sekolah" type="text" name="alamat_sekolah" autocomplete="off" value="<?php echo e(old('alamat_sekolah', $model->alamat_sekolah)); ?>">
                                <?php $__errorArgs = ['alamat_sekolah'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Status Anak</label>
                            <div class="col-sm-9">
                                <select name="status_anak" id="status_anak" class="form-control">
                                    <option value="">--Pilih Status Anak--</option>
                                    <option value="1" <?php if($model->status_anak=='1'): ?> selected='selected' <?php endif; ?>>Yatim</option>
                                    <option value="2" <?php if($model->status_anak=='2'): ?> selected='selected' <?php endif; ?>>Piatu</option>
                                    <option value="3" <?php if($model->status_anak=='3'): ?> selected='selected' <?php endif; ?>>Yatim Piatu</option>
                                </select>
                                <?php $__errorArgs = ['status_anak'];
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
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pekerjaa Wali</label>
                            <div class="col-sm-9">

                                <select name="pekerjaan" id="pekerjaan" class="js-example-basic-single">
                                    <option value="">--Pilih Pekerjaan--</option>
                                    <?php $__empty_1 = true; $__currentLoopData = $pekerjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $kerjaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option value=<?php echo e("$id"); ?> <?php if($model->id_pekerjaan_wali== $id): ?> selected='selected' <?php endif; ?>><?php echo e($kerjaan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo e($errors->first('pekerjaan')); ?></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <select name="pendidikan" id="pendidikan" class="js-example-basic-single">
                                    <option value="">--Pilih Pendidikan--</option>
                                    <?php $__empty_1 = true; $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idp => $pendidikan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option value=<?php echo e("$idp"); ?> <?php if($model->id_pendidikan== $idp): ?> selected='selected' <?php endif; ?>><?php echo e($pendidikan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </select>

                                <span class="text-danger"><?php echo e($errors->first('pendidikan')); ?></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Kelas Pendidikan</label>
                            <div class="col-sm-9">
                                <select name="kelas" id="kelas" class="js-example-basic-single">
                                    <option value="">--Pilih Kelas Pendidikan--</option>
                                    <?php $__empty_1 = true; $__currentLoopData = $kelas_pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idkp => $kpendidikan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <option value=<?php echo e("$idkp"); ?> <?php if($model->id_kelas_pendidikan== $idkp): ?> selected='selected' <?php endif; ?>><?php echo e($kpendidikan); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <?php endif; ?>
                                </select>
                                <span class="text-danger"><?php echo e($errors->first('kelas')); ?></span>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.survior.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Downloads\pmks_pengembangan_2-master\resources\views/survior/anak/formedit.blade.php ENDPATH**/ ?>