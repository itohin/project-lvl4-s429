@extends('layouts.app')

@section('content')
    <h1>Tasks</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Created at</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <th scope="row">{{ ($tasks->currentpage() - 1) * $tasks->perpage() + $loop->iteration }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>X</td>
                <td>{{ $task->created_at }}</td>
            </tr>
        @empty
            <p>No tasks yet.</p>
        @endforelse
        </tbody>
    </table>

    {{ $tasks->links() }}
@endsection