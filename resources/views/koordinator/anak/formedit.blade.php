@extends('layouts.koordinator.master')

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
                            <label for="" class="col-sm-3 col-form-label">Pendata</label>
                            <div class="col-sm-9">
                                <select name="survior" id="survior" class="js-example-basic-single">
                                    <option value="">--Pilih Survior--</option>
                                    @forelse ($survior as $ids => $nama)
                                    <option value={{ "$ids" }} @if($model->id_survior== $ids) selected='selected' @endif>{{$nama}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <span class="text-danger">{{ $errors->first('survior') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama" type="text" name="nama" autocomplete="off" value="{{ old('nama', $model->nama_anak) }}">
                                @error('nama')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Nomor KK</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="kk" type="number" name="kk" placeholder="" autocomplete="off" value="{{ old('kk', $model->nomor_kk) }}">
                                @error('kk')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="nik" type="number" name="nik" placeholder="" autocomplete="off" value="{{ old('nik', $model->nomor_nik) }}">
                                @error('nik')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="alamat" type="text" name="alamat" placeholder="" autocomplete="off" value="{{ old('alamat', $model->alamat) }}">
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
                                    <option value="1" @if($model->jenis_kelamin=='1') selected='selected' @endif>Laki Laki</option>
                                    <option value="0" @if($model->jenis_kelamin=='0') selected='selected' @endif>Perempuan</option>
                                </select>
                                @error('jk')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input class=" form-control" id="tempat_lahir" type="text" name="tempat_lahir" required autocomplete="off" value="{{ old('tempat_lahir', $model->tempat_lahir) }}">
                                @error('tempat_lahir')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Tanggal Lahir </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="tgl_lahir" type="date" name="tgl_lahir" autocomplete="off" value="{{ old('tgl_lahir', $model->tgl_lahir) }}">
                                @error('tgl_lahir')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Nama Wali </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="nama_wali" type="text" name="nama_wali" autocomplete="off" value="{{ old('nama_wali', $model->nama_wali) }}">
                                @error('nama_wali')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Alamat Sekolah </label>
                            <div class="col-sm-9">
                                <input class="form-control" id="alamat_sekolah" type="text" name="alamat_sekolah" autocomplete="off" value="{{ old('alamat_sekolah', $model->alamat_sekolah) }}">
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
                                    <option value="1" @if($model->status_anak=='1') selected='selected' @endif>Yatim</option>
                                    <option value="2" @if($model->status_anak=='2') selected='selected' @endif>Piatu</option>
                                    <option value="3" @if($model->status_anak=='3') selected='selected' @endif>Yatim Piatu</option>
                                </select>
                                @error('status_anak')
                                <p class="help-block">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pekerjaa Wali</label>
                            <div class="col-sm-9">

                                <select name="pekerjaan" id="pekerjaan" class="js-example-basic-single">
                                    <option value="">--Pilih Pekerjaan--</option>
                                    @forelse ($pekerjaan as $id => $kerjaan)
                                    <option value={{ "$id" }} @if($model->id_pekerjaan_wali== $id) selected='selected' @endif>{{$kerjaan}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <span class="text-danger">{{ $errors->first('pekerjaan') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Pendidikan</label>
                            <div class="col-sm-9">
                                <select name="pendidikan" id="pendidikan" class="js-example-basic-single">
                                    <option value="">--Pilih Pendidikan--</option>
                                    @forelse ($pendidikan as $idp => $pendidikan)
                                    <option value={{ "$idp" }} @if($model->id_pendidikan== $idp) selected='selected' @endif>{{$pendidikan}}</option>
                                    @empty
                                    @endforelse
                                </select>

                                <span class="text-danger">{{ $errors->first('pendidikan') }}</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="" class="col-sm-3 col-form-label">Kelas Pendidikan</label>
                            <div class="col-sm-9">
                                <select name="kelas" id="kelas" class="js-example-basic-single">
                                    <option value="">--Pilih Kelas Pendidikan--</option>
                                    @forelse ($kelas_pendidikan as $idkp => $kpendidikan)
                                    <option value={{ "$idkp" }} @if($model->id_kelas_pendidikan== $idkp) selected='selected' @endif>{{$kpendidikan}}</option>
                                    @empty
                                    @endforelse
                                </select>
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

@endpush
@endsection