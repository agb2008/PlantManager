<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PositionResource;
use App\Http\Requests\StorePositionRequest;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PositionResource::collection(Position::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionRequest $request)
    {
        // Добавлена проверка на соответствие записи id пользователя
        if ($request->user_id == Auth::user()->id) {

            $pos = new Position([
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
            return PositionResource::collection(Position::all()->where('user_id', Auth::user()->id));

        }
        return  response()->json(["message" => "Forbidden"], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        return new PositionResource($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position) : JsonResponse
    {
        // Исходные данные должны быть в формате "Form URL Encoded"

        $position->update($request->all());

        if($position->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position) : JsonResponse
    {
        if($position->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
