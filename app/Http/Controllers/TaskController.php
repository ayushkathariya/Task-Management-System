<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $tasks = Task::where('user_id', $user->id)->orderBy("created_at", "desc")->paginate(6);

        return view('home', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'is_completed' => 'boolean',
            'deadline' => 'required|date|after_or_equal:now',
        ]);

        $title = $request->title;
        $body = $request->body;
        $deadline = $request->deadline;

        $task = new Task();
        $task->title = $title;
        $task->body = $body;
        $task->deadline = $deadline;
        $task->user_id = Auth::id();
        $task->save();

        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        return view('tasks-edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'is_completed' => 'boolean',
            'deadline' => 'required|date|after_or_equal:now',
        ]);

        $title = $request->title;
        $body = $request->body;
        $deadline = $request->deadline;
        $is_completed = $request->has('is_completed') ? 1 : 0;

        $task->title = $title;
        $task->body = $body;
        $task->deadline = $deadline;
        $task->is_completed = $is_completed;
        $task->save();

        return redirect(route('home'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect(route('home'));
    }
}
