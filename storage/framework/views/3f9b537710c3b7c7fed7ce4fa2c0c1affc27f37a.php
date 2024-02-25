<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Anak Yatim.xls");
?>
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No KK</th>
        <th>NIK</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Desa</th>
        <th>Kecamatan</th>
        <th>Usia</th>
        <th>Tempat Lahir</th>
        <th>Tgl Lahir</th>
        <th>Pendidikan</th>
        <th>Kelas Pendidikan</th>
        <th>Alamat Sekolah</th>
        <th>Status Anak</th>
        <th>Nama Wali</th>
    </tr>
    <?php
    $i = 1;
    ?>
    <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
        <td><?php echo e($i++); ?></td>
        <td><?php echo e($item->nama_anak); ?></td>
        <td><?php echo e("'".$item->nomor_kk); ?></td>
        <td><?php echo e("'".$item->nomor_nik); ?></td>
        <td>
            <?php if($item->jenis_kelamin == 1): ?>
            Laki Laki
            <?php else: ?>
            Perempuan
            <?php endif; ?>
        </td>
        <td><?php echo e($item->alamat); ?></td>
        <td><?php echo e($item->desa->nama_desa); ?></td>
        <td><?php echo e($item->kecamatan->nama_kecamatan); ?></td>
        <td><?php echo e($item->usia); ?></td>
        <td><?php echo e($item->tempat_lahir); ?></td>
        <td><?php echo e($item->tgl_lahir); ?></td>
        <td><?php echo e($item->pendidikan->pendidikan); ?></td>
        <td><?php echo e($item->kelas_pendidikan->kelas_pendidikan); ?></td>
        <td><?php echo e($item->alamat_sekolah); ?></td>
        <td>
            <?php if($item->status_anak == 1): ?>
            Yatim
            <?php elseif($item->status_anak == 2): ?>
            Piatu
            <?php else: ?>
            Yatim Piatu
            <?php endif; ?>
        </td>
        <td><?php echo e($item->nama_wali); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="6">Data tidak ada</td>
    </tr>
    <?php endif; ?>

</table><?php /**PATH C:\Users\ASUS\Music\skripsi\pmks-anak-yatim\resources\views/survior/anak/export.blade.php ENDPATH**/ ?>