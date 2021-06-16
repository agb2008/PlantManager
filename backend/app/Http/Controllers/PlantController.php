<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlantResource;
use App\Http\Requests\StorePlantRequest;
use Illuminate\Http\JsonResponse;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlantResource::collection(Plant::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlantRequest $request)
    {
        $plant = new Plant([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'manufacturer_id' => $request->manufacturer_id,
            'amount' => $request->amount,
            'img_id' => $request->img_id,
            'notes' => $request->notes,
            'price' => $request->price,
            'purchase_date' => $request->purchase_date,
            'plant_date' => $request->plant_date,
            'seeds_id' => $request->seeds_id,
            'user_id' => $request->user_id,
        ]);
        $plant->save();

        return PlantResource::collection(Plant::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function show(Plant $plant)
    {
        return new PlantResource($plant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plant $plant)
    {
        $plant->update($request->all());

        if($plant->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plant $plant) : JsonResponse
    {
        if($plant->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
