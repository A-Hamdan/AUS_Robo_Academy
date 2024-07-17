<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
// implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'address',
        'country',
        'state',
        'city',
        'gender',
        'avatar',
        'is_active',
        'expiration_date',
        'organisation_name',
        'organisation_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function model() {
        return $this->hasOne(Models::class,'user_id','id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class,'user_categories');
    }

    public function models() {
        return $this->belongsToMany(Models::class,'user_models');
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function ($model) {
            if(!empty($model->avatar)){
                if (file_exists(public_path($model->avatar))) {
                    unlink(public_path($model->avatar));
                }
            }
        });
    }
}
