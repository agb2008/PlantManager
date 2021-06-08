<?php

namespace App\Http\Controllers;

use App\Models\Plants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlantsResource;
use App\Http\Requests\StorePlantsRequest;
use Illuminate\Http\JsonResponse;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlantsResource::collection(Plants::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlantsRequest $request)
    {
        $plant = new Plants([
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

        return PlantsResource::collection(Plants::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function show(Plants $plants)
    {
        return new PlantsResource($plants);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plants $plants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plants $plants)  : JsonResponse
    {
        if($plants->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
