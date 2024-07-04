<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Http\Requests\StoreCuisineRequest;
use App\Http\Requests\UpdateCuisineRequest;

class CuisineController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCuisineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cuisine $cuisine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuisine $cuisine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCuisineRequest $request, Cuisine $cuisine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cuisine $cuisine)
    {
        //
    }
}
