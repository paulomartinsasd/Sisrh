@extends('layouts.default')

@section('title', 'SisRH - Usuários')
@section('content')
    <x-btn-create>
      <x-slot name="rota">users.create</x-slot>
      <x-slot name="title">Cadastrar Usuários</x-slot>
    </x-btn-create>

    <h1 class="fs-2 mb-3">Usuário</h1>

    @if(Session::get('sucesso'))
        <div class="alert alert-success text-center">{{ Session::get('sucesso') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Tipo</th>
            <th scope="col" style="width: 110px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="alight-middle">
                    <th class="text-center" scope="row">{{ $user->id }}</th>
                    <td class="text-center">{{ $user->name}}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->tipo }}</td>
                    <td>
                        <a href="{{ route('users.edit',$user->id) }}" title="Editar" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                        <a href="" title="Deletar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $user->id }}"><i class="bi bi-trash" ></i></a>
                        {{-- Inserir o Componente modal na view --}}
                        <x-modal-delete>
                            <x-slot name="id">{{ $user->id }}</x-slot>
                            <x-slot name="tipo">usuário</x-slot>
                            <x-slot name="nome">{{ $user->name }}</x-slot>
                            <x-slot name="rota">users.destroy</x-slot>
                        </x-modal-delete>
                    </td>s
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
