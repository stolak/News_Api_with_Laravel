<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Validator;
class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $books= Book::leftJoin('authors', 'authors.id', '=', 'books.author_id')
        ->select('books.*','authors.author')->get();
        return $this->sendResponse($books,[]);
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
            'title' => 'required|unique:books',
            'author_id' => 'required|numeric',
            'description' => 'required',
            'price' => 'required|numeric',
            'publish_date' => 'required|date',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $author = Author::find($request->input('author_id'));
        if(!$author) return $this->sendError('Author is not registered','');

        $book = Book::create($request->all());
        return $this->sendResponse($book,'');

    }

    /**
     * Display the specified resource.
     */
    public function show($book)
    {

        // return $this->sendResponse($book, 'Successful');
        $book = Book::leftJoin('authors', 'authors.id', '=', 'books.author_id')
        ->select('books.*','authors.author')->find($book);
        if($book) return $this->sendResponse($book, 'Successful');
        return $this->sendError('Book not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|unique:books,title,'. $book,
            'author_id' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'publish_date' => 'nullable|date',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        if($request->input('author_id')){
            $author = Author::find($request->input('author_id'));
            if(!$author) return $this->sendError('Author is not registered','');
        }
        $book = Book::find($book);
        if(!$book)  return $this->sendError('Book not found');

        $result = collect(request()->all())->filter(function ($request){
            return is_string($request)&&!empty($request)||is_array($request)&&count($request);
        })->toArray();

        $book->fill($result)->save();
        return $this->sendResponse($book,'');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($book)
    {
        $book = Book::find($book);
        if(!$book)  return $this->sendError('Book not found');
        $book->delete();
        return $this->sendResponse('Record successfully deleted','');
    }
}
