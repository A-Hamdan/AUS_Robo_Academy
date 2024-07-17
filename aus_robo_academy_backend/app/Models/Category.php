<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function model() {
        return $this->hasMany(Models::class,'category_id','id');
    }

    public function video() {
        return $this->hasMany(Video::class,'category_id','id');
    }

    public function users() {
        return $this->belongsToMany(User::class,'user_categories');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($model) {
            unlink(public_path($model->image));
        });
    }
}
