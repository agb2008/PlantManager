<?php

namespace App\Http\Controllers;

use App\Models\Semena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SemenaResource;
use App\Http\Requests\StoreSemenaRequest;
use Illuminate\Http\JsonResponse;

class SemenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SemenaResource::collection(Semena::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSemenaRequest $request)
    {
        // Добавлена проверка на соответствие записи id пользователя
        if ($request->user_id == Auth::user()->id) {

            $semena = new Semena([
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
            $semena->save();

            // return SeedsResource::collection(Seeds::all());
            return SemenaResource::collection(Semena::all()->where('user_id', Auth::user()->id));

        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semena  $semena
     * @return \Illuminate\Http\Response
     */
    public function show(Semena $semena)
    {
        return new SemenaResource($semena);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semena  $semena
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semena $semena) : JsonResponse
    {
        $semena->update($request->all());

        if($semena->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semena  $semena
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semena $semena) : JsonResponse
    {
        if($semena->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
