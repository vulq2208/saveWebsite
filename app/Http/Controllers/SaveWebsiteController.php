<?php

namespace App\Http\Controllers;


use App\Models\SaveWebsite;
use Illuminate\Http\Request;
use DB;
use Goutte\Client;
use Illuminate\Http\File;
use App\Models\CompanyJobs;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;


class SaveWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaveWebsite  $saveWebsite
     * @return \Illuminate\Http\Response
     */
    public function show(SaveWebsite $saveWebsite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaveWebsite  $saveWebsite
     * @return \Illuminate\Http\Response
     */
    public function edit(SaveWebsite $saveWebsite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaveWebsite  $saveWebsite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaveWebsite $saveWebsite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaveWebsite  $saveWebsite
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaveWebsite $saveWebsite)
    {
        //
    }

    public function getSaveWebsiteController() {

    }
}
