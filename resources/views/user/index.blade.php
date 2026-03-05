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
    <h3 class="card-title">Área de desenvolvimento</h3>
  </div>
  <div class="card-body">
      <div id="successMessage" class="alert alert-success d-none"></div>
      <div id="errorMessage" class="alert alert-danger d-none"></div>

      @if($errors->any())
          <div class="alert alert-danger d-flex align-items-center" role="alert">
                <div>
                      @foreach($errors->all() as $error)
                          {{ $error }}
                      @endforeach
                </div>
              </div>
      @endif
    <table class="table table-bordered">
      <thead>
        <tr>
            <th>Avatar</th>
              <th>Nome</th>
              <th>Email</th>
              <th colspan="4">Ações</th>
            </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
            <tr>
                <td>
                    <div class="image">
                        <img src="{{ $user->avatar
                  ? asset('storage/'.$user->avatar)
                  : asset('storage/avatars/default.png') }}"
                             class="img-circle elevation-2"
                             style="width:40px; height:40px; border-radius:50%; object-fit:cover;"
                             alt="User Image">
                    </div>
                </td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                  <button type="button" class="btn btn-danger" onclick="deleteUser(event, {{ $user->id }})">
                      DELETAR
                  </button>
              </td>
              <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">EDITAR</a>
              </td>
              <td>
                <a href="{{ route('photos.index', $user->id) }}" class="btn btn-secondary">FOTOS</a>
              </td>
        </tr>
      @endforeach
      </tbody>
    </table>
      <div class="btn-group">
    <a href="{{ route('users.create') }}" class="btn btn-success mt-3">CRIAR USUARIO</a>
      <button class="btn btn-info mt-3" onclick="generateUsers(event)">GERAR USUÁRIOS</button>
      </div>
  </div>
</div>
@endsection
