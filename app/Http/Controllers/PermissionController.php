<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'module' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $module = strtolower(trim($request->module));
        $actions = ['create', 'read', 'edit', 'delete'];

        foreach ($actions as $action) {
            $permissionName = $action . ' ' . $module;

            // Check if permission already exists
            if (!Permission::where('name', $permissionName)->exists()) {
                Permission::create(['name' => $permissionName]);
            }
        }

        return redirect()->route('admin.permissions.index')->with('success', 'Permissions created successfully.');
    }
}
