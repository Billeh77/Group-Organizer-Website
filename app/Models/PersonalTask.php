<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalTask extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'deadline', 'user_id', 'urgent', 'inProgress'];

    public function user(){
        return $this->belongsTo();
    }
}
