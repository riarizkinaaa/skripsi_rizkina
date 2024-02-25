@extends('layouts.pimpinan.master')

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
                <div class="row m-3">
                    <div class="col-md-12">
                        {!! Form::open(['route' => $routePrefix, 'method' => 'GET']) !!}
                        <div class="row">

                            <div class="row">
                                <div class="col-md-4">
                                    {!! Form::select('id_survior', $survior, request('id_survior'), [
                                    'class' => 'js-example-basic-single',
                                    'placeholder' => 'All Pendata',
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::select('id_pendidikan', $pendidikan, request('id_pendidikan'), [
                                    'class' => 'js-example-basic-single',
                                    'placeholder' => 'All Pendidikan',
                                    ]) !!}
                                </div>
                                <div class="col-md-4">
                                    {!! Form::select('id_kelas_pendidikan', $kelas_pendidikan, request('id_kelas_pendidikan'), [
                                    'class' => 'js-example-basic-single',
                                    'placeholder' => 'All Kelas Pendidikan',
                                    ]) !!}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 ">
                                    {!! Form::select('id_kecamatan', $kecamatan, request('id_kecamatan'), [
                                    'class' => 'js-example-basic-single',
                                    'placeholder' => 'All Kecamatan',
                                    ]) !!}
                                </div>
                                <div class="col-md-4 ">
                                    {!! Form::select('id_desa', $desa, request('id_desa'), [
                                    'class' => 'js-example-basic-single',
                                    'placeholder' => 'All Desa',
                                    ]) !!}
                                </div>
                                <div class="col-md-4 ">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control ', 'placeholder' => 'Cari NIK ']) !!}
                                </div>
                            </div>
                            <div class="row mt-2 justify-content-end">
                                <div class="col-md-4 ">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i> Filter</button>
                                    <a href="{{ route($routePrefix) }}" class="btn btn-sm btn-danger"><i class="fa fa-filter"></i> Clear</a>
                                </div>
                            </div>

                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row  justify-content-between">
                    <div class="col-md-3 m-3">
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg"><i class="fa fa-download"></i> Export </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm m-0" id="myTable">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Usia</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = $models->firstItem();
                                @endphp
                                @forelse ($models as $item)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$item->nama_anak}}</td>
                                    <td>{{$item->nomor_nik}}</td>
                                    <td>
                                        @if ($item->jenis_kelamin == 1)
                                        Laki Laki
                                        @else
                                        Perempuan
                                        @endif
                                    </td>
                                    <td>{{$item->usia}}</td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Data tidak ada</td>
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
<!-- Large modal-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Filter Data Export</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="export_anak_sudahver" method="GET">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-4">
                                {!! Form::select('id_survior', $survior, request('id_survior'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Pendata',
                                ]) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('id_pendidikan', $pendidikan, request('id_pendidikan'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Pendidikan',
                                ]) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::select('id_kelas_pendidikan', $kelas_pendidikan, request('id_kelas_pendidikan'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Kelas Pendidikan',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4 ">
                                {!! Form::select('id_kecamatan', $kecamatan, request('id_kecamatan'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Kecamatan',
                                ]) !!}
                            </div>
                            <div class="col-md-4 ">
                                {!! Form::select('id_desa', $desa, request('id_desa'), [
                                'class' => 'js-example-basic-single',
                                'placeholder' => 'All Desa',
                                ]) !!}
                            </div>
                            <div class="col-md-4 ">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Export</button>
                                <a href="{{ route($routePrefix) }}" class="btn btn-sm btn-danger"><i class="fa fa-filter"></i> Clear</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection