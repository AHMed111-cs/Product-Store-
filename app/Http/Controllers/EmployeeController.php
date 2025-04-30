<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-employees');

        $employees = User::role('employee')->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        Gate::authorize('manage-employees');

        return view('employees.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('manage-employees');

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
        ]);

        $employee = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone'    => $validated['phone'] ?? null,
        ]);

        $employee->assignRole('employee');

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(User $employee)
    {
        Gate::authorize('manage-employees');

        if (!$employee->hasRole('employee')) {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        Gate::authorize('manage-employees');

        if (!$employee->hasRole('employee')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $employee->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
        ]);

        $employee->update([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => !empty($validated['password']) ? Hash::make($validated['password']) : $employee->password,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $employee)
    {
        Gate::authorize('manage-employees');

        if (!$employee->hasRole('employee')) {
            return redirect()->route('employees.index')->with('error', 'Cannot delete this user.');
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
