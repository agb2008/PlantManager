<?php

namespace App\Http\Controllers;

use App\Models\Positions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PositionsResource;
use App\Http\Requests\StorePositionsRequest;
use Illuminate\Http\JsonResponse;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PositionsResource::collection(Positions::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionsRequest $request)
    {
        // Добавлена проверка на соответствие записи id пользователя
        if ($request->user_id == Auth::user()->id) {

            $pos = new Positions([
                'posX' => $request->posX,
                'posY' => $request->posY,
                'plant_id' => $request->plant_id,
                'img_id' => $request->img_id,
                'user_id' => $request->user_id,
                'notes' => $request->notes,
                'date' => $request->date,
            ]);
            $pos->save();

            // return SeedsResource::collection(Seeds::all());
            return PositionsResource::collection(Positions::all()->where('user_id', Auth::user()->id));

        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function show(Positions $positions)
    {
        return new PositionsResource($positions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Positions $positions) : JsonResponse
    {
        // Исходные данные должны быть в формате "Form URL Encoded"

        $positions->update($request->all());

        if($positions->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Positions $positions) : JsonResponse
    {
        if($positions->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
