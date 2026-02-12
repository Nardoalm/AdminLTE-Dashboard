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
        <div class="card-header">
            <h3 class="card-title">Fotos de: {{ $user->name }}</h3>
        </div>
        <div>
            @foreach ($user->photos as $photo)
                <img class="photo-img img-thumbnail rounded mx-auto d-block border" src="{{ asset('storage/' . $photo->path) }}" width="200" alt="User photos">
            @endforeach
        </div>
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
