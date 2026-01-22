<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    /**
     * Display a listing of the programs (with search support).
     */
    public function index(Request $request)
    {
        // Both admin and staff can view the list
        if (!in_array(auth()->user()->role, ['admin', 'staff'])) {
            abort(403, 'Unauthorized access.');
        }

        // Start query builder
        $query = Program::query();

        // ✅ Search filter: filter by name or code
        if ($request->has('search') && !empty($request->search)) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Fetch programs (newest first)
        $programs = $query->latest()->get();

        // Pass the search term to the view to retain the input value
        return view('admin.programs.index', compact('programs'))
            ->with('search', $request->search);
    }

    /**
     * Show the form for creating a new program.
     */
    public function create()
    {
        // Only admin can access create page
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }

        return view('admin.programs.create');
    }

    /**
     * Store a newly created program.
     */
    public function store(Request $request)
    {
        // Only admin can store programs
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:programs',
            'description' => 'nullable|string',
            'duration_years' => 'required|integer|min:1|max:5',
            'total_seats' => 'required|integer|min:1',
        ]);

        $isActive = $request->has('is_active');

        $program = Program::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'duration_years' => $request->duration_years,
            'total_seats' => $request->total_seats,
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program "' . $program->name . '" created successfully!');
    }

    /**
     * Show the form for editing the specified program.
     */
    public function edit(Program $program)
    {
        // Only admin can access edit page
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }

        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Update the specified program.
     */
    public function update(Request $request, Program $program)
    {
        // Only admin can update programs
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:programs,code,' . $program->id,
            'description' => 'nullable|string',
            'duration_years' => 'required|integer|min:1|max:5',
            'total_seats' => 'required|integer|min:1',
        ]);

        $isActive = $request->has('is_active');

        $program->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'duration_years' => $request->duration_years,
            'total_seats' => $request->total_seats,
            'is_active' => $isActive,
        ]);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program "' . $program->name . '" updated successfully!');
    }

    /**
     * Remove the specified program.
     */
    public function destroy(Program $program)
    {
        // Only admin can delete programs
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access. Admin only.');
        }

        $programName = $program->name;
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program "' . $programName . '" deleted successfully!');
    }
}
