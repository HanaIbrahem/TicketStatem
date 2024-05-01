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

        $user= Auth::user();
        $problemTypeCount = ProblemType::count();
        $requestFromCount = RequetsFrom::count();
        $userCount = User::count();
        $ticketCount=Tickt::count();

        if ($user->isManager()) {

            return view('dashbord.manager.index',compact('problemTypeCount', 'requestFromCount', 'userCount', 'ticketCount'));

        } else if ($user->isSuperadmin()){
            return view('dashbord.index',compact('problemTypeCount', 'requestFromCount', 'userCount', 'ticketCount'));

        }else{

            return view('dashbord.employee.index');
        }
    
        
 

    }

    
}
