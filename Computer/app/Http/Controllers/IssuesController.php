<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Computer;

class IssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::with('computer')->paginate(5);
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'reported_by' => 'required',
            'reported_date' => 'required',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
            'computer_id' => 'required',
        ]);

        Issue::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Issue created successfully.');
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//
//    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $issues = Issue::findOrFail($id);
        $computers = Computer::all();
        return view('issues.edit', compact('issues', 'computers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'reported_by' => 'required',
            'reported_date' => 'required',
            'description' => 'required',
            'urgency' => 'required',
            'status' => 'required',
            'computer_id' => 'required',
        ]);

        $issues = Issue::findOrFail($id);
        $issues->update($request->all());

        return redirect()->route('issues.index')->with('success', 'Issue updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $issues = Issue::findOrFail($id);
        $issues->delete();

        return redirect()->route('issues.index')->with('success', 'Issue deleted successfully.');
    }
}
