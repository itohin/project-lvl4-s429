@extends('layouts.app')

@section('content')
    <h1>Statuses</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        @forelse($statuses as $status)
            <tr>
                <th scope="row">{{ $status->id }}</th>
                <td>
                    {{ $status->name }}
                    <a href="" class="btn btn-outline-danger btn-sm float-right">Delete</a>
                    <a href="{{ route('status.edit', $status) }}" class="btn btn-outline-primary btn-sm float-right mr-1">Update</a>
                </td>
            </tr>
        @empty
            <p>No statuses yet.</p>
        @endforelse
        </tbody>
    </table>

@endsection