<?php

namespace App\Http\Controllers;

use App\Models\AddressOrder;
use App\Http\Requests\StoreAddressOrderRequest;
use App\Http\Requests\UpdateAddressOrderRequest;

class AddressOrderController extends Controller
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
     * @param  \App\Http\Requests\StoreAddressOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddressOrder  $addressOrder
     * @return \Illuminate\Http\Response
     */
    public function show(AddressOrder $addressOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddressOrder  $addressOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(AddressOrder $addressOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAddressOrderRequest  $request
     * @param  \App\Models\AddressOrder  $addressOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressOrderRequest $request, AddressOrder $addressOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddressOrder  $addressOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddressOrder $addressOrder)
    {
        //
    }
}
