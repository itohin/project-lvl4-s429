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
                    <a href="{{ route('status.destroy', $status) }}" class="btn btn-outline-danger btn-sm float-right"
                       data-method="delete" data-confirm="Are you sure you want to delete?">
                        Delete
                    </a>
                    <a href="{{ route('status.edit', $status) }}" class="btn btn-outline-primary btn-sm float-right mr-1">Update</a>
                </td>
            </tr>
        @empty
            <p>No statuses yet.</p>
        @endforelse
        </tbody>
    </table>

@endsection