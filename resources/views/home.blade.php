@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Uneve</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="content">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <a href="{{ route('categories.list')}}">Categorias</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('products.list')}}">Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
