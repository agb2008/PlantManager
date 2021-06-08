<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ManufacturerResource;
use App\Http\Requests\StoreManufacturerRequest;
use Illuminate\Http\JsonResponse;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $manufacturer = Manufacturer::orderByDesc('id')->all();
        return ManufacturerResource::collection(Manufacturer::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreManufacturerRequest $request)
    {
//        $user = Auth::user();
//        $manufacturer = new Manufacturer(['body' => $request->body]); // TODO - update !!!
//        $user->manufacturer()->save($manufacturer);
//
//        $manufacturers = Manufacturer::orderByDesc('id')->all();
//        return ManufacturerResource::collection($manufacturers);

        //Todo - Добавить проверку на авторизацию пользователя и наличия у него статуса is_admin

          $man = new Manufacturer([
              'name' => $request->name,
              'address' => $request->address,
              'email' => $request->email,
              'phone' => $request->phone,
              'website' => $request->website,
              'notes' => $request->notes,
              ]);
          $man->save();

          return ManufacturerResource::collection(Manufacturer::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        return new ManufacturerResource($manufacturer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)  : JsonResponse
    {
        if($manufacturer->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
