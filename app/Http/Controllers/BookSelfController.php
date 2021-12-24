<?php

namespace App\Http\Controllers;

use App\Models\BookSelf;
use App\Http\Requests\StoreBookSelfRequest;
use App\Http\Requests\UpdateBookSelfRequest;

class BookSelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookSelves = BookSelf::get();
        return view('pages.book-self.index',compact('bookSelves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.book-self.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookSelfRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookSelfRequest $request)
    {
        $data = $request->only('title','location','capacity');

        BookSelf::create($data);
        return  redirect()->back()->with('success','Book Self Create Successful');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookSelf  $bookSelf
     * @return \Illuminate\Http\Response
     */
    public function show(BookSelf $bookSelf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookSelf  $bookSelf
     * @return \Illuminate\Http\Response
     */
    public function edit(BookSelf $bookSelf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookSelfRequest  $request
     * @param  \App\Models\BookSelf  $bookSelf
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookSelfRequest $request, BookSelf $bookSelf)
    {
        $data = $request->only('title','location','capacity');

        $bookSelf->update($data);
        return  redirect()->back()->with('success','Book Self Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookSelf  $bookSelf
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookSelf $bookSelf)
    {
        //
    }
}
