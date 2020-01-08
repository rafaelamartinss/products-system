@extends('layouts.app')

@section('content')
<h3>Categorias</h3>

@can('create', App\Category::class)
    <a class="btn btn-small btn-info" href="{{ URL::to('categories/create') }}">Nova Categoria</a><br><br>
@endcan

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        @can('show', App\Category::class)
            <td></td>
        @endcan
        <td>ID</td>
        <td>Nome</td>
        @can('update', App\Category::class)
            <td></td>
            <td></td>
        @endcan
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $key => $value)
        <tr>
            @can('show', App\Category::class)
                <td>
                    <a class="btn btn-small btn-primary" href="{{ route('categories.show', $value->id) }}">Detalhes</a>
                </td>
            @endcan
            <td>{{ $value->id }}</td>
            <td>{{ $value->name }}</td>
            @can('update', App\Category::class)
                <td>
                    <a class="btn btn-small btn-info" href="{{ route('categories.edit', $value->id) }}">Editar</a>
                    <form action="{{ route('categories.destroy', $value->id)}}" method="post">
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
