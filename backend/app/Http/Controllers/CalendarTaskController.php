<?php

namespace App\Http\Controllers;

use App\Models\CalendarTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CalendarTaskResource;
use App\Http\Requests\StoreCalendarTaskRequest;
use Illuminate\Http\JsonResponse;

class CalendarTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CalendarTaskResource::collection(CalendarTask::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarTaskRequest $request)
    {
        $task = new CalendarTask([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed_date' => $request->completed_date,
            'active' => $request->active,
            'user_id' => $request->user_id,
        ]);
        $task->save();

        return CalendarTaskResource::collection(CalendarTask::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalendarTask  $calendarTask
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarTask $calendarTask)
    {
        return new CalendarTaskResource($calendarTask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendarTask  $calendarTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarTask $calendarTask)
    {
        $calendarTask->update($request->all());

        if($calendarTask->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendarTask  $calendarTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarTask $calendarTask) : JsonResponse
    {
        if($calendarTask->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
