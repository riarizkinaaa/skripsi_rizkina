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
                            <label for="survior" class="col-sm-3 col-form-label">Pendata</label>
                            <div class="col-sm-9">
                                <?php echo Form::select('survior', $survior, null, [
                                'class' => 'form-control js-example-basic-single',
                                'id' => 'survior',
                                'placeholder' => 'Pilih survior',
                                ]); ?>

                                <span class="text-danger"><?php echo e($errors->first('survior')); ?></span>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama" type="text" name="nama" autocomplete="off">
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
                                <input class=" form-control" id="kk" type="number" name="kk" placeholder="" autocomplete="off">
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
                                <input class=" form-control" id="nik" type="number" name="nik" placeholder="" autocomplete="off">
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
                                <input class=" form-control" id="alamat" type="text" name="alamat" placeholder="" autocomplete="off">
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
                                    <option value="1">Laki Laki</option>
                                    <option value="0">Perempuan</option>
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
                                <input class=" form-control" id="tempat_lahir" type="text" name="tempat_lahir" required autocomplete="off">
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
                                <input class="form-control" id="tgl_lahir" type="date" name="tgl_lahir" autocomplete="off">
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
                                <input class="form-control" id="nama_wali" type="text" name="nama_wali" autocomplete="off">
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
                                <input class="form-control" id="alamat_sekolah" type="text" name="alamat_sekolah" autocomplete="off">
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
                                    <option value="1">Yatim</option>
                                    <option value="2">Piatu</option>
                                    <option value="3">Yatim Piatu</option>
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
                            <label for="" class="col-sm-3 col-form-label">Pekerjaa Wali</label>
                            <div class="col-sm-9">
                                <?php echo Form::select('pekerjaan', $pekerjaan, null, [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'Pilih Pekerjaan',
                                ]); ?>

                                <span class="text-danger"><?php echo e($errors->first('pekerjaan')); ?></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <?php echo Form::select('pendidikan', $pendidikan, null, [
                                'class' => 'form-control js-example-basic-single',
                                'placeholder' => 'Pilih Pendidikan',
                                ]); ?>

                                <span class="text-danger"><?php echo e($errors->first('pendidikan')); ?></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Kelas Pendidikan</label>
                            <div class="col-sm-9">
                                <?php echo Form::select('kelas', $kelas_pendidikan, null, [
                                'class' => 'form-control js-example-basic-single',
                                'placeholder' => 'Pilih Kelas Pendidikan',
                                ]); ?>

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
<script>
    $(document).ready(function(){
        // Ketika pilihan pendata berubah
        $('select[name="survior"]').change(function(){
            var surviorId = $(this).val();
            if(surviorId){
                // Lakukan AJAX request
                $.ajax({
                    url: '<?php echo e(route("get-kecamatan")); ?>',
                    type: 'POST',
                    data: {survior: surviorId},
                    dataType: 'json',
                    success: function(data){
                        // Ubah isi dropdown kecamatan
                        var kecamatanDropdown = $('select[name="kecamatan"]');
                        kecamatanDropdown.empty();
                        $.each(data, function(key, value){
                            kecamatanDropdown.append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log("Error: ", xhr.responseText); // Cetak pesan kesalahan ke konsol
                    }
                });
            }else{
                // Kosongkan dropdown kecamatan jika tidak ada pilihan pendata yang dipilih
                $('select[name="kecamatan"]').empty();
            }
        });
    });
</script>


<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Downloads\pmks_pengembangan_2-master\resources\views/superadmin/anak/formadd.blade.php ENDPATH**/ ?>