@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    @if(auth()->check())
        <ul class="nav justify-content-center mb-3">
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Filter by:</a>
        </li>
        <li class="nav-item">
            <a href="/tasks?by={{ auth()->user()->slug }}" class="nav-link">My Tasks</a>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Assigned To <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @foreach($assignedUsers as $user)
                    <a href="/tasks?assigned={{ $user->slug }}" class="dropdown-item">{{ $user->name }}</a>
                @endforeach
            </div>
        </li>
    </ul>
    @endif
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Updated at</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <th scope="row">{{ ($tasks->currentpage() - 1) * $tasks->perpage() + $loop->iteration }}</th>
                <td>
                    <a href="{{ route('tasks.show', $task) }}">{{ $task->name }}</a>
                </td>
                <td>{{ $task->status->name }}</td>
                <td>{{ $task->updated_at }}</td>
            </tr>
        @empty
            <p>No tasks yet.</p>
        @endforelse
        </tbody>
    </table>

    {{ $tasks->links() }}
@endsection