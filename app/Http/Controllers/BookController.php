<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\Book\BookRequest;

class BookController extends Controller
{
    public function home()
    {
        $books=Book::get();
        return view('index',compact('books'));
    }
     public function index()
    {   $authors=Author::get();
        $books=Book::with('author','category')->get();
        return view('books.index',compact('books','authors'));
    }


    public function store(BookRequest $request)
    {
        $book = new Book($request->all());
		$book->save();
		// $user->assignRole($request->role);
		// if (!$request->ajax()) return back()->with('success', 'User created');
		return response()->json([], 201);
    }

    public function show(Book $book)
    {
        return response()->json(['book'->$book], 200);
    }

    // public function edit($id)
    // {

    // }


    public function update(BookRequest  $request, Book $book)
    {
         $book->update($request->all());
        return response()->json([], 204);
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([], 204);
    }
}
