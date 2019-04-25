<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $statuses = Status::all();

        return view('statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('statuses.create');
    }

    public function store()
    {
        $attributes = $this->validateRequest();

        Status::create($attributes);

        return redirect()->route('status.index')->withSuccess('Status was created.');
    }

    public function edit(Status $status)
    {
        return view('statuses.edit', compact('status'));
    }

    public function update(Status $status)
    {
        $attributes = $this->validateRequest();

        $status->update($attributes);

        return redirect()->route('status.index')->withSuccess('Status was updated.');
    }

    /**
     * @return mixed
     */
    public function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
    }
}
