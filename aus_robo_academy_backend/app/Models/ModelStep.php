<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ModelStep extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'position',
        'sort_when_creating' => true,
    ];

    protected $guarded = ['id'];

    public function Category() {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function model() {
        return $this->belongsTo(Models::class,'id','model_id');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($model) {
            unlink(public_path($model->image));
            $model->mtl != null ? unlink(public_path($model->mtl)) : '';
            $model->obj != null ? unlink(public_path($model->obj)) : '';
        });
    }
}
