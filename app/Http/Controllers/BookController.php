<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\BookSelf;
use App\Models\BookTitle;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = BookTitle::with('bookSelf')->get();
        return view('pages.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titles = BookTitle::get();
        $languages = Language::get();
        $bookSelves = BookSelf::get();
        $authors = Author::get();
        return view('pages.book.create',compact('titles','languages','bookSelves','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $bookTitle = BookTitle::find($request->title_id);

        $data = $request->only('title_id','price','purchase_at','self_id');
        $data['title'] = $bookTitle->title . ' ' . $request->suffix  ;
        $data['language_id'] = $bookTitle->language_id;
        $data['author_id'] = $bookTitle->author_id;

        $result = $this->addSingleBook($data);
        if($result){
            $bookTitle->increment('part');
            return  redirect()->back()->with('success','Add Book Successful');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(BookTitle $bookTitle)
    {
        $bookTitle->load('book');
        return view('pages.book.book-details',compact('bookTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }


    public function showSetBook()
    {
        $titles = BookTitle::get();
        $languages = Language::get();
        $bookSelves = BookSelf::get();
        $authors = Author::get();
        return view('pages.book.set-book',compact('titles','languages','bookSelves','authors'));
    }

    public function storeSetBook(StoreSetBookRequest $request)
    {
        $bookTitleData = $request->only('title','part','author_id','language_id','self_id');

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = mt_rand(10000,99999) . '-' . time() . '.' . $image->getClientOriginalExtension(); //getting the extension and create name
            $image->storePubliclyAs('public/images', $name);
            $bookTitleData['image'] = asset('storage/images/' . $name) ;
        }

        $bookTitle = BookTitle::create($bookTitleData);
        $newBook = false;
        foreach ($request->book as $book){
            $bookData['title_id'] = $bookTitle->id;
            $bookData['book_view_id'] = $book['book_view_id'];
            $bookData['title'] = $book['title'];
            $bookData['language_id'] = $request->language_id;
            $bookData['self_id'] = $book['self_id'];
            $bookData['part'] = $book['part'];
            $bookData['price'] = 0;
            $bookData['author_id'] = $request->author_id;

            $newBook = $this->addSingleBook($bookData);
        }

        if($newBook){
            return  redirect()->back()->with('success','Add Set Book Successful');
        }

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function addSingleBook(Array $data)
    {
        $author = $data['author_id'];
        unset($data['author_id']);

        $book = Book::create($data);

        return $book->author()->sync($author);
    }
}
