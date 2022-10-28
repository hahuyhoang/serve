<?php

namespace App\Http\Controllers;

use App\Models\UserMeta;
use App\Http\Requests\StoreUserMetaRequest;
use App\Http\Requests\UpdateUserMetaRequest;

class UserMetaController extends Controller
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
     * @param  \App\Http\Requests\StoreUserMetaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserMetaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMeta  $userMeta
     * @return \Illuminate\Http\Response
     */
    public function show(UserMeta $userMeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMeta  $userMeta
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMeta $userMeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserMetaRequest  $request
     * @param  \App\Models\UserMeta  $userMeta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserMetaRequest $request, UserMeta $userMeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMeta  $userMeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMeta $userMeta)
    {
        //
    }
}
