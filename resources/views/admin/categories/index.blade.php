@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="container bg-light my-3 py-3 d-flex justify-content-between align-items-center">
                    <h1 class="text-uppercase">Projects</h1>
                    <a class="btn btn-success" href="{{--{{ route('admin.projects.create') }}--}}"><i class="fa-solid fa-plus me-2"></i>Aggiungi Categoria</a>
                </div>
            </div>
        </div>
        @if(session('message'))
        <div class="row">
            <div class="col">
                <div class="container alert alert-success">
                    {{ session('message') }}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                      <tr class="text-uppercase">
                        <th scope="col">id</th>
                        <th scope="col">title</th>
                        <th scope="col">slug</th>
                        <th scope="col">content</th>
                        <th scope="col">actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <th scope="row">{{ $project->id }}</th>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->slug }}</td>
                                <td>{{ $project->content }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a title="Visualizza" class="btn btn-square btn-sm py-2 btn-primary" href="{{ route('admin.projects.show', $project->slug) }}"><i class="fa-solid fa-eye"></i></a>
                                        <a title="Modifica" class="btn btn-square btn-sm py-2 btn-warning" href="{{ route('admin.projects.edit', $project->slug) }}"><i class="fa-solid fa-pencil"></i></a>
                                        <form action="{{ route('admin.projects.destroy', $project->slug)}}" method="POST" style="
                                            margin-block-end: 0em;" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Elimina" class="btn btn-square btn-sm py-2 btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection