<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SettingBanner;
use App\Http\Requests\StoreSettingBannerRequest;
use App\Http\Requests\UpdateSettingBannerRequest;

class SettingBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $list_banner = SettingBanner::all();
        $response = [
            'list_banner' => $list_banner,
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
     * @param  \App\Http\Requests\StoreSettingBannerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingBannerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingBanner  $settingBanner
     * @return \Illuminate\Http\Response
     */
    public function show(SettingBanner $settingBanner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingBanner  $settingBanner
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingBanner $settingBanner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingBannerRequest  $request
     * @param  \App\Models\SettingBanner  $settingBanner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingBannerRequest $request, SettingBanner $settingBanner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingBanner  $settingBanner
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettingBanner $settingBanner)
    {
        //
    }
}
