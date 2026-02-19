@extends('layouts.admin')

@section('title', 'Users CRUD - Criar')

@section('content_header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Criar usuario</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users CRUD</a></li>
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
    <h3 class="card-title">Cadastrar usuario</h3>
  </div>
  <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="card-body">
      <div class="form-group">
        <label for="user-name">Usuario</label>
        <input type="text" name="name" class="form-control" id="user-name" placeholder="Usuario">
      </div>
      <div class="form-group">
        <label for="user-email">Email</label>
        <input type="email" name="email" class="form-control" id="user-email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="user-address">Endereco</label>
        <input type="text" name="address" class="form-control" id="user-address" placeholder="Endereco">
      </div>
      <div class="form-group">
        <label for="user-cep">CEP</label>
        <input type="number" name="cep" class="form-control" id="user-cep" placeholder="CEP">
      </div>
      <div class="form-group">
        <label for="user-password">Senha</label>
        <input type="password" name="password" class="form-control" id="user-password" placeholder="Senha">
      </div>
      <div class="form-group">
        <label for="user-avatar">Avatar</label>
        <input type="file" name="avatar" class="form-control-file" id="user-avatar" accept="image/*">
      </div>
      @error('email')
        <div class="text-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">CRIAR</button>
      <a href="{{ route('users.index') }}" class="btn btn-info">VOLTAR</a>
    </div>
  </form>
</div>
@endsection
