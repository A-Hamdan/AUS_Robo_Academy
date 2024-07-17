<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function models() {
        return $this->belongsTo(Models::class,'id','models_id');
    }
}
