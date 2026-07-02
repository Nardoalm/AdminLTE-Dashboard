@extends('layouts.admin')

@section('title', 'Dashboard Financeiro')

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-sm-6">
                    <h1 class="m-0">Controle Financeiro</h1>
                    <small>Receitas, gastos e saldo</small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>R$ {{ number_format($expense, 2, ',', '.') }}</h3>
                    <p>Gastos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>R$ {{ number_format($income, 2, ',', '.') }}</h3>
                    <p>Receitas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>R$ {{ number_format($balance, 2, ',', '.') }}</h3>
                    <p>Saldo</p>
                </div>
                <div class="icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Lançamentos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-receipt"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Adicionar lançamento</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('expenses.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="type">Tipo</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>Gasto</option>
                                <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>Receita</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="category">Categoria</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="food" {{ old('category') === 'food' ? 'selected' : '' }}>Comida</option>
                                <option value="education" {{ old('category') === 'education' }}>Educação</option>
                                <option value="bills">Contas</option>
                                <option value="transport" {{ old('category') === 'transport' ? 'selected' : '' }}>Transporte</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="amount">Valor</label>
                            <input type="number" step="0.01" min="0" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="date">Data</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', now()->toDateString()) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lançamentos</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Descrição</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>
                                        @if($transaction->type === 'income')
                                            <span class="badge badge-success">Receita</span>
                                        @else
                                            <span class="badge badge-danger">Gasto</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($transaction->type === 'income')
                                            + R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        @else
                                            - R$ {{ number_format($transaction->amount, 2, ',', '.') }}
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('expenses.destroy', $transaction->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Nenhum lançamento cadastrado.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Categorias dos gastos</div>
                <div class="card-body">
                    <canvas id="graphic"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = @json($labels);
        const values = @json($values);

        const graphic = document.getElementById("graphic");

        new Chart(graphic, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: labels.map(() => {
                        return '#' + ('000000' + Math.floor(Math.random() * 16777215).toString(16)).slice(-6);
                    })
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endpush
