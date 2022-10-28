<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_cate = null;
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_list_category = Category::where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.category.getListCategory', compact('data_list_category','keyword','data_cate'));
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
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $this-> Validate($request,[
            'name' => 'required',
            'image' => 'required',
        ]);
        $image = $request->image ?  $request->image:'';
        $folder = 'category';
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
            $new_media->type_media = "category_img";
            $new_media->url = $url_thumb;
            $new_media->save();
            $media_id = $new_media->id;
        }
        $create =new Category();
        $create-> user_id = Auth::user()-> id;
        $create-> media_id = $media_id;
        $create-> name = $request->name;
        $create-> background = $request->background;
        $create-> border_color = $request->border_color;
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category,Request $request)
    {
        $data_cate = $category;
        $keyword = $request -> keyword ? $request -> keyword : '';
        $data_list_category = Category::where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('admin.category.getListCategory', compact('data_list_category','keyword','data_cate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $this-> Validate($request,[
            'name' => 'required',
        ]);
        $image = $request->image ?  $request->image:'';
        $folder = 'category';
        if($image){
            $url_thumb = UploadImg($image,$folder);
            $update_media = Media::find( $category->media_id);
            $update_media->url = 'storage/'.$url_thumb;
            $update_media->save();
        }
        $category-> name = $request->name;
        $category-> background = $request->background;
        $category-> border_color = $request->border_color;
        $category->save();

        if($category){
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr_id = explode(',', $id);
        foreach($arr_id as $id){
            $del = Category::findOrFail($id);
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
