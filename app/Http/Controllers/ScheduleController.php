<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('teacher:id,name', 'course:id,course_code', 'room:id,room_code')->get();
        $transformedSchedules = $schedules->map(function ($schedule) {
        return [
            'id' => $schedule->id,
            'day' => $schedule->day,
            'start_time' => $schedule->start_time,
            'end_time' => $schedule->end_time,
            'teacher_id' => $schedule->teacher->id,
            'teacher_name' => $schedule->teacher->name,
            'course_id' => $schedule->course->id,
            'course_code' => $schedule->course->course_code, 
            'room_id' => $schedule->room->id,
            'room_code' => $schedule->room->room_code, 
        ];
    });

    return response()->json($transformedSchedules);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'teacher_id' => 'required|exists:teachers,id' 
        ]);

        $schedule = Schedule::create($validatedData);
        return response()->json([
            'id' => $schedule->id,
            'day' => $schedule->day,
            'start_time' => $schedule->start_time,
            'end_time' => $schedule->end_time,
            'teacher_id' => $schedule->teacher->id,
            'teacher_name' => $schedule->teacher->name,
            'course_id' => $schedule->course->id,
            'course_code' => $schedule->course->course_code, 
            'room_id' => $schedule->room->id,
            'room_code' => $schedule->room->room_code,
        ], 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'teacher_id' => 'required|exists:teachers,id' 
        ]);
        
        $schedule->update($validatedData);
        return response()->json($schedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json([ 'message' => "Deleted" ]);
    }
}
