<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\ProblemType;
use App\Models\User;
use App\Models\Tickt;
use App\Models\Solution;
use App\Models\RequetsFrom;

class DashbordController extends Controller
{
    //

    public function index()
    {

        $user = Auth::user();


        $openTicketsCount = Tickt::where('user_id', $user->id)
            ->where('state', 'opened')
            ->count();

        // Count pending tickets
        $pendingTicketsCount = Tickt::where('user_id', $user->id)
            ->where('state', 'pending')
            ->count();

        // Count all tickets
        $totalTicketsCount = Tickt::where('user_id', $user->id)->count();

        // Get recent tickets limited to 8
        $recentTickets = Tickt::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        if ($user->isManager()) {


            return view('dashbord.manager.index', compact('recentTickets','totalTicketsCount','openTicketsCount'));

        } else if ($user->isSuperadmin()) {
            $problemTypeCount = ProblemType::count();
            $requestFromCount = RequetsFrom::count();
            $userCount = User::count();
            $ticketCount = Tickt::count();
            return view('dashbord.index', compact('problemTypeCount', 'requestFromCount', 'userCount', 'ticketCount'));

        } else {



            return view('dashbord.employee.index',compact('recentTickets','totalTicketsCount','openTicketsCount','pendingTicketsCount'));
        }




    }


}
