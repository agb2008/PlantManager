<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Http\Requests\FamiliesRequest;
use Illuminate\Http\JsonResponse;

class FamiliesController extends Controller
{
    public function index() : JsonResponse
    {
        $family = Family::all();
        return response()->json($family, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function create()
    {
        //
    }

    public function store(FamiliesRequest $request, Family $family) : JsonResponse
    {
        $request->validated();
        $family->fill($request->all())->save();
        return response()->json($family, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show(Family $family) : JsonResponse
    {
        return response()->json($family, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function edit(Family $family) : JsonResponse
    {
        return response()->json($family, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(FamiliesRequest $request, Family $family) : JsonResponse
    {
        $request->validated();
        $family->fill($request->all())->save();
        return response()->json('Successfully updated');
    }

    public function destroy(Family $family) : JsonResponse
    {
        $family->delete();
        return response()->json('Successfully deleted');
    }
}
