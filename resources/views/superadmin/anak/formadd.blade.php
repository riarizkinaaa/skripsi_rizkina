@extends('layouts.admin.master')

@section('title'){{ $title }}
@endsection


@section('content')

<div class="caontainer-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">

                @if (session('success'))
                <div class="alert alert-primary outline-2x" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger outline-2x " role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-header">
                    <h5>Form {{$title}}</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'enctype'=>"multipart/form-data"]) !!}
                    <div class="row">
                        <div class="mb-3 row">
                            <label for="survior" class="col-sm-3 col-form-label">Pendata</label>
                            <div class="col-sm-9">
                                {!! Form::select('survior', $survior, null, [
                                'class' => 'form-control js-example-basic-single',
                                'id' => 'survior',
                                'placeholder' => 'Pilih survior',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('survior') }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama" type="text" name="nama" autocomplete="off">
                                @error('nama')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Nomor KK</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="kk" type="number" name="kk" placeholder="" autocomplete="off">
                                @error('kk')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="nik" type="number" name="nik" placeholder="" autocomplete="off">
                                @error('nik')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="alamat" type="text" name="alamat" placeholder="" autocomplete="off">
                                @error('alamat')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
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
                                @error('jk')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="tempat_lahir" type="text" name="tempat_lahir" required autocomplete="off">
                                @error('tempat_lahir')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Lahir </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="tgl_lahir" type="date" name="tgl_lahir" autocomplete="off">
                                @error('tgl_lahir')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Nama Wali </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama_wali" type="text" name="nama_wali" autocomplete="off">
                                @error('nama_wali')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Alamat Sekolah </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="alamat_sekolah" type="text" name="alamat_sekolah" autocomplete="off">
                                @error('alamat_sekolah')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
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
                                @error('jk')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pekerjaa Wali</label>
                            <div class="col-sm-9">
                                {!! Form::select('pekerjaan', $pekerjaan, null, [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'Pilih Pekerjaan',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('pekerjaan') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                {!! Form::select('pendidikan', $pendidikan, null, [
                                'class' => 'form-control js-example-basic-single',
                                'placeholder' => 'Pilih Pendidikan',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('pendidikan') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Kelas Pendidikan</label>
                            <div class="col-sm-9">
                                {!! Form::select('kelas', $kelas_pendidikan, null, [
                                'class' => 'form-control js-example-basic-single',
                                'placeholder' => 'Pilih Kelas Pendidikan',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('kelas') }}</span>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        // Ketika pilihan pendata berubah
        $('select[name="survior"]').change(function(){
            var surviorId = $(this).val();
            if(surviorId){
                // Lakukan AJAX request
                $.ajax({
                    url: '{{ route("get-kecamatan") }}',
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
@endpush
@endsection