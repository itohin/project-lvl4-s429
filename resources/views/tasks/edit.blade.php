@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Task</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Task Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $task->name }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('name') ?? $task->name }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assigned_id" class="col-md-4 col-form-label text-md-right">Assigned To</label>
                            <div class="col-md-6">
                                <select name="assigned_id" id="assigned_id" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">
                                    <option value=""> -- Select assigned user -- </option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}"{{ (old('assigned_id') == $user->id || $task->assigned_id == $user->id) ? ' selected="selected"' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('assigned_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('assigned_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status_id" class="col-md-4 col-form-label text-md-right">Status</label>
                            <div class="col-md-6">
                                <select name="status_id" id="status_id" class="form-control{{ $errors->has('status_id') ? ' is-invalid' : '' }}">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}"{{ (old('status_id') == $status->id || $task->status_id == $status->id) ? ' selected="selected"' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @if ($errors->has('status_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">Tags</label>
                            <div class="col-md-6">
                                <select id="tagList" name="tags[]" class="form-control" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}"
                                                {{ in_array($tag->id, $task->tag_list) ? ' selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#tagList').select2({
            placeholder: 'Choose a tag'
        });
    </script>
@endsection
