<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(Task::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed_date' => $request->completed_date,
            'active' => $request->active,
            'user_id' => $request->user_id,
        ]);
        $task->save();

        return TaskResource::collection(Task::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        if($task->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task) : JsonResponse
    {
        if($task->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
