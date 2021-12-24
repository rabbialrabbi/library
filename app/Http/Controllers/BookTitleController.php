<?php

namespace App\Http\Controllers;

use App\Models\BookTitle;
use App\Http\Requests\StoreBookTitleRequest;
use App\Http\Requests\UpdateBookTitleRequest;

class BookTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookTitleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookTitleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookTitle  $bookTitle
     * @return \Illuminate\Http\Response
     */
    public function show(BookTitle $bookTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BookTitle  $bookTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(BookTitle $bookTitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookTitleRequest  $request
     * @param  \App\Models\BookTitle  $bookTitle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookTitleRequest $request, BookTitle $bookTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookTitle  $bookTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookTitle $bookTitle)
    {
        //
    }
}
