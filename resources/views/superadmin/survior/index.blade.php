@extends('layouts.admin.master')

@section('title')Pendata {{ $title }}
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
                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" hidden data-original-title="test" data-bs-target="#exampleModal">Add New</button>
                        
                    </div>

                    <div class="col-md-10">

                        <div class="row">
                            {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                            <div class="row justify-content-end">

                                <div class="col-md-4 ">
                                    {!! Form::text('q', request('q'), ['class' => 'form-control form-control-sm', 'placeholder' => 'Cari Nama Lengkap']) !!}
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
                        <table class="table table-striped table-hover table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIK</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @php
                                $i = $models->firstItem();
                                @endphp
                                @forelse ($models as $item)
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->nama_lengkap}}</td>
                                    <td>{{$item->nik}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <a href="{{ route('survior.show', $item->id_survior) }}" class="btn btn-sm btn-info"> <i class="fa fa-eye"></i></a>
                                        <form onsubmit="return confirm('Are You Sure ?');" action="survior/{{$item->id_survior}}" method="POST" class="d-inline ">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-square "><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
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
@endsection