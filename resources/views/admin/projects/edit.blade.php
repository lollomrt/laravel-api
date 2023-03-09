@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row my-3 align-items-center">
            <div class="col-4">
                <div class="container">
                    <img class="w-100" src="{{ asset('storage/'.$project->cover_image) }}" alt="{{ $project->title }}">
                </div>
            </div>
            <div class="col-8">
                <div class="container flex-column py-3 d-flex justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        
                        <h1 class="text-uppercase"><i class="fa-solid fa-pencil"></i>Modifica progetto</h1>
                    </div>
                    <a class="btn btn-dark w-25" href="{{ route('admin.projects.index') }}"><i class="fa-solid me-2 fa-reply-all"></i>Torna ai progetti</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="container-fluid p-0">    
                    @if($errors->any())
                    <div class="alert alert-danger w-100">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif                                 
                </div>
                <form action="{{ route('admin.projects.update', $project->slug)}}" enctype="multipart/form-data" method="POST" class="w-100 d-flex gap-3 flex-wrap">
                    @csrf
                    @method('PUT')
                    <div class="form-group w-75">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') ?? $project->title}}" placeholder="Inserisci il nome del progetto ...">
                        @error('title')
                            <div class="text-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group w-100">
                        <label for="">Immagine di copertina</label>
                        <input type="file" id="cover_image" name="cover_image" class="form-control @error('cover_image')is-invalid @enderror" placeholder="Inserisci il nome del progetto ...">
                        @error('cover_image')
                            <div class="text-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex flex-column flex-grow">
                        <label for="">Categories</label>
                        <select class="form-select w-100" name="category_id" id="category_id">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{ $category->id == old ('category_id', $project->category_id) ?? 'selected'}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-column w-100">
                        <label for="">Technologies</label>
                        <div class="d-flex flex-column">
                        @foreach($technologies as $technology)
                        <div>
                            <input id="{{ $technology->name }}" type="checkbox" value="{{ $technology->id }}" name="technologies[]" {{in_array($technology->id, old('technologies', [])) ? 'checked' : ''}}>
                            <label for="label">{{ $technology->name }}</label>
                        </div>                            
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group w-100">
                        <label for="">Descrizione</label>
                        <textarea name="content" id="" cols="30" rows="4" class="form-control" placeholder="Inserisci descrizione ...">{{ old('content') ?? $project->content}}</textarea>
                    </div>
                    <button class="btn btn-success w-25" type="submit"><i class="fa-solid fa-pencil me-2"></i>Modifica Progetto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection