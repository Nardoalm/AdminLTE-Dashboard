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
    <h3 class="card-title">Area de desenvolvimento</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th colspan="3">Ações</th>
        </tr>
      </thead>
      <tbody>
      @foreach($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">DELETAR</button>
            </form>
          </td>
          <td>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">EDITAR</a>
          </td>
            <td>
                <a href="{{ route('users.photos', $user->id) }}" class="btn btn-secondary">FOTOS</a>
            </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <a href="{{ route('users.create') }}" class="btn btn-success mt-3">CRIAR USUARIO</a>
  </div>
</div>
@endsection
