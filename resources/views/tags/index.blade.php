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
                    <button class="btn btn-outline-danger btn-sm float-right" onclick="deleteTag();">Delete</button>
                    <a href="{{ route('tags.edit', $tag) }}" class="btn btn-outline-primary btn-sm float-right mr-1">Update</a>
                </td>
            </tr>
        @empty
            <p>No tags yet.</p>
        @endforelse
        </tbody>
    </table>
    <form id="deleteTag" action="{{ route('tags.delete', $tag) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>

@endsection

@section('scripts')
    <script>
        const deleteTag = () => {
            if (confirm('Do you realy want delete this?')) {
                document.getElementById('deleteTag').submit();
            }
        }
    </script>
@endsection