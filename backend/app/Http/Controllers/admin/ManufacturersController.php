<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ManufacturersRequest;

class ManufacturersController extends Controller
{
    public function index() : JsonResponse
    {
        $manufacturer = Manufacturer::all();
        return response()->json($manufacturer, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function create()
    {
        //
    }

    public function store(ManufacturersRequest $request, Manufacturer $manufacturer) : JsonResponse
    {
        $request->validated();
        $manufacturer->fill($request->all())->save();
        return response()->json($manufacturer, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show(Manufacturer $manufacturer) : JsonResponse
    {
        return response()->json($manufacturer, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function edit(Manufacturer $manufacturer) : JsonResponse
    {
        return response()->json($manufacturer, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(ManufacturersRequest $request, Manufacturer $manufacturer) : JsonResponse
    {
        $request->validated();
        $manufacturer->fill($request->all())->save();
        return response()->json('Successfully updated');
    }

    public function destroy(Manufacturer $manufacturer) : JsonResponse
    {
        $manufacturer->delete();
        return response()->json('Successfully deleted');
    }
}
