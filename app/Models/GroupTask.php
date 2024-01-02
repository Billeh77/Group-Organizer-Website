<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTask extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'deadline', 'basic_group_id', 'urgent', 'inProgress', 'userName'];

}
