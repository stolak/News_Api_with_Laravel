<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use Illuminate\Http\Request;
use Validator;
class AuthorController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://eventregistry.org/api/v1/article/getArticles',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_POSTFIELDS =>'{
          "action": "getArticles",
          "keyword": "Barack Obama",
          "articlesPage": 1,
          "articlesCount": 2,
          "articlesSortBy": "date",
          "articlesSortByAsc": false,
          "articlesArticleBodyLen": -1,
          "resultType": "articles",
          "dataType": [
            "news",
            "pr"
          ],
          "apiKey": "30490716-4ddb-4008-ba4e-1abb5bc04df4",
          "forceMaxDataTimeWindow": 31
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        dd($response);
        return $this->sendResponse(Author::All(),[]);
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
