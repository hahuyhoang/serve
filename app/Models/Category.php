<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function media(){
        return $this -> belongsTo('App\Models\Media', 'media_id', 'id');
    }
    public function user(){
        return $this -> belongsTo('App\Models\User', 'user_id', 'id');
    }
}
