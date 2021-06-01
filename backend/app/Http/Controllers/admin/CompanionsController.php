<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Companion;
use App\Http\Requests\CompanionsRequest;
use Illuminate\Http\JsonResponse;

class CompanionsController extends Controller
{
    public function index() : JsonResponse
    {
        $companion = Companion::all();
        return response()->json($companion, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function create()
    {
        //
    }

    public function store(CompanionsRequest $request, Companion $companion) : JsonResponse
    {
        $request->validated();
        $companion->fill($request->all())->save();
        return response()->json($companion, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show(Companion $companion) : JsonResponse
    {
        return response()->json($companion, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function edit(Companion $companion) : JsonResponse
    {
        return response()->json($companion, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(CompanionsRequest $request, Companion $companion) : JsonResponse
    {
        $request->validated();
        $companion->fill($request->all())->save();
        return response()->json('Successfully updated');
    }

    public function destroy(Companion $companion) : JsonResponse
    {
        $companion->delete();
        return response()->json('Successfully deleted');
    }
}
