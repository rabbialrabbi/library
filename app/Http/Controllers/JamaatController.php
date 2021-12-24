<?php

namespace App\Http\Controllers;

use App\Models\Jamaat;
use App\Http\Requests\StoreJamaatRequest;
use App\Http\Requests\UpdateJamaatRequest;

class JamaatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jamaats = Jamaat::all();
        return view('pages.jamaat.index',compact('jamaats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jamaat = Jamaat::all();
        return view('pages.jamaat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJamaatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJamaatRequest $request)
    {
        Jamaat::create(['name'=>$request->name]);

        return redirect()->back()->with('success','Create New jamaat sussesful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jamaat  $jamaat
     * @return \Illuminate\Http\Response
     */
    public function show(Jamaat $jamaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jamaat  $jamaat
     * @return \Illuminate\Http\Response
     */
    public function edit(Jamaat $jamaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJamaatRequest  $request
     * @param  \App\Models\Jamaat  $jamaat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJamaatRequest $request, Jamaat $jamaat)
    {
        $data = $request->only('name');
        $jamaat->update($data);
        return  redirect()->back()->with('success','Jamaat Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jamaat  $jamaat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jamaat $jamaat)
    {
        //
    }
}
