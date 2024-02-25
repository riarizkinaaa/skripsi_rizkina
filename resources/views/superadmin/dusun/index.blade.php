@extends('layouts.admin.master')

@section('title')Dusun {{ $title }}
@endsection


@section('content')

<div class="container-fluid">
    <h4>Dusun</h4>
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
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                    </div>
                    <div class="col-md-10">

                        <div class="row">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row">
                                <div class="col-md-3">
                                    {!! Form::select('id_kecamatan', $kecamatan, request('id_kecamatan'), [
                                    'class' => 'form-control form-control-sm select2 bs4',
                                    'placeholder' => 'All Kecamatan',
                                    ]) !!}
                                </div>
                                <div class="col-md-3">
                                    {!! Form::select('id_desa', $desa, request('id_desa'), [
                                    'class' => 'form-control form-control-sm select2 bs4',
                                    'placeholder' => 'All Desa',
                                    ]) !!}
                                </div>
                                <div class="col-md-2 ">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control form-control-sm', 'placeholder' => 'Cari Nama Dusun']) !!}
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
                                    <th>Nama Desa</th>
                                    <th>Nama Dusun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = $models->firstItem();
                                @endphp
                                @forelse ($models as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$item->nama_kecamatan}}</td>
                                    <td>{{$item->nama_desa}}</td>
                                    <td>{{$item->dusun}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn-square tombol-ubah" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#tomboUbah" data-id="{{$item->id_dusun}}"><i class="fa fa-edit"></i></button>
                                        <form onsubmit="return confirm('Are You Sure ?');" action="/superadmin/dusun/{{$item->id_dusun}}" method="POST" class="d-inline ">
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
            <form action="{{ route('dusun.store') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Dusun</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
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
                    <div class="mb-3 draggable">

                        <label for="input-text-1">Nama Desa</label>
                        <select name="desa" id="desa" class="form-control btn-square @error('desa') is-invalid @enderror">

                        </select>
                        @error('desa')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <input type="hidden" name="id" id="id">
                        <label for="input-text-1">Nama Dusun</label>
                        <input type="text" name="dusun" id="dusun" class="form-control @error('dusun') is-invalid @enderror" autocomplete="off">
                        @error('dusun')
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Ubah Dusun</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
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
                    <div class="mb-3 draggable">
                        <label for="input-text-1">Nama Desa</label>
                        <select name="desa_ubah" id="desa_ubah" class="form-control btn-square @error('desa_ubah') is-invalid @enderror">
                            @forelse ($desa as $id_desa => $nama_desa)
                            <option value={{ "$id_desa" }}>{{$nama_desa}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('desa_ubah')
                        <p class="help-block">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3 draggable">
                        <input type="hidden" name="id_ubah" id="id_ubah">
                        <label for="input-text-1">Nama Dusun</label>
                        <input type="text" name="dusun_ubah" id="dusun_ubah" class="form-control @error('dusun_ubah') is-invalid @enderror" autocomplete="off">
                        @error('dusun_ubah')
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
    // $(document).ready(function() {
    //     $('.kec').select2();
    // });

    $(document).ready(function() {

        $("#kec").change(function() {
            var id = $(this).val();
            // console.log(id_kec);
            $.ajax({
                url: '/superadmin/getdesa',
                type: 'GET',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response)
                    var len = response.length;
                    $("#desa").empty();
                    $("#desa").append("<option value=''>-- Pilih Desa --</option>");
                    for (var i = 0; i < len; i++) {
                        var id = response[i]['id_desa'];
                        var name = response[i]['nama_desa'];

                        $("#desa").append("<option value='" + id + "'>" + name + "</option>");
                    }
                }
            });
        })
    })
    $(function() {

        $('.tombol-ubah').on('click', function() {
            const id = $(this).data('id')
            // let id_default
            $('.form-ubah form').attr('action', '/superadmin/dusun/' + id)
            // console.log(id);
            $.ajax({
                url: `/superadmin/dusun/` + id + `/edit`,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    $('#id_ubah').val(data.id_desa)
                    $('#desa_ubah').val(data.id_desa)
                    $('#kecamatan_ubah').val(data.id_kecamatan)
                    $('#dusun_ubah').val(data.dusun)
                    // id_default = data.id_kecamatan
                }
            })
            // console.log(id_default)
            $("#kecamatan_ubah").change(function() {
                var id = $(this).val();
                // console.log(id_kec);
                $.ajax({
                    url: '/superadmin/getdesa',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response)
                        var len = response.length;
                        $("#desa_ubah").empty();
                        $("#desa_ubah").append("<option value=''>-- Pilih Desa --</option>");
                        for (var i = 0; i < len; i++) {
                            var id = response[i]['id_desa'];
                            var name = response[i]['nama_desa'];

                            $("#desa_ubah").append("<option value='" + id + "'>" + name + "</option>");
                        }
                    }
                });
            })
        })
    })
</script>
@endpush
@endsection