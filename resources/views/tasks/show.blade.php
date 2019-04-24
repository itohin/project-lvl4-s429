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
                <td>X</td>
            </tr>
            <tr>
                <td>Creator</td>
                <td>{{ $task->creator->name }}</td>
            </tr>
            <tr>
                <td>Assigned to</td>
                <td>{{ $task->assignedTo->name }}</td>
            </tr>
            <tr>
                <td>Updated at</td>
                <td>{{ $task->updated_at }}</td>
            </tr>
        </tbody>
    </table>
@endsection