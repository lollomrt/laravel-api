@extends('layouts.admin');
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="container bg-light my-3 py-3 d-flex justify-content-between align-items-center">
                    <h2 class="text-uppercase">{{ $project->title }}</h2>
                    <div>
                        <a title="Modifica" class="btn btn-square btn-sm py-2 btn-warning" href="#"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Elimina" class="btn btn-square btn-sm py-2 btn-danger" href="#"><i class="fa-solid fa-trash-can"></i></a>
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