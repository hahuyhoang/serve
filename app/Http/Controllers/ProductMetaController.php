<?php

namespace App\Http\Controllers;

use App\Models\ProductMeta;
use App\Http\Requests\StoreProductMetaRequest;
use App\Http\Requests\UpdateProductMetaRequest;

class ProductMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProductMetaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductMetaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductMeta  $productMeta
     * @return \Illuminate\Http\Response
     */
    public function show(ProductMeta $productMeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductMeta  $productMeta
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductMeta $productMeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductMetaRequest  $request
     * @param  \App\Models\ProductMeta  $productMeta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductMetaRequest $request, ProductMeta $productMeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductMeta  $productMeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductMeta $productMeta)
    {
        //
    }
}
