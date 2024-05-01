<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequetsFrom;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $places=RequetsFrom::all();
        return view('dashbord.request.index',compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $request->validate([
            'title'=>'required|string'
        ]);
        $place= new RequetsFrom();
        $place->title= $request->title;
        $place->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function change_activation_status(string $id)
    {
        //
        $place=RequetsFrom::find($id);
        $place->setAttribute("is_active", !$place->getAttributeValue("is_active"));
        $place->save();
        return redirect()->back();
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $place= RequetsFrom::find($id);
        return view('dashbord.request.edit',compact('place'));
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
        $place= RequetsFrom::find($id);
        $place->title= $request->title;
        $place->save();
        return redirect()->route('dashbord.requestfrom');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
