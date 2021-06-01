<?php

namespace App\Http\Controllers;

use App\Models\PlantType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlantTypeResource;
use App\Http\Requests\StorePlantTypeRequest;

class PlantTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlantTypeResource::collection(PlantType::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlantTypeRequest $request)
    {
        //Todo - Добавить проверку на авторизацию пользователя и наличия у него статуса is_admin

        $planttp = new PlantType([
            'name' => $request->name,
            'family_id' => $request->family_id,
            'species_id' => $request->species_id,
            'notes' => $request->notes,
        ]);
        $planttp->save();

        return PlantTypeResource::collection(PlantType::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function show(PlantType $plantType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlantType $plantType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlantType  $plantType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantType $plantType)
    {
        //
    }
}
