<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];
    public function register_code(){
        return $this -> hasOne('App\Models\RegisterCode', 'user_id', 'id');
    }
    public function media(){
        return $this -> hasOne('App\Models\Media', 'user_id', 'id')->where('type_media','avatar');
    }
    public function role(){
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }
    public function user_role(){
        return $this -> hasOne('App\Models\RoleUser', 'user_id', 'id');
    }
    public function user_meta(){
        return $this->hasMany('App\Models\UserMeta', 'user_id', 'id');
    }

    public static function getAdminMenus()
    {
        return [
            [
                'title' => 'Product',
                'route_name' => 'admin.product.index',
                'icon' => 'settings',
                'route_prefix' => 'admin.product.index',
            ],
        ];
    }

}
