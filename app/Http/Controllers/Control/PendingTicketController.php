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
        $no = 1;

        $tickets = Tickt::whereHas('user', function ($query) {
            $query->where('role', 'employee');
        })
            ->where('state', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashbord.tickt.pending', compact('tickets', 'no'));
    }

    /**
     * manger to accept and reject 
     */
    public function changestate(Request $request)
    {

        // dd($request->all());
        $no = 1;
        $ticketId = $request->ticketId;
        $action = $request->action;
        $ticket = Tickt::find($ticketId);
        if ($action == "approved") {

            $ticket->state = "approved";
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
            return view('dashbord.includes.pending', compact('tickets', 'no'))->render();


        } else if ($action == "reject") {
            $ticket->state = "reject";
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
            return view('dashbord.includes.pending', compact('tickets', 'no'))->render();


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

        $ticket = Tickt::findOrFail($id);
        if ($user->id == $ticket->user_id) {
            $ticket->state = "approved";
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
     * to show all of the tickets 
     */
    public function tickets()
    {
        //
        $startDate = now()->startOfMonth();
        $currentDate = now();
        $user = Auth::user();

        if ($user->role === "superadmin") {
            $tickets = Tickt::whereBetween('created_at', [$startDate, $currentDate])->orderBy('created_at', 'desc')->get();
            return view('dashbord.tickt.tickets ', compact('tickets', 'startDate', 'currentDate'));
        }
        $tickets = Tickt::whereHas('user', function ($query) {
            $query->where('role', 'employee');
        })
            ->whereBetween('created_at', [$startDate, $currentDate])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashbord.tickt.tickets ', compact('tickets', 'startDate', 'currentDate'));
    }

    // change state by maneger or superadmin
    public function state(Request $request, string $id)
    {
        //

        $ticketId = $id;
        $action = $request->input('action');
        $ticket = Tickt::find($ticketId);

        if ($action == "approved") {

            $ticket->state = "approved";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket approved successfully.',
                'alert-type' => 'success'
            );


        } else if ($action == "reject") {
            $ticket->state = "reject";
            $ticket->save();
            $notification = array(
                'message' => 'Ticket rejected successfully.',
                'alert-type' => 'warning'
            );


        } else if ($action == "opened") {
            $ticket->state = "opened";
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
    public function changeallstate(Request $request)
    {
        //

        $action = $request->stete;
        $selected = $request->selectedTickets;
        // return response()->json();

        // return response()->json($action);
        if (!empty($selected) && is_array($selected)) {

            if ($action == "approved") {
                $tickets = Tickt::whereHas('user', function ($query) {
                    $query->where('role', 'employee');
                })
                    ->whereIn('id', $selected)
                    ->where('state', 'pending')
                    ->update(['state' => 'approved']);
                $notification = [
                    'message' => ' ' . $tickets . ' Ticketes approved.',
                    'alert-type' => 'success'
                ];

                return response()->json($notification);

            } else if ($action == "reject") {
                $tickets = Tickt::whereHas('user', function ($query) {
                    $query->where('role', 'employee');
                })
                    ->whereIn('id', $selected)
                    ->where('state', 'pending')
                    ->update(['state' => 'reject']);
                $notification = [
                    'message' => '' . $tickets . ' Ticketet rejected.',
                    'alert-type' => 'warning'
                ];
                return response()->json($notification);
            }
        } elseif (empty($selected)) {
            # code...
            $notification = [
                'message' => ' No ticket affected .',
                'alert-type' => 'info'
            ];
            return response()->json($notification);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // date order
    public function dateorder(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            $request->validate([
                'fromdate' => 'required|date',
                'todate' => 'required|date'
            ]);
            
            $formdate = $request->input('fromdate');
            $todate = $request->input('todate');
            $orderby=$request->input('order');

            $no = 1;
            if ($user->role === "superadmin") {
                $tickets = Tickt::whereBetween($orderby, [$formdate, $todate])
                    ->orderBy('created_at', 'desc')->get();
                return view('dashbord.includes.employee ', compact('tickets', 'no'))->render();
            }
            $tickets = Tickt::whereHas('user', function ($query) {
                $query->where('role', 'employee');
            })
                ->whereBetween($orderby, [$formdate, $todate])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('dashbord.includes.employee', compact('tickets', 'no'))->render();
        }
        return redirect()->back();
    }
}
