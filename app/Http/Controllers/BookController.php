<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSetBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\BookSelf;
use App\Models\BookTitle;
use App\Models\Jamaat;
use App\Models\Language;
use App\Models\Member;
use Carbon\Carbon;
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
        $books = Book::with('bookSelf')->where('book_status',1)->get();
        $members = Member::where('status',1)->get();
        $languages = Language::get();
        $bookSelves = BookSelf::get();
        $authors = Author::get();
        $jamaats = Jamaat::get();
        return view('pages.book.index',compact('books','members','languages','bookSelves','authors','jamaats'));
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
    public function show(Book $book)
    {
        $book->load(['author','bookSelf','jamaat','language','returnByMember','member'=>function($q){
            return $q->withPivot('borrow_at','return_at')->orderBy('borrow_at','DESC')->latest()->limit(10);
        }]);
        return view('pages.book.book-details',compact('book'));
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
        $lastBookId = Book::latest()->first()->book_no ;
        $jamaatList = Jamaat::get();
        return view('pages.book.set-book',compact('titles','languages','bookSelves','authors','lastBookId','jamaatList'));
    }

    public function storeSetBook(StoreSetBookRequest $request)
    {
//        dd($request->all());
        $bookTitleData = $request->only('title','author_id','language_id','self_id','volume');

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = mt_rand(10000,99999) . '-' . time() . '.' . $image->getClientOriginalExtension(); //getting the extension and create name
            $image->storePubliclyAs('public/images', $name);
            $bookTitleData['image'] = asset('storage/images/' . $name) ;
        }

//        dd($bookTitleData);
        $bookTitle = BookTitle::create($bookTitleData);
        $newBook = false;
        foreach ($request->book as $book){
            $bookData['title'] = $book['title'];
            $bookData['book_no'] = $book['book_no'];
            $bookData['language_id'] = $bookTitle->language_id;
            $bookData['jamaat_id'] = $request->jamaat_id;
            $bookData['title_id'] = $bookTitle->id;
            $bookData['image'] = $bookTitle->image;
            $bookData['self_id'] = $book['self_id'];
            $bookData['taak'] = $book['taak'];
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

    public function assignBorrowedBook(Request $request)
    {
        $book = Book::find($request->book_id);
        $book->update(['borrow_status'=>1]);
        $book->member()->attach($request->member_id,['borrow_at'=>now()]);
        return redirect()->back()->with('success','Book Assigned successful');
    }

    public function returnedBorrowedBook(Request $request, Book $book)
    {
        $bookBorrowers = $book->returnByMember->pluck('id')->toArray();
        $book->update(['borrow_status'=>0]);
        $book->returnByMember()->syncWithPivotValues($bookBorrowers,['return_at'=>now()]);

        return redirect()->back()->with('success','Book Return successful');
    }

    public function lostBookIndex()
    {
        $lostBooks = Book::where('book_status',0)->get();
        return view('pages.book.lost-book-list',compact('lostBooks'));
    }

    public function lostBookStore(Book $book)
    {
        $book->update(['book_status'=>0,'lost_at'=>now()]);
        return redirect()->route('book.index')->with('success','The Book Add to lost list successful');
    }

    public function lostBookRetrieve(Book $book)
    {
        $book->update(['book_status'=>1,'lost_at'=>null]);
        return redirect()->route('book.index')->with('success','The Lost Book retrieve successful');

    }
}
