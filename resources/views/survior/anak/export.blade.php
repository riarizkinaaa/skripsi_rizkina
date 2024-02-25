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
    @php
    $i = 1;
    @endphp
    @forelse ($models as $item)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{$item->nama_anak}}</td>
        <td>{{"'".$item->nomor_kk}}</td>
        <td>{{"'".$item->nomor_nik}}</td>
        <td>
            @if ($item->jenis_kelamin == 1)
            Laki Laki
            @else
            Perempuan
            @endif
        </td>
        <td>{{$item->alamat}}</td>
        <td>{{$item->desa->nama_desa}}</td>
        <td>{{$item->kecamatan->nama_kecamatan}}</td>
        <td>{{$item->usia}}</td>
        <td>{{$item->tempat_lahir}}</td>
        <td>{{$item->tgl_lahir}}</td>
        <td>{{$item->pendidikan->pendidikan}}</td>
        <td>{{$item->kelas_pendidikan->kelas_pendidikan}}</td>
        <td>{{$item->alamat_sekolah}}</td>
        <td>
            @if ($item->status_anak == 1)
            Yatim
            @elseif($item->status_anak == 2)
            Piatu
            @else
            Yatim Piatu
            @endif
        </td>
        <td>{{$item->nama_wali}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="6">Data tidak ada</td>
    </tr>
    @endforelse

</table>