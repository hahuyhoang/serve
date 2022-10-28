<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SettingBanner extends Model
{
    use HasFactory,SoftDeletes;

    public function update_banner($url_img,$title){
    	$this -> url_img = 'storage/'.$url_img;
    	$this -> title = $title;
    	$this -> save();
    	return $this;
    }
    public function url_img(){
     	return asset('').$this->url_img;
     }
}
