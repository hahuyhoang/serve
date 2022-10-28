<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_product = Product::with('media','product_category')->orderBy('created_at','desc')->paginate(10);
        $response = [
            'list_product' => $list_product,
        ];
        return response($response, 201);
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        
    }

    public function getProduct(Request $request){
        $id = $request->id;
        $product = Product::with('media','product_category','product_brand')->where('id',$id)->first();
        $response = [
            'data_product' => $product,
        ];
        return response($response, 201);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function filterSearch(Request $request)
    {
        $list_product = Product::with('media','product_category','product_brand')
        ->whereHas('product_category', function($query) use($request){
            if(isset($request->category) && $request->category != ""){
                return $query->where('name', 'LIKE','%'.$request->category.'%');
            }
        })
        ->whereHas('product_brand', function($query) use($request){
            if(isset($request->brand) && $request->brand != ""){
                return $query->where('name', 'LIKE','%'.$request->brand.'%');
            }
        })
        ->where(function($query) use ($request){
            if(isset($request->textSearch) && $request->textSearch != ""){
                $query->where('name', 'LIKE', '%'.$request->textSearch.'%');
            }
                    
            
        })
        ->orderBy('created_at','desc')->paginate(10);
        $response = [
            'list_product'=> $list_product,
        ];
        return response($response, 201);
    }
}
