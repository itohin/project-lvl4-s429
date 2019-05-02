<?php

namespace App\Filters;

use App\Status;
use App\Tag;
use App\User;

class TaskFilters extends Filters
{
    protected $filters = ['assigned', 'by', 'status', 'tag'];


    protected function assigned($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return $this->builder->where('assigned_id', $user->id);
    }

    protected function by($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return $this->builder->where('creator_id', $user->id);
    }

    protected function status($id)
    {
        return $this->builder->where('status_id', $id);
    }

    protected function tag($id)
    {
        return $this->builder->whereHas('tags', function ($q) use ($id) {
            $q->where('id', '=', $id);
        });
    }
}
