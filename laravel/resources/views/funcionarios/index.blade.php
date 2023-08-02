@extends('layouts.default')

@section('title', 'SisRH - Funcionários')
@section('content')
    <x-btn-create/>
    <h1 class="fs-2 mb-3">Funcionários</h1>
    <table class="table table-striped">
  <thead class="table-dark">
    <tr class="text-center">
      <th scope="col">ID</th>
      <th scope="col">Foto</th>
      <th scope="col">Nome</th>
      <th scope="col">Cargo</th>
      <th scope="col">Departamentos</th>
      <th scope="col" width="110px">Ações</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Foto</td>
      <td>Edemilton</td>
      <td>Professor</td>
      <td>Sistema de informações</td>
      <td>
        <a href="" title="Editar" class="btn btn-primary"><i class="bi bi-pen"></i></a>
        <a href="" title="Deletar" class="btn btn-danger"><i class="bi bi-trash"></i></a>
      </td>
    </tr>
  </tbody>
</table>
@endsection