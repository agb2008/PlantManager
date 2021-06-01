<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SpeciesResource;
use App\Http\Requests\StoreSpeciesRequest;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SpeciesResource::collection(Species::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpeciesRequest $request)
    {
        //Todo - Добавить проверку на авторизацию пользователя и наличия у него статуса is_admin

        $spec = new Species([
            'name'    => $request->name,
            'address' => $request->address,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'website' => $request->website,
            'notes'   => $request->notes,
        ]);
        $spec->save();

        return SpeciesResource::collection(Species::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function show(Species $species)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Species $species)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Species  $species
     * @return \Illuminate\Http\Response
     */
    public function destroy(Species $species)
    {
        //
    }
}
