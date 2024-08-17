@extends('layouts.layout')

@section('content')
    <section class="container mt-3">
        <div class="bg-secondary px-4 py-1 rounded">
            <nav class="mt-1" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page" class="text-dark">Tasks</li>
                    <li class="breadcrumb-item active" aria-current="page" class="text-dark">Edit</li>
                </ol>
            </nav>
        </div>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="border py-5 px-3 rounded mt-3">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" value="{{ $task->title }}" class="form-control" id="title"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea rows="4" name="body" class="form-control" id="body">
                    {{ $task->body }}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input name="deadline" value="{{ $task->deadline }}" type="datetime-local" name="body"
                    class="form-control" id="deadline">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="is_completed" class="form-check-input" id="is_completed"
                    {{ $task->is_completed ? 'checked' : '' }}>
                <label class="form-check-label" for="is_completed">Completed</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </section>
@endsection
