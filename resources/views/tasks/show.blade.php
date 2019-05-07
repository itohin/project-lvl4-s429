@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $task->name }}</li>
        </ol>
    </nav>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>Description</td>
                <td>{{ $task->description }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ $task->status->name }}</td>
            </tr>
            <tr>
                <td>Creator</td>
                <td>{{ $task->creator->name }}</td>
            </tr>
            <tr>
                <td>Assigned to</td>
                <td>{{ $task->assignedTo->name }}</td>
            </tr>
            @if (!$task->tags->isEmpty())
                <tr>
                    <td>Tags</td>
                    <td>
                        <ul>
                            @foreach($task->tags as $tag)
                                <li>{{ $tag->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endif
            <tr>
                <td>Updated at</td>
                <td>{{ $task->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    @can('update', $task)
        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Edit</a>

        <a href="{{ route('tasks.destroy', $task) }}" class="btn float-right btn-link"
           data-method="delete" data-confirm="Are you sure you want to delete?">
            Delete Task
        </a>

    @endcan
@endsection