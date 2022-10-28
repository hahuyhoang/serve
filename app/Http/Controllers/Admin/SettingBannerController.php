<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\SettingBanner;
use App\Http\Requests\StoreSettingBannerRequest;
use App\Http\Requests\UpdateSettingBannerRequest;
use Illuminate\Http\Request;

class SettingBannerController extends Controller
{
    public function getListBannerApp(Request $request)
    {
        $numb_paginate = 10;
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_list_banner = SettingBanner::select('setting_banners.*')
        ->where(function($query) use ($keyword){            
            $query->where('title', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate($numb_paginate);
        return view('admin.setting.getListBannerApp', compact('data_list_banner','keyword'));
    }

   
    public function createBannerApp(Request $request){
        $this-> Validate($request,[
            'image' => 'required',
            'title' => 'required',
        ]);

        $image = $request->image ?  $request->image:'';
        // dd($image);
        $folder = 'banner_website';

        if($image){
            $url_img = UploadImg($image,$folder);
        }else{
            $url_img = null;
        }
        
        $create = new SettingBanner;
        $data = $create->update_banner($url_img,$request->title);
        if($data){
            session()->put('success','Thêm Thành Công Banner');
            return redirect()->back();
        }else{
            session()->put('error','Thêm Mới Thất Bại');
            return redirect()->back();
        }
    }
    public function deleteBannerApp(Request $request){
        $arr_id = explode(',', $request->list_id);
        foreach($arr_id as $id){
            $del = SettingBanner::findOrFail($id);
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
    public function formStyle(Request $request){
        return view('admin.formStyle');
    }
}
