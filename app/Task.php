<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'creator_id', 'assigned_id', 'status_id'];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
