@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-center" >TODO LIST</h2>
        </div>
        <div>
            <a href="{{route('tasks.create')}}" class=" btn btn-primary">Crear tarea</a>
        </div>
    </div>
    {{-- Si viene cualquier error muestra este codigo --}}
    @if (Session::get('success'))
        <div class="alert alert-success mt-3">
            <strong>{{Session::get('success')}}</strong><br>
        </div>
    @endif
    <div class="col-12 mt-4">
        <table class="table table-bordered ">
            <tr class="text-secondary">
                <th>Tarea</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
            @foreach($tasks as $task)    
                <tr>
                    <td class="fw-bold">{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        {{$task->due_date}}
                    </td>

                    <td>
                        @if ($task->status == "Pendiente")
                        <span class="badge bg-danger fs-6">{{$task->status}}</span>
                        @elseif($task->status == "En progreso")
                        <span class="badge bg-primary fs-6">{{$task->status}}</span>
                        @elseif($task->status == "Completado")
                        <span class="badge bg-success fs-6">{{$task->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href={{route('tasks.edit', $task)}} class="btn btn-success">Editar</a>
                        <form action={{route('tasks.destroy', $task)}} method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$tasks->links()}}
    </div>
</div>
@endsection