<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    //

    function home(){
        // $author = Book::with('author','book')->get();

        //relationship query builder

        // $author = Author::with('books')->get();
        // $author = Book::with('author')->get();

        // $author = Author::where('name','Hasib')->with('books')->get();
        $author = Author::with('books')->get();
        // $author = Author::with('books')->count();
       

        // join author with book

        // $author = DB::table('authors')
        // // ->join('authors','book.id', 'authors.book_id')
        // // ->get();


        //  ->join('books', 'books.id', '=', 'authors.book_id')
        //     ->select('books.*')->distinct('authors.name')
        //     ->where('authors.name', 'emon')
        //     ->get();




        //join

        // $author = Author::join('books','authors.id','books.author_id')->get();

        //join in author and book


        return $author;
        //relationship with books
        
    }
}
