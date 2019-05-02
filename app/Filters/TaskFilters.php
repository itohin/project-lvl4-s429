<?php

namespace App\Filters;

use App\User;

class TaskFilters extends Filters
{
    protected $filters = ['assigned', 'by'];


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
}
