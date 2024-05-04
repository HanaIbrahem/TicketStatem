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
        //::where('is_active', true)
        $user = Auth::user();
        $tickets = Tickt::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('dashbord.tickt.index', compact('tickets'));

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

        return redirect()->route('dashbord.ticket')->with($notification);
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
        return redirect()->route('dashbord.ticket')->with($notification);
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

    // manger tickets 


}
