<?php

namespace App\Http\Controllers\Admin;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMaterialNotification;

class MaterialController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $material = $request->file('material')->getClientOriginalName();
        $path = $request->file('material')->storeAs('materials',$material,'public');

        $new_material = Material::create([
            'path' => $path,
            'course_id' => $request->course_id
        ]);

        $students = $new_material->course->students;
        Notification::send($students, new NewMaterialNotification($new_material->course->name, $new_material->course->id ,basename($new_material->path)));
        

        return redirect()->route('courses.show', ['course' => $new_material->course])->with('message','Matrial Added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
