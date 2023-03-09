@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row my-3 align-items-center">
            <div class="col-4">
                <div class="container">
                    <img class="w-100" src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}">
                </div>
            </div>
            <div class="col-8">
                <div class="container h-100 py-3 d-flex flex-column justify-content-between">
                    <h2 class="text-uppercase">{{ $project->title }}</h2>
                    <div>
                        <a title="Modifica" class="btn btn-square btn-sm py-2 btn-warning" href="{{ route('admin.projects.edit', $project->slug) }}"><i class="fa-solid fa-pencil"></i></a>
                        <form action="{{ route('admin.projects.destroy', $project->slug)}}" method="POST" style="
                            margin-block-end: 0em;" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button title="Elimina" class="btn btn-square btn-sm py-2 btn-danger" type="submit"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                        <a class="btn btn-dark" href="{{ route('admin.projects.index') }}"><i class="fa-solid me-2 fa-reply-all"></i>Torna ai progetti</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="container-fluid g-0 d-flex flex-column gap-3">
                    <div class="card">
                        <div class="card-header">
                            <h6>Slug</h6>
                          </div>
                        <div class="card-body">
                            <p>{{$project->slug}}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6>Category</h6>
                          </div>
                        <div class="card-body">
                            <p>{{ $project->category ? $project->category->title : 'Non disponibile' }}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6>Content</h6>
                          </div>
                        <div class="card-body">
                            <p>{{$project->content}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection