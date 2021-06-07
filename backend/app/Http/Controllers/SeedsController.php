<?php

namespace App\Http\Controllers;

use App\Models\Seeds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SeedsResource;
use App\Http\Requests\StoreSeedsRequest;
use Illuminate\Http\JsonResponse;

class SeedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SeedsResource::collection(Seeds::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeedsRequest $request)
    {
        $seed = new Seeds([
            'name' => $request->name,
            'number_of_seeds' => $request->number_of_seeds,
            'amount' => $request->amount,
            'type_id' => $request->type_id,
            'manufacturer_id' => $request->manufacturer_id,
            'production_date' => $request->production_date,
            'expiration_date' => $request->expiration_date,
            'harvest_date' => $request->harvest_date,
            'notes' => $request->notes,
            'price' => $request->price,
            'img_id' => $request->img_id,
            'user_id' => $request->user_id,
        ]);
        $seed->save();

        return SeedsResource::collection(Seeds::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seeds  $seeds
     * @return \Illuminate\Http\Response
     */
    public function show(Seeds $seeds)
    {
        return new SeedsResource($seeds);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seeds  $seeds
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seeds $seeds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seeds  $seeds
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seeds $seeds) : JsonResponse
    {
        if($seeds->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
