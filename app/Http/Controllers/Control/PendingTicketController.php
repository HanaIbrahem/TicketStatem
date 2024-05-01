<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tickt;


class PendingTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $user = Auth::user();
        $tickets = Tickt::whereHas('user', function ($query) {
            $query->where('role', 'employee');
        })
        ->where('state', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('dashbord.tickt.pending', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function changestate(Request $request,$id)
    {
        //
        $ticketId = $id;
        $action = $request->input('action'); 
        $ticket=Tickt::find($ticketId);
        
        if ($action=="approved") {
            
            $ticket->state="approved";
            $ticket->save();

        }else if($action=="reject"){
            $ticket->state="reject";
            $ticket->save();

        }
    
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function approve(string $id)
    {
        //

        $user = Auth::user();

        $ticket=Tickt::findOrFail($id);
        if ($user->id ==$ticket->user_id) {
            $ticket->state="approved";
            $ticket->save();
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function tickets()
    {
        //
        $user = Auth::user();

        if ($user->role === "superadmin") {
            $tickets = Tickt::orderBy('created_at', 'desc')->get();
            return view('dashbord.tickt.tickets ', compact('tickets'));
        }
        $tickets = Tickt::whereHas('user', function ($query) {
            $query->where('role', 'employee');
        })
        ->orderBy('created_at', 'desc')
        ->get();
        return view('dashbord.tickt.tickets ', compact('tickets'));
    }
    public function state(Request  $request,string $id)
    {
        //

        $ticketId = $id;
        $action = $request->input('action'); 
        $ticket=Tickt::find($ticketId);
        
        if ($action=="approved") {
            
            $ticket->state="approved";
            $ticket->save();

        }else if($action=="reject"){
            $ticket->state="reject";
            $ticket->save();

        }else if($action=="opened"){
            $ticket->state="opened";
            $ticket->save();

        }
        return redirect()->back();
        
        
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
