@extends('layouts.admin')

@section('title', 'Users CRUD')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Usuários</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Usuários</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <h5 class="mb-3">Foto padrão</h5>

            @if($user->defaultPhoto)
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $user->defaultPhoto->path) }}"
                         class="img-fluid rounded shadow-sm"
                         style="width: 220px; height: 220px; object-fit: cover;"
                         alt="Foto padrão">
                </div>
            @endif


            <h5 class="mb-3">Todas as fotos</h5>

            <div class="row g-3">
                @foreach ($user->photos as $photo)
                    <div class="col-6 col-md-4 col-lg-3">
                        <img src="{{ asset('storage/' . $photo->path) }}"
                             class="img-fluid rounded shadow-sm"
                             style="width: 100%; height: 200px; object-fit: cover;"
                             alt="User photo">
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div>
        <a href="{{ route('photos.create', $user->id) }}" class="btn btn-success mt-3">Adicionar</a>
    </div>
@endsection

<style>
    .photo-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 12px;
    }
</style>
