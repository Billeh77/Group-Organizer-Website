<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicGroup extends Model
{

    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function users(){
        return $this->hasMany(\App\Models\Invite::class, 'basic_group_id','id');
    }

    public function grouptasks(){
        return $this->hasMany(\App\Models\GroupTask::class, 'basic_group_id','id');
    }
}
