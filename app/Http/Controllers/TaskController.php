<?php

namespace App\Http\Controllers;

use App\Status;
use App\Task;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        $tasks = Task::latest()->paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        $users = User::all();

        return view('tasks.create', compact('users'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $users = User::all();
        $statuses = Status::all();

        return view('tasks.edit', compact('task', 'users', 'statuses'));
    }

    public function store()
    {
        $attributes = $this->validateRequest();

        $task = auth()->user()->tasks()->create($attributes);

        return redirect()->route('tasks.show', $task)->withSuccess('Task was created.');
    }

    public function update(Task $task)
    {
        $attributes = $this->validateRequest();

        $task->update($attributes);

        return redirect()->route('tasks.show', $task)->withSuccess('Task was updated.');
    }

    /**
     * @return mixed
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'assigned_id' => ['required', 'numeric'],
            'status_id' => ['sometimes', 'numeric'],
        ]);
    }
}
