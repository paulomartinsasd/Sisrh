@extends('layouts.default')

@section('title', 'SisRH - Cadastro de Usuário')

@section('content')
    <h1 class="fs-2 mb-3">Cadastro de Usuários</h1>
    <form class="row g-3" method="POST" action="{{ route('users.store')}}" enctype="multipart/form-data">
        {{-- Criar hash de segurança para submissão do formulário --}}
        @csrf {{-- Gera um token para e libera a conexão via POST --}}
        @include('users.partials.form')
        <div class="col-12">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="{{route('users.index')}}" class="btn btn-danger">Cancelar</a>
  </div>
</form>
@endsection
