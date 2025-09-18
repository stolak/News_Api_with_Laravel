<?php

namespace App\Http\Controllers\API;

use App\Models\Source;
use Illuminate\Http\Request;
use Validator;

class SourceController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/api/sources",
     *     summary="Get list of sources",
     *     tags={"Sources"},
     *     @OA\Response(response=200, description="Successful operation")
     * )
     */
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(Source::All(),[]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Source $source)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Source $source)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Source $source)
    {
        //
    }
}
