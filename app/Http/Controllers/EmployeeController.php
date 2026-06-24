<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {

        $team = Employee::query()->where('position', Auth::user()->team);

        $employees = $team->get();

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'allowance' => 'nullable|numeric',
        ]);

        Auth::user()->employees()->create($request->all());

        return redirect()->route('employees.index')->with('success', 'Project created successfully.');
    }

    public function show(Employee $employee)
    {
        
        $users = User::all();
        return view('employees.show', compact('employee', 'users'));
    }
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'salary' => 'nullable|numeric',
            'allowance' => 'nullable|numeric',
        ]);


        $employee->update($request->all());

       
        return redirect()->route('employees.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Project deleted successfully.');
    }

    public function addMember(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $project = Project::find($request->project_id);
        $project->teamProjects()->attach($request->user_id);
        return redirect()->back()->with('success', 'User added successfully.');
    }
}
