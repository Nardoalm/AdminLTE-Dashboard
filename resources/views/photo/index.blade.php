@extends('layouts.admin')

@section('title', 'Users CRUD')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fotos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Fotos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            <h5 class="mb-3">Carrosel</h5>
            @php
                $orderedPhotos = $user->photos->sortByDesc('is_default')->values();
            @endphp

            @if ($orderedPhotos->isNotEmpty())
                <div id="carouselPhotos" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($orderedPhotos as $photo)
                            <li data-target="#carouselPhotos" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                        @foreach ($orderedPhotos as $photo)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $photo->path) }}"
                                     class="d-block w-100"
                                     style="width: 100%; height: 400px; object-fit: cover;"
                                     alt="Foto do usuário">
                            </div>
                        @endforeach
                    </div>

                    <a class="carousel-control-prev" href="#carouselPhotos" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselPhotos" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                </div>
            @else
                <div class="alert alert-warning mb-0">
                    Nenhuma foto para exibir no carrossel.
                </div>
            @endif
        </div>
    </div>

    <h5 class="mb-3">Todas as fotos:</h5>

    <div class="row g-3">
        @foreach ($user->photos as $photo)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $photo->path) }}"
                         class="img-fluid rounded shadow-sm card-img-top"
                         style="width: 100%; height: 200px; object-fit: cover;"
                         alt="User photo">
                    <div class="card-body">
                        <form action="{{ route('photos.destroy', [$user, $photo]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <form action="{{ route('photos.set_default', [$user, $photo]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-info">ADICIONAR COMO PADRÃO</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div>
        <a href="{{ route('photos.create', $user->id) }}" class="btn btn-success mt-3">ADICIONAR</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">VOLTAR</a>
    </div>
@endsection
