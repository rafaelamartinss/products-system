@extends('layouts.app')

@section('content')
<h3>Produtos</h3>

@can('create', App\Product::class)
    <a class="btn btn-small btn-info" href="{{ URL::to('products/create') }}">Novo Produto</a><br><br>
@endcan

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        @can('show', App\Product::class)
            <td></td>
        @endcan
        <td>ID</td>
        <td>Nome</td>
        <td>Valor</td>
        <td>Quantidade</td>
        @can('update', App\Product::class)
            <td></td>
            <td></td>
        @endcan
    </tr>
    </thead>
    <tbody>
    @foreach($products as $key => $value)
        <tr>
            @can('show', App\Product::class)
                <td>
                    <a class="btn btn-small btn-primary" href="{{ route('products.show', $value->id) }}">Detalhes</a>
                </td>
            @endcan
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->value }}</td>
            <td>{{ $value->quantity }}</td>
            @can('update', App\Product::class)
                <td>
                    <a class="btn btn-small btn-info" href="{{ route('products.edit', $value->id) }}">Editar</a>
                    <form action="{{ route('products.destroy', $value->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Excluir</button>
                    </form>
                </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
