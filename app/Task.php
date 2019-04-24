<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }
}
