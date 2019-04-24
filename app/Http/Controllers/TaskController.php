<?php

namespace App\Http\Controllers;

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
        $tasks = Task::paginate(15);

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

    public function store()
    {
        $attributes = $this->validateRequest();

        $task = auth()->user()->tasks()->create($attributes);

        return redirect()->route('tasks.show', $task)->withSuccess('Task was created.');
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
        ]);
    }
}
