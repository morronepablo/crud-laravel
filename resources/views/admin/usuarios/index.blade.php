@extends('layouts.admin')

@section('content')
<div class="row">
    <h1>Listado de usuarios</h1>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
                <div class="card-tools">
                    <a href="{{url('/admin/usuarios/create')}}" class="btn btn-primary"><i class="bi bi-person-fill-add"></i> Nuevo usuario</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <center>Nro.</center>
                            </th>
                            <th>
                                <center>Nombre</center>
                            </th>
                            <th>
                                <center>Email</center>
                            </th>
                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 0; @endphp
                        @foreach($usuarios as $usuario)
                            @php
                                $contador++;
                                $id = $usuario->id;
                            @endphp
                            <tr>
                                <td><center>{{$contador}}</center></td>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                                <td>
                                    <center>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('usuarios.show', $usuario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                            <a href="{{route('usuarios.edit', $usuario->id)}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                            <form action="{{route('usuarios.destroy', $usuario->id)}}" onclick="preguntar<?=$id;?>(event)" id="miFormulario<?=$id;?>" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0 5px 5px 0"><i class="bi bi-trash"></i></button>
                                            </form>
                                            <script>
                                                function preguntar<?=$id;?>(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        title: 'Eliminar registro',
                                                        text: '¿Desea eliminar este registro?',
                                                        icon: 'question',
                                                        showDenyButton: true,
                                                        confirmButtonText: 'Eliminar',
                                                        confirmButtonColor: '#a5161d',
                                                        denyButtonColor: '#270a0a',
                                                        denyButtonText: 'Cancelar',
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var form = $('#miFormulario<?=$id;?>');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
