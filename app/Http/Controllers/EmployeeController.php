<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $users = User::role('employee')->get();
        return view('admin.employee.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'dob' => 'required|date',
            'password' => 'required|confirmed|min:6',
            'gender' => 'required|in:male,female',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hr_images', 'public');
        }
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'dob'     => $request->dob,
            'password'  => Hash::make($request->password),
            'gender'    => $request->gender,
            'image'     => $path
        ]);
        $user->assignRole('employee');
        return redirect()->route('admin.employee.index')->with('success','Employee created');
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
        $user = User::find($id);
        return view('admin.employee.edit',compact('user','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'dob' => 'required|date',
        'gender' => 'required|in:male,female,other',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->store('hr_images', 'public');
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->dob = $request->dob;
    $user->gender = $request->gender;

    $user->save();

    return redirect()->route('admin.employee.index')->with('success', 'HR updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete image if exists
        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        // Remove role (optional but clean)
        $user->removeRole('employee');

        // Delete user
        $user->delete();

        return redirect()->route('admin.employee.index')->with('success', 'Employee deleted');
    }
}
