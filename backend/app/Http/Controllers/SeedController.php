<?php

namespace App\Http\Controllers;

use App\Models\Seed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SeedResource;
use App\Http\Requests\StoreSeedRequest;
use Illuminate\Http\JsonResponse;

class SeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SeedResource::collection(Seed::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeedRequest $request)
    {
        // Добавлена проверка на соответствие записи id пользователя
        if ($request->user_id == Auth::user()->id) {

            $seed = new Seed([
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

            // return SeedsResource::collection(Seeds::all());
            return SeedResource::collection(Seed::all()->where('user_id', Auth::user()->id));

        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function show(Seed $seed)
    {
        return new SeedResource($seed);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seed $seed) : JsonResponse
    {
        // Исходные данные должны быть в формате "Form URL Encoded"

        $seed->update($request->all());

        if($seed->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seed  $seed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seed $seed) : JsonResponse
    {
        if($seed->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
