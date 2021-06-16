<?php

namespace App\Http\Controllers;

use App\Models\Seedling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SeedlingResource;
use App\Http\Requests\StoreSeedlingRequest;
use Illuminate\Http\JsonResponse;

class SeedlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return SeedsResource::collection(Seeds::all()->where('user_id',Auth::user()->id));
        return SeedlingResource::collection(Seedling::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeedlingRequest $request)
    {
        $seedling = new Seedling([
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
        $seedling->save();

        return SeedlingResource::collection(Seedling::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seedling  $seedling
     * @return \Illuminate\Http\Response
     */
    public function show(Seedling $seedling)
    {
//        ddd($seedling);
        return new SeedlingResource($seedling);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seedling  $seedling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seedling $seedling)
    {
        $seedling->update($request->all());

        if($seedling->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seedling  $seedling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seedling $seedling) : JsonResponse
    {
        if($seedling->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
