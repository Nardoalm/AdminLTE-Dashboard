@extends('layouts.admin')

@section('title', 'Users CRUD - Editar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Editar usuario</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users CRUD</a></li>
          <li class="breadcrumb-item active">Editar</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Atualizar usuario</h3>
  </div>
  <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <div class="form-group">
        <label for="user-name">Nome</label>
        <input type="text" name="name" id="user-name" class="form-control" placeholder="Nome" value="{{ $user->name }}">
      </div>
      <div class="form-group">
        <label for="user-email">Email</label>
        <input type="email" name="email" id="user-email" class="form-control" placeholder="Email" value="{{ $user->email }}">
      </div>
      <div class="form-group">
        <label for="user-password">Senha atual</label>
        <input type="password" name="current_password" id="user-password" class="form-control" placeholder="Senha atual">
      </div>
      <div class="form-group">
        <label for="user-avatar">Avatar</label>
        <div class="mb-2">
          <img src="{{ $user->avatar_url }}" alt="Avatar atual" class="img-circle elevation-2" style="width: 48px; height: 48px;">
        </div>
        <input type="file" name="avatar" class="form-control-file" id="user-avatar" accept="image/*">
      </div>
      @error('current_password')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-info">ATUALIZAR</button>
      <a href="{{ route('users.index') }}" class="btn btn-secondary">VOLTAR</a>
    </div>
  </form>
</div>
@endsection
