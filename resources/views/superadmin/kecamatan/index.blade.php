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
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                    </div>
                    <div class="col-md-10">

                        <div class="row">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row justify-content-end">

                                <div class="col-md-4 ">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control form-control-sm', 'placeholder' => 'Cari Nama Kecamatan']) !!}
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
                                    <th>file geojson</th>
                                    <th>file js</th>
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
                                    <td>
                                        @if($item->file1)
                                            {{ basename($item->file1, '.' . pathinfo($item->file1, PATHINFO_EXTENSION)) }}
                                        @else
                                            Tidak Ada File
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->file2)
                                            {{ basename($item->file2, '.' . pathinfo($item->file2, PATHINFO_EXTENSION)) }}
                                        @else
                                            Tidak Ada File
                                        @endif
                                    </td>                                    
                                    
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning btn-square tombol-ubah" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#tomboUbah" data-id="{{$item->id_kecamatan}}"><i class="fa fa-edit"></i></button>
                                        <form onsubmit="return confirm('Are You Sure ?');" action="kecamatan/{{$item->id_kecamatan}}" method="POST" class="d-inline ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-square "><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Data tidak ada</td>
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
            <form action="{{ route('kecamatan.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kecamatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3 draggable">
                        <input type="hidden" name="id" id="id">
                        <label for="input-text-1">Nama Kecamatan</label>
                        <input class="form-control btn-square @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" type="text" placeholder="Nama Kecamatan " autocomplete="off">
                        @error('kecamatan')
                        <p class="help-block">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="mb-3 draggable">
                        <label for="file1">File Peta Wilayah (.geojson)</label>
                        <input type="file" name="file1" class="form-control btn-square @error('file1') is-invalid @enderror">
                        @error('file1')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3 draggable">
                        <label for="file2">File Peta Wilayah (.JS)</label>
                        <input type="file" name="file2" class="form-control btn-square @error('file2') is-invalid @enderror">
                        @error('file2')
                            <p class="invalid-feedback">{{ $message }}</p>
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Ubah Kecamatan</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 draggable">
                        <input type="hidden" name="id_ubah" id="id_ubah">
                        <label for="input-text-1">Nama Kecamatan</label>
                        <input class="form-control btn-square @error('kecamatan_ubah') is-invalid @enderror" id="kecamatan_ubah" name="kecamatan_ubah" type="text" placeholder="Nama kecamatan" required autocomplete="off">
                        @error('kecamatan_ubah')
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
@endpush
@endsection