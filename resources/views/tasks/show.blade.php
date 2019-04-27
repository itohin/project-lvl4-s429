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
        <button class="btn float-right btn-link" onclick="deleteTask();">Delete Task</button>

        <form id="deleteTask" action="{{ route('tasks.delete', $task) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        </form>
    @endcan
@endsection

@section('scripts')
    <script>
        const deleteTask = () => {
            event.preventDefault();
            if (confirm('Are you realy want delete it?')) {
                document.getElementById('deleteTask').submit();
            }
        }
    </script>
@endsection