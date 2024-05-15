<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProblemType;
class ProlemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $problems=ProblemType::all();
        return view('dashbord.problem.index',compact('problems'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title'=>'required|string'
        ]);
        $problem= new ProblemType();
        $problem->title= $request->title;
        $problem->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function change_activation_status(string $id)
    {
        //
        $problem=ProblemType::find($id);
        $problem->setAttribute("is_active", !$problem->getAttributeValue("is_active"));
        $problem->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $problem= ProblemType::find($id);
        return view('dashbord.problem.edit',compact('problem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'title'=>'required|string'
        ]);
        $id=$request->id;
        $problem=ProblemType::find($id);
        $problem->title= $request->title;
        $problem->save();
        return redirect()->route('dashbord.problem');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addproblem(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|unique:problem_types,title',
            
        ]);
        $problem= new ProblemType();
        $problem->title= $request->title;
        $problem->save();
        return response()->json(['message' => 'problem added successfully','problem'=>$problem], 201);
        

    }
}
