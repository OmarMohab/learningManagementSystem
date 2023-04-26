<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexTeacher()
    {
        $users = User::latest();
        if (request()->has('search')) {
            $users->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        $users = $users->where('role',2)->paginate(5);
        $role  = "Teachers";
        return view('user.index',compact('users','role'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexStudent()
    {
        $users = User::latest();
        if (request()->has('search')) {
            $users->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        $users = $users->where('role',0)->paginate(5);
        $role  = "Students";
        return view('user.index',compact('users','role'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexAdmin()
    {
        $users = User::latest();
        if (request()->has('search')) {
            $users->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        $users = $users->where('role',1)->paginate(5);
        $role  = "Admins";
        return view('user.index',compact('users','role'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        return view('user.create',compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'grade_id' => 'required_if:role,==,0'
        ]);
    
        if($request->input('role') == 0)
        {
            $student = Student::create(['grade_id' => $request->input('grade_id')]);
            $student->user()->create($request->all());
        }
        elseif($request->input('role') == 2){
            $teacher = Teacher::create();
            $teacher->user()->create($request->all());
        }
        
        return redirect()->route('admin.home')
                        ->with('success','User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);
    
        $user->update($request->all());
    
        if($request->role == 0){
            return redirect()->route('admin.user.student')
            ->with('success','User updated successfully');
        }elseif($request->role == 1){
            return redirect()->route('admin.user.admin')
            ->with('success','User updated successfully');
        }else{
            return redirect()->route('admin.user.teacher')
            ->with('success','User updated successfully'); 
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {   
        $role = $user->role;
        $user->delete();
        
        if($role == "student"){
            return redirect()->route('admin.user.student')
            ->with('success','User updated successfully');
        }elseif($role == "admin"){
            return redirect()->route('admin.user.admin')
            ->with('success','User updated successfully');
        }else{
            return redirect()->route('admin.user.teacher')
            ->with('success','User updated successfully'); 
        }

    }
}
