@extends('layouts.app')

@section('content')
    <h1>Tags</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tags as $tag)
            <tr>
                <th scope="row">{{ $tag->id }}</th>
                <td>
                    {{ $tag->name }}
                    <a href="{{ route('tags.destroy', $tag) }}" class="btn btn-outline-danger btn-sm float-right"
                       data-method="delete" data-confirm="Are you sure you want to delete?">
                        Delete
                    </a>
                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-outline-primary btn-sm float-right mr-1">Update</a>
                </td>
            </tr>
        @empty
            <p>No tags yet.</p>
        @endforelse
        </tbody>
    </table>

@endsection
