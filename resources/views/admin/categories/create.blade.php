@extends('layouts.admin');
@section('content')
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="container bg-light my-3 py-3 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-pencil h1"></i>
                        <h1 class="text-uppercase">Crea nuovo progetto</h1>
                    </div>
                    <a class="btn btn-dark" href="{{ route('admin.projects.index') }}"><i class="fa-solid me-2 fa-reply-all"></i>Torna ai progetti</a>
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
                <form action="{{ route('admin.projects.store')}}" method="POST" class="w-100 d-flex gap-3 flex-wrap">
                    @csrf
                    <div class="form-group w-100">
                        <label for="">Titolo</label>
                        <input type="text" name="title" class="form-control" placeholder="Inserisci il nome del progetto ...">
                        @error('title')
                            <div class="text-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group w-100">
                        <label for="">Descrizione</label>
                        <textarea name="content" id="" cols="30" rows="4" class="form-control" placeholder="Inserisci descrizione ..."></textarea>
                    </div>
                    <button class="btn btn-success w-25" type="submit">Crea Progetto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection