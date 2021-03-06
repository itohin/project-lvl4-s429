<?php

namespace App\Http\Controllers;

use App\Filters\TaskFilters;
use App\Status;
use App\Tag;
use App\Task;
use App\User;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(TaskFilters $filters)
    {
        $tasks = Task::latest()->filter($filters)->paginate(15);

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        $users = User::all();
        $tags = Tag::all();

        return view('tasks.create', compact('users', 'tags'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $users = User::all();
        $statuses = Status::all();
        $tags = Tag::all();

        return view('tasks.edit', compact('task', 'users', 'statuses', 'tags'));
    }

    public function store()
    {
        $attributes = $this->validateRequest();

        $task = auth()->user()->tasks()->create($attributes);

        $task->tags()->sync(request('tags'));

        return redirect()->route('tasks.show', $task)->withSuccess(__('Task was created.'));
    }

    public function update(Task $task)
    {
        $attributes = $this->validateRequest();

        $task->update($attributes);

        $task->tags()->sync(request('tags'));

        return redirect()->route('tasks.show', $task)->withSuccess(__('Task was updated.'));
    }

    public function destroy(Task $task)
    {
        $this->authorize('update', $task);

        $task->delete();

        return redirect()->route('tasks.index', $task)->withSuccess(__('Task was deleted.'));
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
