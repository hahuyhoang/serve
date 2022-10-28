<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;

    public function media(){
        return $this -> belongsTo('App\Models\Media', 'media_id', 'id');
    }
    public function product_category(){
        return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
    }
    public function product_brand(){
        return $this->belongsToMany('App\Models\Brand', 'product_brands', 'product_id', 'brand_id');
    }
    public function addProduct($request, $url_product)
    {
        $media_id = null;
        if ($url_product != null) {
            $new_media = new Media;
            $new_media->user_id = Auth::user()->id;
            $new_media->type = 1;
            $new_media->type_media = "product_img";
            $new_media->url = $url_product;
            $new_media->save();
            $media_id = $new_media->id;
        }
        $this->name = $request->name;
        $this->title = $request->title;
        $this->description = $request->description;
        $this->status = $request->status;
        $this->price = $request->price;
        $this->media_id = $media_id;
        $this->total_rate = 0;
        $this->total_vote = 0;
        $this->save();
        return $this;
    }
}
