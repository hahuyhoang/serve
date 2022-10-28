<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_brand = null;
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_list_brand = Brand::where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.brand.getListBrand', compact('data_list_brand','keyword','data_brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $this-> Validate($request,[
            'name' => 'required',
            'image' => 'required',
        ]);
        $image = $request->image ?  $request->image:'';
        $folder = 'brand';
        if($image){
            $url_thumb = 'storage/'.UploadImg($image,$folder);
        }else{
            $url_thumb = null;
        }
        $media_id = null;
        if($url_thumb){
            $new_media = new media();
            $new_media->user_id = Auth::user()->id;
            $new_media->type = 2;
            $new_media->type_media = "brand_img";
            $new_media->url = $url_thumb;
            $new_media->save();
            $media_id = $new_media->id;
        }
        $create =new Brand();
        $create-> user_id = Auth::user()-> id;
        $create-> media_id = $media_id;
        $create-> name = $request->name;
        $create->save();
        if($create){
            session()->put('success','Thêm Thành Công');
            return redirect()->back();
        }else{
            session()->put('error','Thêm Mới Thất Bại');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand, Request $request)
    {
        $data_brand = $brand;
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_list_brand = Brand::where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.brand.getListBrand', compact('data_list_brand','keyword','data_brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this-> Validate($request,[
            'name' => 'required',
        ]);
        $image = $request->image ?  $request->image:'';
        $folder = 'brand';
        if($image){
            $url_thumb = UploadImg($image,$folder);
            $update_media = Media::find( $brand->media_id);
            $update_media->url = 'storage/'.$url_thumb;
            $update_media->save();
        }
        $brand-> name = $request->name;
        $brand->save();

        if($brand){
            session()->put('success','Sửa Thành Công');
            return redirect()->back();
        }else{
            session()->put('error','Sửa Thất Bại');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr_id = explode(',', $id);
        foreach($arr_id as $id){
            $del = Brand::findOrFail($id);
            if($del){
                $del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Mục Vừa Chọn Không Thể Xóa! Vui Lòng Kiểm Tra Lại',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Xóa Thành Công',
        ], 200);
    }
}
