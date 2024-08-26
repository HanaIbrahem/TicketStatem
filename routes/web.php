<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//controlers

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashbordController;


// Route::get('/', function () {
//     return view('welcome');
// });



//authenticated user
Route::middleware('guest')->group(function (){
    Route::get('login',[UserController::class,'loginPage'])->name('login');
    Route::post('user/store',[UserController::class,'Login'])->name('loginrequest');
});


Route::post('logout', [UserController::class, 'destroy'])
->name('logout')->middleware('auth');

//Superadmin Midleware 
Route::middleware(['auth','superadmin'])->name('dashbord.')->group(function (){


    //Authentication controller Super Admin
    Route::get('users',[\App\Http\Controllers\Control\AuthController::class,'index'])->name('users');
    Route::get('users/ctrate',[\App\Http\Controllers\Control\AuthController::class,'create'])->name('user.create');
    Route::post('users/store',[\App\Http\Controllers\Control\AuthController::class,'store'])->name('user.store');
    Route::post('users/updatepass',[\App\Http\Controllers\Control\AuthController::class,'updatepassword'])->name('user.pass');
    Route::get('users/edit/{id}',[\App\Http\Controllers\Control\AuthController::class,'edit'])->name('user.edit');
    Route::post('users/update',[\App\Http\Controllers\Control\AuthController::class,'update'])->name('user.update');
    Route::get('users/state/{id}',[\App\Http\Controllers\Control\AuthController::class,'change_activation_status'])->name('user.state');

    //ProblemType Routes
    Route::get('problem',[\App\Http\Controllers\Control\ProlemTypeController::class,'index'])->name('problem');
    Route::post('problem/store',[\App\Http\Controllers\Control\ProlemTypeController::class,'store'])->name('problem.store');
    Route::get('problem/edit/{id}',[\App\Http\Controllers\Control\ProlemTypeController::class,'edit'])->name('problem.edit');
    Route::post('problem/update',[\App\Http\Controllers\Control\ProlemTypeController::class,'update'])->name('problem.update');
    Route::get('problem/state/{id}',[\App\Http\Controllers\Control\ProlemTypeController::class,'change_activation_status'])->name('problem.state');

    //Request from Controller
    Route::get('requestfrom',[\App\Http\Controllers\Control\RequestController::class,'index'])->name('requestfrom');
    Route::post('requestfrom/store',[\App\Http\Controllers\Control\RequestController::class,'store'])->name('requestfrom.store');
    Route::get('requestfrom/edit/{id}',[\App\Http\Controllers\Control\RequestController::class,'edit'])->name('requestfrom.edit');
    Route::post('requestfrom/update',[\App\Http\Controllers\Control\RequestController::class,'update'])->name('requestfrom.update');
    Route::get('requestfrom/state/{id}',[\App\Http\Controllers\Control\RequestController::class,'change_activation_status'])->name('requestfrom.state');

    //Solution  Controller
    Route::get('solution',[\App\Http\Controllers\Control\SolutionController::class,'index'])->name('solution');
    Route::post('solution/store',[\App\Http\Controllers\Control\SolutionController::class,'store'])->name('solution.store');
    Route::get('solution/edit/{id}',[\App\Http\Controllers\Control\SolutionController::class,'edit'])->name('solution.edit');
    Route::post('solution/update',[\App\Http\Controllers\Control\SolutionController::class,'update'])->name('solution.update');
    Route::get('solution/state/{id}',[\App\Http\Controllers\Control\SolutionController::class,'change_activation_status'])->name('solution.state');
   
    //Ticket Routes
    // Route::get('pending\ticket',[\App\Http\Controllers\Control\PendingTicketController::class,'index'])->name('pending');
    Route::get('ticket/approve/{id}',[\App\Http\Controllers\Control\PendingTicketController::class,'approve'])->name('pending.approve');
    Route::get('setting', [\App\Http\Controllers\SyetemSetting::class, 'index'])->name('setting');
    Route::get('export-database', [\App\Http\Controllers\SyetemSetting::class, 'export'])->name('setting.export');
    Route::get('backup-database', [\App\Http\Controllers\SyetemSetting::class, 'backupToStorage'])->name('setting.backup');
    Route::get('/backups/download/{filename}', [\App\Http\Controllers\SyetemSetting::class, 'download'])->name('backups.download');



});

