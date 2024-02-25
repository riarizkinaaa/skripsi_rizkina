@extends('layouts.survior.master')

@section('title')Profile
{{ $title }}
@endsection

@push('css')
@endpush

@section('content')
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
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">My Profile</h4>
                        <div class="card-options">
                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row mb-2">
                            <div class="profile-title">
                                <div class="media">
                                    <img class="img-70 rounded-circle" alt="" src="{{asset('assets/images/default.png')}}" />
                                    <div class="media-body">
                                        <h3 class="mb-1 f-20 txt-primary">{{Session::get('nama')}}</h3>
                                        <p class="f-12">{{Session::get('role')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="">Update Akun</h5>
                        <hr>
                        <form action="{{$route}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 draggable">

                                <label for="input-text-1">Username</label>
                                <input class="form-control btn-square @error('username') is-invalid @enderror" id="username" name="username" type="text" required autocomplete="off">
                                @error('username')
                                <p class="help-block">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="mb-3 draggable">
                                <label for="input-text-1">Password</label>
                                <input type="password" name="password" id="password" class="form-control mb-2 @error('password') is-invalid @enderror">
                                @error('password')
                                <p class="help-block text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <form class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Profile</h4>
                        <div class="card-options">
                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-9">

                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->nama_lengkap}}">

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nomor NIK</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->nik}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->alamat}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <p><input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->email}}"></p>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nomor HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->no_hp}}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nomor SK</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$data->nomor_sk}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
@endpush

@endsection