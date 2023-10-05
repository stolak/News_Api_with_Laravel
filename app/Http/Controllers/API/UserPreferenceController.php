<?php

namespace App\Http\Controllers\API;

use App\Models\UsersPreference;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserPreferenceController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sendResponse(UsersPreference::All(),[]);
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $preference = UsersPreference::updateOrCreate([
            'user_id' => $request->get('user_id'), // Auth::user()->id,
            ],$request->all());

        return $this->sendResponse($preference,'');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        // return $this->sendResponse($book, 'Successful');


        $preference = UsersPreference::find($id);
        if($preference) return $this->sendResponse($preference, 'Successful');
        return $this->sendError('preference not found');
    }

     /**
     * Display the specified resource.
     */
    public function show_user_id()
    {
        $preference = UsersPreference::find(Auth::user()->id);
        if($preference) return $this->sendResponse($preference, 'Successful');
        return $this->sendError('Preference not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsersPreference $preference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UsersPreference $preference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsersPreference $preference)
    {
        //
    }
}
