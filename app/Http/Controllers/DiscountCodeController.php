<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Http\Requests\StoreDiscountCodeRequest;
use App\Http\Requests\UpdateDiscountCodeRequest;

class DiscountCodeController extends Controller
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
     * @param  \App\Http\Requests\StoreDiscountCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountCode $discountCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountCode $discountCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscountCodeRequest  $request
     * @param  \App\Models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscountCodeRequest $request, DiscountCode $discountCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiscountCode  $discountCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountCode $discountCode)
    {
        //
    }
}
