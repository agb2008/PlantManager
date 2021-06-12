<?php

namespace App\Http\Controllers;

use App\Models\CalendarTasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CalendarTasksResource;
use App\Http\Requests\StoreCalendarTasksRequest;
use Illuminate\Http\JsonResponse;

class CalendarTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return PlantsResource::collection(Plants::all()->where('user_id',Auth::user()->id));
        return CalendarTasksResource::collection(CalendarTasks::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCalendarTasksRequest $request)
    {
        $task = new CalendarTasks([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'completed_date' => $request->completed_date,
            'active' => $request->active,
            'user_id' => $request->user_id,
        ]);
        $task->save();

        return CalendarTasksResource::collection(CalendarTasks::all()->where('user_id',Auth::user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CalendarTasks  $calendarTasks
     * @return \Illuminate\Http\Response
     */
    public function show(CalendarTasks $calendarTasks)
    {
        return new CalendarTasksResource($calendarTasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendarTasks  $calendarTasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendarTasks $calendarTasks)
    {
        $calendarTasks->update($request->all());

        if($calendarTasks->save()){
            return  response()->json(["message" => "Запись успешно обновлена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при обновлении записи"], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendarTasks  $calendarTasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendarTasks $calendarTasks) : JsonResponse
    {
        if($calendarTasks->delete()){
            return  response()->json(["message" => "Запись успешно удалена"], 200);
        } else {
            return  response()->json(["message" => "Ошибка при удалении записи"], 400);
        }
    }
}
