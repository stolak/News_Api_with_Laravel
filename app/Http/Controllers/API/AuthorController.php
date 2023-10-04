<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;
use App\Http\Traits\NewsApiTrait;
use App\Http\Resources\NewsApi;

class AuthorController extends BaseController
{
    use NewsApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $news = NewsApiTrait::news();

        // return $this->sendResponse($news['articles']['results'],[]);
        // return $this->sendResponse($news,[]);
        // return $this->sendResponse(new NewsApi($news['articles']['results']),[]);
        return $this->sendResponse(NewsApi::collection($news['articles']['results']),[]);
        // UserResource::collection
        // return $this->sendResponse(Author::All(),[]);
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
            'author' => 'required|unique:authors',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $author = Author::create($request->all());
        return $this->sendResponse($author,'');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        // return $this->sendResponse($book, 'Successful');


        $author = Author::find($id);
        if($author) return $this->sendResponse($author, 'Successful');
        return $this->sendError('Author not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
}
