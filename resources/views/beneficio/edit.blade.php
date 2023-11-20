@extends('layouts.default')

@section('title', 'SisRH - Cadastro de Beneficios')

@section('content')
    <h1 class="fs-2 mb-3">Alterar Dados do Beneficios</h1>
    <form class="row g-3" method="POST" action="{{ route('beneficios.update', $beneficios->id)}}" enctype="multipart/form-data">
        {{-- Criar hash de segurança para submissão do formulário --}}
        @csrf {{-- Gera um token para e libera a conexão via POST --}}
        @method('PUT') {{-- Força o metodo a ser enviado como PUT pois o HTML não suporta o Metodo PUT --}}

        @include('beneficio.partials.form')

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{route('beneficios.index')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
@endsection
