@extends('layouts.default')

@section('title', 'SisRH - Departamentos')
@section('content')
    <x-btn-create>
      <x-slot name="rota">departamentos.create</x-slot>
      <x-slot name="title">departamentos</x-slot>
    </x-btn-create>

    <h1 class="fs-2 mb-3">Departamentos</h1>

    @if(Session::get('sucesso'))
        <div class="alert alert-success text-center">{{ Session::get('sucesso') }}</div>
    @endif

    <x-busca>
        <x-slot name="rota">funcionarios.index</x-slot>
        <x-slot name="tipo">Funcionário</x-slot>
    </x-busca>


    <table class="table table-striped">
        <thead class="table-dark">
            <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Total de Funcionários</th>
            <th scope="col" style="width: 110px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departamentos as $departamento)
                <tr class="alight-middle">
                    <th scope="row" class="text-center">{{ $departamento->id }}</th>
                    <td class="text-center">{{ $departamento->nome }}</td>
                    <td class="text-center">{{ $departamento->funionariosAtivos->count(); }}</td>
                    <td>
                        <a href="{{ route('departamentos.edit',$departamento->id) }}" title="Editar" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                        <a href="" title="Deletar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $departamento->id }}"><i class="bi bi-trash"></i></a>
                        <x-modal-delete>
                            <x-slot name="id">{{ $departamento->id }}</x-slot>
                            <x-slot name="tipo">Departamento</x-slot>
                            <x-slot name="nome">{{ $departamento->nome }}</x-slot>
                            <x-slot name="rota">departamentos.destroy</x-slot>
                        </x-modal-delete>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