//manager middlewere 
Route::middleware(['auth','manager'])->name('dashbord.')->group(function (){

    //changestate
    Route::get('index',[DashbordController::class,'index'])->name('index');
    Route::get('pending/tickets',[\App\Http\Controllers\Control\PendingTicketController::class,'index'])->name('pending');
    Route::get('pending/',[\App\Http\Controllers\Control\PendingTicketController::class,'changestate'])->name('pending.state');
    Route::get('pending/all/',[\App\Http\Controllers\Control\PendingTicketController::class,'changeallstate'])->name('pending.allstate');
    Route::get('ticket/approve/{id}',[\App\Http\Controllers\Control\PendingTicketController::class,'approve'])->name('pending.approve');
    Route::get('tickets/',[\App\Http\Controllers\Control\PendingTicketController::class,'tickets'])->name('ticketes.all');
    Route::get('tickets/state/{id}',[\App\Http\Controllers\Control\PendingTicketController::class,'state'])->name('ticket.all.state');
    // DateOrder
    Route::get('tickets/dateorder',[\App\Http\Controllers\Control\PendingTicketController::class,'dateorder'])->name('ticketes.dateorder');
    
    Route::get('trash',[\App\Http\Controllers\TrashController::class,'index'])->name('trash');
    Route::get('trash/action',[\App\Http\Controllers\TrashController::class,'action'])->name('trash.action');
    Route::get('trash/allstet',[\App\Http\Controllers\TrashController::class,'allstate'])->name('trash.allstate');



});

//employee 

Route::middleware(['auth','verified'])->name('dashbord.')->group(function (){

    Route::get('index',[DashbordController::class,'index'])->name('index');

    Route::get('ticket',[\App\Http\Controllers\Control\TIckteController::class,'index'])->name('ticket');
    Route::get('ticket/create',[\App\Http\Controllers\Control\TIckteController::class,'create'])->name('ticket.create');
    Route::post('ticket/store',[\App\Http\Controllers\Control\TIckteController::class,'store'])->name('ticket.store');
    Route::get('ticket/edit/{id}',[\App\Http\Controllers\Control\TIckteController::class,'edit'])->name('ticket.edit');
    Route::post('ticket/update',[\App\Http\Controllers\Control\TIckteController::class,'update'])->name('ticket.update');
    Route::get('ticket/state/{id}',[\App\Http\Controllers\Control\TIckteController::class,'change_state'])->name('ticket.state');
    Route::get('ticket/destroy/{id}',[\App\Http\Controllers\Control\TIckteController::class,'destroy'])->name('ticket.destroy');


    //grid view
    Route::get('ticket/grid',[\App\Http\Controllers\Control\TIckteController::class,'grid'])->name('ticket.grid');

    Route::get('ticket/show/{id}',[\App\Http\Controllers\Control\TIckteController::class,'show'])->name('ticket.show');
    Route::get('ticket/delete/{id}',[\App\Http\Controllers\Control\TIckteController::class,'delete'])->name('ticket.delete');
    Route::get('ticket/moreticket',[\App\Http\Controllers\Control\TIckteController::class,'getMoretickets'])->name('ticket.more');
    Route::get('ticket/date',[\App\Http\Controllers\Control\TIckteController::class,'dateorder'])->name('ticket.dateorder');

    Route::post('ticket/solution',[\App\Http\Controllers\Control\SolutionController::class,'addsolution'])->name('addsolution');
    Route::post('ticket/problem',[\App\Http\Controllers\Control\ProlemTypeController::class,'addproblem'])->name('addproblem');
    Route::get('tickets/all',[\App\Http\Controllers\Control\TIckteController::class,'allticketstet'])->name('ticket.all');

});

Route::any('{any}', function () {
    if (Auth::check()) {
        return redirect()->route('dashbord.index');
    } else {
        return redirect('/login');
    }
})->where('any', '.*');


// Route::any('{any}', function () {
//     return redirect('/login');
// })->where('any', '.*');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
