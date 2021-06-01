<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Seed;
use App\Http\Requests\SeedsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SeedsController extends Controller
{
    public function index() : JsonResponse
    {
        $seed = Seed::all();
        return response()->json($seed, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function create(Request $request)
    {
        //
    }

    public function store(SeedsRequest $request, Seed $seed) : JsonResponse
    {
        $request->validated();
        $seed->fill($request->all())->save();
        return response()->json($seed, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function show(Seed $seed) : JsonResponse
    {
        return response()->json($seed, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function edit(Seed $seed) : JsonResponse
    {
        return response()->json($seed, 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request, Seed $seed) : JsonResponse
    {
        $request->validate([
            'name' => ['required', 'max:50'],
        ]);
        $seed->update($request->only(['name']));
        return response()->json('Successfully updated');
    }

    public function destroy(Seed $seed) : JsonResponse
    {
        $seed->delete();
        return response()->json('Successfully deleted');
    }
}
