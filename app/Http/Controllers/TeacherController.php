<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::select('id', 'name')->get();
        return response()->json($teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $teacher = Teacher::create($validatedData);
        return response()->json([
            'id' => $teacher->id,
            'name' => $teacher->course_code
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        $teacher->update($validatedData);
        return response()->json($teacher);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json([ 'message' => "Deleted" ]); 
    }
}
