@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    @if(auth()->check())
       @include('layouts.partials._filters')
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