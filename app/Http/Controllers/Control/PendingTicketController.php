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
        $no=1;

        $tickets = Tickt::whereHas('user', function ($query) {
            $query->where('role', 'employee');
        })
        ->where('state', 'pending')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('dashbord.tickt.pending', compact('tickets','no'));
    }

    /**
     * manger to accept and reject 
     */
    public function changestate(Request $request)
    {
    
        // dd($request->all());
        $no=1;
        $ticketId = $request->ticketId;
        $action = $request->action; 
        $ticket=Tickt::find($ticketId);
        if ($action=="approved") {
            
            $ticket->state="approved";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket approved.', 
                'alert-type' => 'success'
            );
            $tickets = Tickt::whereHas('user', function ($query) {
                $query->where('role', 'employee');
            })
            ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
            return view('dashbord.includes.pending', compact('tickets','no'))->render();


        }else if($action=="reject"){
            $ticket->state="reject";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket rejected.', 
                'alert-type' => 'warning'
            );
            $tickets = Tickt::whereHas('user', function ($query) {
                $query->where('role', 'employee');
            })
            ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
            return view('dashbord.includes.pending', compact('tickets','no'))->render();


        }
       
    
        return redirect()->back();
    }

    /**
     * only for manager 
     */
    public function approve(string $id)
    {
        //

        $user = Auth::user();

        $ticket=Tickt::findOrFail($id);
        if ($user->id ==$ticket->user_id) {
            $ticket->state="approved";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket approved successfully.', 
                'alert-type' => 'success'
            );
        
            return redirect()->back()->with($notification);
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
            $notification = array(
                'message' => 'Ticket approved successfully.', 
                'alert-type' => 'success'
            );
        

        }else if($action=="reject"){
            $ticket->state="reject";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket rejected successfully.', 
                'alert-type' => 'warning'
            );
        

        }else if($action=="opened"){
            $ticket->state="opened";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket opened successfully.', 
                'alert-type' => 'info'
            );
        

        }
       
        return redirect()->back()->with($notification);
        
        
    }
    /**
     * change state for all ticets.
     */
    public function changeallstate($action)
    {
        //
         
        if ($action=="approved") {
            
            $tickets = Tickt::whereHas('user', function ($query) {
                $query->where('role', 'employee');
            })
            ->where('state', 'pending')->update(['state' => 'approved']);
            $notification = array(
                'message' => 'All Ticketes approved.', 
                'alert-type' => 'success'
            );
          
            return redirect()->back()->with($notification);;


        }else if($action=="reject"){
          
            $notification = array(
                'message' => 'All Ticketet rejected.', 
                'alert-type' => 'warning'
            );
            $tickets = Tickt::whereHas('user', function ($query) {
                $query->where('role', 'employee');
            })
            ->where('state', 'pending')->update(['state' => 'reject']);
           
            return redirect()->back()->with($notification);;



        }
       
    
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
