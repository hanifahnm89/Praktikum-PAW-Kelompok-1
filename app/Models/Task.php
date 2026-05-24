<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'task_name', 'course', 'due_date', 'time', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
