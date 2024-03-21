<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::select('id', 'course_code', 'course_name')->get();
        return response()->json($courses);
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
            'course_code' => 'required',
            'course_name' => 'required'
        ]);

        $course = Course::create($validatedData);
        return response()->json([
            'id' => $course->id,
            'course_code' => $course->course_code,
            'course_name' => $course->course_name
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'course_code' => 'required',
            'course_name' => 'required'
        ]);

        $course->update($validatedData);
        return response()->json($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json([ 'message' => "Deleted" ]); 
    }
}
