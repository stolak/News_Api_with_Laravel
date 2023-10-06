<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Http\Traits\NewsApiTrait;
use App\Http\Traits\NewsApiOrgTrait;
use App\Http\Traits\ArticleTrait;
use App\Http\Traits\GuardianTrait;
use App\Http\Traits\SetupHelperTrait;
use App\Http\Resources\GaurdianAPIResource;
use App\Http\Resources\NewsAPIResource;
use App\Http\Resources\NewsAPIOrgResource;
use App\Models\UsersPreference;

class ArticleController extends BaseController
{
    use ArticleTrait;
    use SetupHelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->update_category_list();
        $this->update_source_list();
        $this->update_author_list();
        // dd("finishedrr");
        return $this->sendResponse('finishedrr',[]);
        $news_apiorg = NewsAPIOrgResource::collection(NewsApiOrgTrait::news());
        $news_guardian = GaurdianAPIResource::collection(GuardianTrait::news());
        $newsapi = NewsAPIResource::collection(NewsApiTrait::news());

        $this->store_article($news_apiorg);
        $this->store_article($news_guardian);
        $this->store_article($newsapi);
        return $this->sendResponse('sucess',[]);
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
     * Display the specified resource.
     */
    public function show_by_user_preference(Request $request)
    {
        $user_id = 4; //Auth::user()->id;
        $user_preference = UsersPreference::find($user_id);
// dd($user_preference);
        $source=$user_preference->source;
        $category=$user_preference->category;
        $author=$user_preference->author;

                $key_word = $request->get('key_word');
                $article = Article:: where('source', $source? '=':'<>', $source)
                ->where('author', $author? '=':'<>', $author)
                ->where('category', $category? '=':'<>', $category)
                ->Where(function($query) use  ($key_word) {
                    $query->where('body', 'like', '%'.$key_word.'%')
                          ->orwhere('body', 'like', '%'.$key_word.'%');
                })
                ->get();

        if($article) return $this->sendResponse($article, 'Successful');
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
