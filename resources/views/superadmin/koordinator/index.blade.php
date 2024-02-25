@extends('layouts.admin.master')

@section('title'){{ $title }}
@endsection


@section('content')
<div class="container-fluid">
    <h4>{{ $title }}</h4>
</div>


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

<div class="caontainer-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row p-3">
                    <div class="col-md-2">
                        <button hidden class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                    </div>
                    <div class="col-md-10">

                        <div class="row">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::select('id_kecamatan', $kecamatan, request('id_kecamatan'), [
                                    'class' => 'form-control form-control-sm select2 bs4',
                                    'placeholder' => 'All Kecamatan',
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control form-control-sm', 'placeholder' => 'Cari Nama Koordinator']) !!}
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i> Filter</button>
                                    <a href="{{ route($routePrefix. '.index') }}" class="btn btn-sm btn-danger"><i class="fa fa-filter"></i> Clear</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
                                    <th>Nama Koordinator</th>
                                    <th>No Handphone</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = $models->firstItem();
                                @endphp
                                @forelse ($models as $item)
                                <tr>
                                    <!-- perulangan data -->
                                    <td>{{ $i++ }}</td>
                                    <td>{{$item->nama_kecamatan}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->no_hp}}</td>

                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn-square tombol-ubah" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#tomboUbah" data-id="{{$item->id_koordinator}}"><i class="fa fa-edit"></i></button>
                                        <form onsubmit="return confirm('Are You Sure ?');" action="/superadmin/koordinator/{{$item->id_koordinator}}" method="POST" class="d-inline ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-square "><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">Data tidak ada</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($models->hasPages())
                <div class="card-footer pagination justify-content-end pagination-primary">
                    {{ $models->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- mmodal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('koordinator.store') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Koordinator</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3 draggable">
                        <input type="hidden" name="id" id="id">
                        <label for="input-text-1">Nama Koordinator</label>
                        <input class="form-control btn-square @error('nama') is-invalid @enderror" id="nama" name="nama" type="text" placeholder="Nama Koordinator" autocomplete="off">
                        @error('nama')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">NIK</label>
                        <input class="form-control btn-square @error('nik') is-invalid @enderror" id="nik" name="nik" type="number" placeholder="NIK" autocomplete="off">
                        @error('nik')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control  @error('alamat') is-invalid @enderror" cols="30" rows="5"></textarea>
                        @error('alamat')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">No HP</label>
                        <input class="form-control btn-square @error('no') is-invalid @enderror" id="no" name="no" type="number" placeholder="NO Handphone" autocomplete="off">
                        @error('no')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Email</label>
                        <input class="form-control btn-square @error('no') is-invalid @enderror" id="email" name="email" type="email" placeholder="Email" autocomplete="off">
                        @error('email')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Userlog</label>
                        <select name="userlog" id="userlog" class="form-control btn-square @error('kec') is-invalid @enderror">
                            <option value="">--Pilih Userlog--</option>
                            @forelse ($userlog as $item )
                            @if ($item->id_role == 6)
                            <option value={{ $item->id }}>{{$item->username}}</option>
                            @endif
                            @empty
                            @endforelse
                        </select>
                        @error('userlog')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 draggable">
                        <label for="input-text-1">Nama Kecamatan</label>
                        <select name="kec" id="kec" class="form-control btn-square @error('kec') is-invalid @enderror">
                            <option value="">--Pilih Kecamatan--</option>
                            @forelse ($kecamatan as $id_kec => $nama_kec)
                            <option value={{ "$id_kec" }}>{{$nama_kec}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('kec')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Ubah Koordinator</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 draggable">
                        <input type="hidden" name="id_ubah" id="id_ubah">
                        <label for="input-text-1">Nama Koordinator</label>
                        <input class="form-control btn-square @error('nama_ubah') is-invalid @enderror" id="nama_ubah" name="nama_ubah" type="text" placeholder="Nama Koordinator" required autocomplete="off">
                        @error('nama_ubah')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">NIK</label>
                        <input class="form-control btn-square @error('nik') is-invalid @enderror" id="nik_ubah" name="nik_ubah" type="number" placeholder="NIK" autocomplete="off">
                        @error('nik')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Alamat</label>
                        <textarea name="alamat_ubah" id="alamat_ubah" class="form-control  @error('alamat') is-invalid @enderror" cols="30" rows="5"></textarea>
                        @error('alamat')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">No HP</label>
                        <input class="form-control btn-square @error('no') is-invalid @enderror" id="no_ubah" name="no_ubah" type="number" placeholder="NO Handphone" autocomplete="off">
                        @error('no')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Email</label>
                        <input class="form-control btn-square @error('no') is-invalid @enderror" id="email_ubah" name="email_ubah" type="email" placeholder="Email" autocomplete="off">
                        @error('email')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Userlog</label>
                        <select name="userlog_ubah" id="userlog_ubah" class="form-control btn-square @error('kec') is-invalid @enderror">
                            <option value="">--Pilih Userlog--</option>
                            @forelse ($userlog as $item )
                            @if ($item->id_role == 6)
                            <option value={{ $item->id }}>{{$item->username}}</option>
                            @endif
                            @empty
                            @endforelse
                        </select>
                        @error('userlog')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Nama Kecamatan</label>
                        <select name="kecamatan_ubah" id="kecamatan_ubah" class="form-control btn-square @error('kecamatan_ubah') is-invalid @enderror">
                            <option value="">--Pilih Kecamatan--</option>
                            @forelse ($kecamatan as $id_kec => $nama_kec)
                            <option value={{ "$id_kec" }}>{{$nama_kec}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('kecamatan')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
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
@push('scripts')



<script>
    $(function() {

        $('.tombol-ubah').on('click', function() {
            const id = $(this).data('id')
            $('.form-ubah form').attr('action', 'koordinator/' + id)
            // console.log(id);

            $.ajax({
                url: `koordinator/` + id + `/edit`,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    $('#id_ubah').val(data.id_koordinator)
                    $('#nama_ubah').val(data.nama)
                    $('#nik_ubah').val(data.nik)
                    $('#alamat_ubah').val(data.alamat)
                    $('#no_ubah').val(data.no_hp)
                    $('#email_ubah').val(data.email)
                    $('#userlog_ubah').val(data.id_user)
                    $('#kecamatan_ubah').val(data.id_kecamatan)

                }
            })
        })
    })
</script>
@endpush
@endsection