<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteSetting = SiteSetting::first();

        return view('admin.siteSetting.index', compact('siteSetting'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\SiteSetting $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\SiteSetting $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\SiteSetting $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $siteSetting)
    {

        $request->validate([
            'background_color' => 'required|string|max:255',
            'btn_color' => 'required|string|max:255',
            'live' => 'required|string|max:255',
            'text_title' => 'required|string|max:255',
            'text_play' => 'required|string|max:255',
            'text_replay' => 'required|string|max:255',
            'text_higher' => 'required|string|max:255',
            'text_lower' => 'required|string|max:255',
        ]);
        $siteSetting->update($request->all());

        return redirect()->route('siteSetting.index')
            ->with('message', 'Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\SiteSetting $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $siteSetting)
    {
        //
    }


}
