@extends('templates.base')
@section('title', 'Usuários')
@section('h1', 'Página de Usuários')

@section('content')
<div class="row">
    <div class="col">
        <p>Sejam bem-vindos à página de usuários</p>
    </div>
</div>

<div class="row">
    <table class="table">
        <tr>
            <th>ID</th>
            <th width="50%">Nome</th>
            <th>E-mail</th>
        </tr>

        @foreach ($usuarios as $usuario)
        @if($usuario->admin)
            <tr class="bg-dark">
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
            </tr>
        @else
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
            </tr>
        @endif
        @endforeach
    </table>
</div>
@endsection