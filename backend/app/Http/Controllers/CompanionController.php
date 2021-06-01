<?php

namespace App\Http\Controllers;

use App\Models\Companion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CompanionResource;
use App\Http\Requests\StoreCompanionRequest;

class CompanionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanionResource::collection(Companion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanionRequest $request)
    {
        //Todo - Добавить проверку на авторизацию пользователя и наличия у него статуса is_admin

        $man = new Companion([
            'species_id' => $request->species_id,
            'companion_id' => $request->companion_id,
            'type' => $request->type,
            'description' => $request->description,
        ]);
        $man->save();

        return CompanionResource::collection(Companion::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companion  $companion
     * @return \Illuminate\Http\Response
     */
    public function show(Companion $companion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companion  $companion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companion $companion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companion  $companion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companion $companion)
    {
        //
    }
}
