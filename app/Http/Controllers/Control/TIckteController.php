<?php

namespace App\Http\Controllers\Control;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tickt;
use App\Models\ProblemType;
use App\Models\RequetsFrom;
use App\Models\Solution;

class TIckteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //select tickets between strt of month and current date 
        $startDate = now()->startOfMonth();
        $currentDate = now();
        $user = Auth::user();
        $tickets = Tickt::where('user_id', $user->id)
        -> whereBetween('created_at', [$startDate, $currentDate])
        ->orderBy('created_at', 'desc')->get();
        return view('dashbord.tickt.index', compact('tickets','startDate','currentDate'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $problemTypes = ProblemType::where('is_active', true)->orderBy('title', 'asc')->get();
        $requetsFroms = RequetsFrom::where('is_active', true)->orderBy('title', 'asc')->get();
        $solutions = Solution::where('is_active', true)->orderBy('title', 'asc')->get();

        return view('dashbord.tickt.create', compact('problemTypes', 'requetsFroms', 'solutions'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'requetsfrom' => 'required|exists:requets_froms,id',
            'place' => 'required',
            'issuetype' => 'required|in:Hardwar,Softwar,Network,Security,Email',
            'problemtype' => 'required|exists:problem_types,id',
            'solution' => 'required|exists:solutions,id',
            'delivery' => 'required|in:Email,Phone Call,Remote,On Site Support,Video Call',
            'opendate' => 'required|date',
            'enddate' => 'required|date'
        ]);

        $ticket = new Tickt();
        //enum fields
        $ticket->place = $request->input('place');
        $ticket->deliverytype = $request->input('delivery');
        $ticket->issuetype = $request->input('issuetype');


        $ticket->note = $request->input('note');
        $ticket->reason= $request->input('reasonOptions');
        $ticket->responsibility=$request->input('responsibility');
        //fogign keys
        $ticket->user_id = auth()->id();
        $ticket->requets_id = $request->input('requetsfrom');
        $ticket->problem_id = $request->input('problemtype');
        $ticket->solution_id = $request->input('solution');
        //My default
        $ticket->state = 'opened';
        //date 
        $ticket->startdate = $request->input('opendate');
        $ticket->enddate = $request->input('enddate');

        $ticket->save();
        $notification = array(
            'message' => 'Ticket created successfully.',
            'alert-type' => 'success'
        );

    
        return redirect()->back()->with($notification);
    }







    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $user = Auth::user();


        $ticket = Tickt::findOrFail($id);
        if ($user->id == $ticket->user_id && $ticket->state == "opened") {

            $problemTypes = ProblemType::where('is_active', true)->orderBy('title', 'asc')->get();
            $requetsFroms = RequetsFrom::where('is_active', true)->orderBy('title', 'asc')->get();
            $solutions = Solution::where('is_active', true)->orderBy('title', 'asc')->get();
            return view('dashbord.tickt.edit', compact('ticket', 'problemTypes', 'requetsFroms', 'solutions'));

        }
        if ($user->id == $ticket->user_id && $user->role !== 'employee') {

            $problemTypes = ProblemType::where('is_active', true)->orderBy('title', 'asc')->get();
            $requetsFroms = RequetsFrom::where('is_active', true)->orderBy('title', 'asc')->get();
            $solutions = Solution::where('is_active', true)->orderBy('title', 'asc')->get();
            return view('dashbord.tickt.edit', compact('ticket', 'problemTypes', 'requetsFroms', 'solutions'));

        }

        return redirect()->back();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'requetsfrom' => 'required|exists:requets_froms,id',
            'place' => 'required',
            'issuetype' => 'required|in:Hardwar,Softwar,Network,Security,Email',
            'problemtype' => 'required|exists:problem_types,id',
            'solution' => 'required|exists:solutions,id',
            'delivery' => 'required|in:Email,Phone Call,Remote,On Site Support,Video Call',
            'opendate' => 'required|date',
            'enddate' => 'required|date'
        ]);

        $id = $request->input('id');
        $ticket = Tickt::findOrFail($id);
        //enum fields
        $ticket->place = $request->input('place');
        $ticket->deliverytype = $request->input('delivery');
        $ticket->issuetype = $request->input('issuetype');


        $ticket->note = $request->input('note');
        $ticket->reason= $request->input('reasonOptions');
        $ticket->responsibility=$request->input('responsibility');
        //fogign keys
        $ticket->user_id = auth()->id();
        $ticket->requets_id = $request->input('requetsfrom');
        $ticket->problem_id = $request->input('problemtype');
        $ticket->solution_id = $request->input('solution');
        //date 
        $ticket->startdate = $request->input('opendate');
        $ticket->enddate = $request->input('enddate');


        $ticket->save();
        $notification = array(
            'message' => 'Ticket edited successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // to change state from opend to pending
    // public function change_state(string $id)
    // {
    //     //
    //     $ticket=Tickt::findOrFail($id);
    //     $user = Auth::user();

    //     if ($user->id == $ticket->user_id && $ticket->state=="opened"  ) {
    //         $ticket->state="pending";
    //         $ticket->save();

    //     }

    //     return redirect()->back();

    // }

    //chnage stete for ticket by user to close tickets
    public function change_state($id)
    {
        $ticket = Tickt::findOrFail($id);
        $user = Auth::user();

        if ($user->id == $ticket->user_id && $ticket->state == "opened") {
            $ticket->state = "pending";
            $ticket->save();

            $notification = array(
                'message' => 'Ticket state changed.',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }


        return response()->json(['success' => false, 'message' => 'Unauthorized or invalid state']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ticket = Tickt::findOrFail($id);
        $user = Auth::user();

        if ($user->id == $ticket->user_id && ($ticket->state == "opened" || $ticket->state == "reject")) {
            $ticket->delete();

        }
        if ($user->id == $ticket->user_id && $user->role !== 'employee') {
            $ticket->delete();

        }

        return redirect()->back();

    }

    // add grid view for ticket page '

    public function grid()
    {
        $user=Auth::user();
        $tickets = Tickt::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('dashbord.tickt.grid',compact('tickets'));
    }

    //this fuction used for deleting ticket in show page to redirect index page 
    public function delete(string $id)
    {
        //
        $ticket = Tickt::findOrFail($id);
        $user = Auth::user();

        if ($user->id == $ticket->user_id && ($ticket->state == "opened" || $ticket->state == "reject")) {
            $ticket->delete();

        }
        if ($user->id == $ticket->user_id && $user->role !== 'employee') {
            $ticket->delete();

        }

        return redirect()->route('dashbord.index');

    }

    //filter order by date 
    public function dateorder(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'fromdate' => 'required|date',
            'todate' => 'required|date'
        ]);
        $formdate=$request->input('fromdate');
        $todate=$request->input('todate');
        $orderby=$request->input('order');
        $tickets = Tickt::whereBetween($orderby, [$formdate, $todate])->
        where('user_id',$user->id)->orderBy('created_at', 'desc')->get();

        $no=1;
        if ($request->ajax()) {
            return view('dashbord.includes.ticket_list',compact('tickets','no'))->render();

        }

    
        
        // return response()->json($tickets);

    }
    //get more tickets
    public function getMoretickets( Request $request)
    {
        $user = Auth::user();
        // dd($request);
        $tickets = Tickt::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
    
        if ($request->ajax()) {
            return view('dashbord.tickt.mortecket', compact('tickets'))->render();
        }
    
        return abort(404);
    }
    
    // show tickets
    public function show(string $id)
    {

        $user = Auth::user();
        $ticket=Tickt::findOrFail($id);

        if ($user->id == $ticket->user_id) {

            return view('dashbord.tickt.show',compact('ticket'));


        }
        

        return redirect()->back();
        
    }
    //change state for all tickets
    public function allticketstet(Request $request)
    {

        $action=$request->stete;
        $selected=$request->selectedTickets;
     
        // return response()->json($action);

        $user = Auth::user();

        $action=$request->stete;
        $selected=$request->selectedTickets;
        // return response()->json();

        // return response()->json($action);
        if (!empty($selected) && is_array($selected))
        {

            if ($action == "pending" && $user->role=='employee' ) {
                $tickets = Tickt::where('state', 'opened')
                         ->whereIn('id', $selected)
                        ->where('user_id',$user->id)
                        ->update(['state' => 'pending']);
                $notification = [
                    'message' => ' '.$tickets.' Ticketes closed.', 
                    'alert-type' => 'success'
                ];
            
                return response()->json($notification);
            
            } else if ($action == "remove" ) {
           
                if ($user->role =='employee') {

                
                    $tickets = Tickt::whereIn('id', $selected)
                    ->whereIn('state', ['reject','opened'])
                    ->where('user_id',$user->id)
                    ->delete();

                }else{
                    $tickets = Tickt::whereIn('id', $selected)
                    
                    ->where('user_id',$user->id)
                    ->delete();
                }
                $notification = [
                    'message' => ''.$tickets.' Ticketet deleted.', 
                    'alert-type' => 'error'
                ];
                return response()->json($notification);
            }else if ($action == "approved" ){

                $tickets = Tickt::whereDoesntHave('user', function ($query) {
                    $query->where('role', 'employee');
                })->whereIn('id', $selected)
                ->where('user_id',$user->id)
                ->update(['state' => 'approved']);

                
                $notification = [
                    'message' => ' '.$tickets.' Ticketes Approved.', 
                    'alert-type' => 'success'
                ];
                return response()->json($notification);
            }
        }
    
        elseif (empty($selected) ) {
            # code...
            $notification = [
                'message' => ' No ticket affected .', 
                'alert-type' => 'info'
            ];
            return response()->json($notification);

        }
    
   
    }


}
