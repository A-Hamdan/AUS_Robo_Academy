<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category() {
        return $this->hasOne(Category::class,'id','category_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($model) {
            unlink(public_path($model->image));
            unlink(public_path($model->video));
        });
    }
}
