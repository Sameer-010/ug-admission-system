<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin role required.');
        }

        $query = User::where('role', 'staff')->latest();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $staff = $query->get();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin role required.');
        }

        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin role required.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Use explicit field assignment instead of mass assignment
            $staff = new User();
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            $staff->password = Hash::make($request->password);
            $staff->role = 'staff';
            $staff->email_verified_at = now();
            $staff->save();

            return redirect()->route('admin.staff.index')
                ->with('success', 'Staff member ' . $staff->name . ' created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create staff member: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin role required.');
        }

        $staff = User::where('role', 'staff')->findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin role required.');
        }

        $staff = User::where('role', 'staff')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff->id,
            'phone' => 'required|string|max:15',
        ]);

        try {
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            
            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|string|min:8|confirmed',
                ]);
                $staff->password = Hash::make($request->password);
            }

            $staff->save();

            return redirect()->route('admin.staff.index')
                ->with('success', 'Staff member updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update staff member: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin role required.');
        }

        try {
            $staff = User::where('role', 'staff')->findOrFail($id);
            
            if ($staff->id === auth()->id()) {
                return redirect()->back()
                    ->with('error', 'You cannot delete your own account!');
            }

            $staff->delete();

            return redirect()->route('admin.staff.index')
                ->with('success', 'Staff member deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete staff member: ' . $e->getMessage());
        }
    }
}