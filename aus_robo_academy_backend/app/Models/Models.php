<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function modelSteps() {
        return $this->hasMany(ModelStep::class,'model_id','id');
    }

    public function category() {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function user() {
        return $this->hasOne(user::class,'id','user_id');
    }

    public function users() {
        return $this->belongsToMany(User::class,'user_models');
    }

    public function userModels() {
        return $this->hasMany(UserModel::class,'models_id','id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($model) {
            unlink(public_path($model->image));
        });
    }
}
