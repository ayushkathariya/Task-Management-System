@extends('layouts.layout')

@section('content')
    <section class="container mt-3">

        <div class="bg-secondary px-4 py-1 rounded">
            <nav class="mt-1" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" class="text-dark">Tasks</li>
                    <li class="breadcrumb-item active" aria-current="page" class="text-dark">Create</li>
                </ol>
            </nav>
        </div>

        <form action="{{ route('tasks.store') }}" method="POST" class="border py-5 px-3 rounded mt-4">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                @error('title')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea rows="4" name="body" class="form-control" id="body">
                </textarea>
                @error('body')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input name="deadline" type="datetime-local" name="body" class="form-control" id="deadline">
                @error('deadline')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </section>
@endsection
