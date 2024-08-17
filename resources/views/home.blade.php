@extends('layouts.layout')


@section('content')
    {{-- Task Section --}}

    <section class="container mt-3">
        <h2>Tasks</h2>
        <div class="row g-2">

            @if ($tasks)
                @foreach ($tasks as $task)
                    <div class="col-12 col-lg-6">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h2>{{ $task->title }}</h2>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-6 col-lg-7 col-xl-8">
                                        <p>{{ $task->body }}</p>
                                    </div>
                                    <div class="col-6 col-lg-5 col-xl-4">
                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning mx-1">Edit</a>
                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modal">Delete</a>
                                        <div class="modal" id="modal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header text-danger">
                                                        Warning
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            Do you want to delete this task ?
                                                        </div>
                                                        <div class="d-block mt-1 d-flex justify-content-end gap-1">
                                                            <button class="btn btn-primary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <form action="{{ route('tasks.destroy', $task->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Ok</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </section>

    <div class="container mt-4 d-flex justify-content-center w-auto">
        {{ $tasks->links() }}
    </div>
@endsection
