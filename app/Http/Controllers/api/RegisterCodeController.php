<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use App\Models\RegisterCode;
use App\Http\Requests\StoreRegisterCodeRequest;
use App\Http\Requests\UpdateRegisterCodeRequest;

class RegisterCodeController extends Controller
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
     * @param  \App\Http\Requests\StoreRegisterCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegisterCodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegisterCode  $registerCode
     * @return \Illuminate\Http\Response
     */
    public function show(RegisterCode $registerCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegisterCode  $registerCode
     * @return \Illuminate\Http\Response
     */
    public function edit(RegisterCode $registerCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegisterCodeRequest  $request
     * @param  \App\Models\RegisterCode  $registerCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegisterCodeRequest $request, RegisterCode $registerCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegisterCode  $registerCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegisterCode $registerCode)
    {
        //
    }
}
