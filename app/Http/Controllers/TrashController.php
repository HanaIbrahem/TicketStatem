<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickt;
class TrashController extends Controller
{
    //

    public function index()
    {
        $no = 1;

        $tickets= Tickt::onlyTrashed()->orderBy('created_at','desc')->get();
        return view('dashbord.trash.index',compact('tickets','no'));

    }

    public function action(Request $request)
    {

        $id= $request->id;
        $action =$request->action;
        $ticket = Tickt::withTrashed()->findOrFail($id);

        if ($ticket && $ticket->trashed()) {

            if ($action=='delete') {
                $ticket->forceDelete();

            } elseif($action=='restore') {
                $ticket->restore();

            }
            
        }
        return redirect()->back();
    }

    public function allstate(Request $request)
    {


        $action = $request->stete;
        $selected = $request->selectedTickets;


        if (!empty($selected) && is_array($selected)) {

            if ($action == "delete") {
                $tickets = Tickt::onlyTrashed()
                    ->whereIn('id', $selected)
                    ->forceDelete();
            
                $notification = [
                    'message' => count($selected) . ' Ticket(s) deleted.',
                    'alert-type' => 'warning'
                ];
            
            } else if ($action == "restore") {
                // Restore the soft-deleted tickets
                Tickt::onlyTrashed()
                    ->whereIn('id', $selected)
                    ->restore();
            
                // Update the state to 'opened'
                $tickets = Tickt::whereIn('id', $selected)
                    ->update(['state' => 'opened']);
            
                $notification = [
                    'message' => count($selected) . ' Ticket(s) restored.',
                    'alert-type' => 'success'
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


}
