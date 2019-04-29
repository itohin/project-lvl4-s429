<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store()
    {
        $attributes = $this->validateRequest();

        Tag::create($attributes);

        return redirect()->route('tags.index')->withSuccess('Tag was created.');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Tag $tag)
    {
        $attributes = $this->validateRequest();

        $tag->update($attributes);

        return redirect()->route('tags.index')->withSuccess('Tag was updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->withSuccess('Tag was deleted.');
    }

    /**
     * @return mixed
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name']
        ]);
    }
}
