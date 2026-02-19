@extends('layouts.admin')

@section('title', 'Users CRUD - Criar')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Adicionar fotos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
                        <li class="breadcrumb-item active">Criar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Adicionar fotos</h3>
        </div>
            <div class="card-body">
                <form action="{{ route('photos.store', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="photos[]" multiple>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('photos.index', $user) }}" class="btn btn-info">VOLTAR</a>
            </div>
    </div>
@endsection
