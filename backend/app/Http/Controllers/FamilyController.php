<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FamilyResource;
use App\Http\Requests\StoreFamilyRequest;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FamilyResource::collection(Family::all());
        //return FamilyResource::collection(Family::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFamilyRequest $request)
    {
        //Todo - Добавить проверку на авторизацию пользователя и наличия у него статуса is_admin

        $fam = new Family([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        $fam->save();

        return FamilyResource::collection(Family::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        return new FamilyResource($family);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family) : JsonResponse
    {
        // Исходные данные должны быть в формате "Form URL Encoded"

        $family->update($request->all());

        if($family->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)  : JsonResponse
    {
        if($family->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
