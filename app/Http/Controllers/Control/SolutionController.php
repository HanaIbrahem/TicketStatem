<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solution;
class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $solutions=Solution::all();
        return view('dashbord.solution.index',compact('solutions'));
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
        //
        $request->validate([
            'title'=>'required|string'
        ]);
        $solution= new Solution();
        $solution->title= $request->title;
        $solution->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function change_activation_status(string $id)
    {
        //
        $solution=Solution::find($id);
        $solution->setAttribute("is_active", !$solution->getAttributeValue("is_active"));
        $solution->save();
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $solution= Solution::find($id);
        return view('dashbord.solution.edit',compact('solution'));
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
        $solution= Solution::find($id);
        $solution->title= $request->title;
        $solution->save();
        return redirect()->route('dashbord.solution');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
