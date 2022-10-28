<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\media;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->product = new Product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // Auth::logout();
        // $list_product =  Product::orderBy('created_at', 'DESC')->first();
        // dd( $list_product->media->url_media);
        $keyword = "";
        $list_product = Product::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.products.list', compact('list_product', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_category = Category::all();
        $list_brand = Brand::all();
        $data_product = null;
        return view('admin.products.createEditProduct', compact('list_category', 'list_brand', 'data_product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->Validate($request, [
            'name' => 'required|unique:products,name',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
            'thumbnail' => 'required',
        ]);

        /*img thumb*/
        $image_thumb = $request->thumbnail ?  $request->thumbnail : '';
        $folder = 'products';
        if ($image_thumb) {
            $url_thumbnail =  'storage/' . UploadImg($image_thumb, $folder);
        } else {
            $url_thumbnail = null;
        }
        $create = $this->product->addProduct($request, $url_thumbnail);
        if ($create) {
            $create->product_category()->sync($request->category);
            $create->product_brand()->sync($request->brand);
            session()->put('success', 'Product created successfully');
            return redirect()->back();
        } else {
            session()->put('error', 'Add new product failed');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateProductRequest $request)
    {
        $list_category = Category::all();
        $list_brand = Brand::all();
        $data_product = Product::find($request->id);
        return view('admin.products.createEditProduct', compact('list_category', 'list_brand', 'data_product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        
        $this->Validate($request, [
            'name' => 'required|unique:products,name,' . $id,
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
        ]);
        
        $product = Product::findOrFail($id);
        /*img thumb*/
        $image_thumb = $request->thumbnail ?  $request->thumbnail : '';
        $folder = 'products';
        if ($image_thumb) {
            $url_thumbnail =  'storage/' . UploadImg($image_thumb, $folder);
        } else {
            $url_thumbnail = $product->media->url;
        }

        $media_id = null;
        if ($url_thumbnail != null) {
            if ($product->media) {
                $new_media =  media::find($product->media->id);
                $new_media->url = $url_thumbnail;
                $new_media->save();
            } else {
                $new_media = new Media;
                $new_media->user_id = Auth::user()->id;
                $new_media->type = 1;
                $new_media->type_media = "product_img";
                $new_media->url = $url_thumbnail;
                $new_media->save();
                $product->media_id = $new_media->id;
                $product->save();
            }
        }
        $product->name = $request->name;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->price = $request->price;
        $product->save();
        if ($product) {
            $product->product_category()->sync($request->category);
            $product->product_brand()->sync($request->brand);
            session()->put('success', 'Updated successfully');
            return redirect()->back();
        } else {
            session()->put('error', 'Update failed');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr_id = explode(',', $id);
        foreach($arr_id as $id){
            $del = Product::findOrFail($id);
            $media_id = $del -> media_id;
            if($del){
                $del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Delete failed',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete successfully',
        ], 200);
    }
}
