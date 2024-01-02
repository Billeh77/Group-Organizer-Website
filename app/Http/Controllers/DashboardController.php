<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupTask;
use App\Models\PersonalTask;
use App\Models\BasicGroup;
use App\Models\Invite;
use App\Models\User;


class DashboardController extends Controller
{
    
    public function index(){

        $userId = \Auth::user()->id;
        $urgentTasks = PersonalTask::where('user_id', $userId)
                                    ->where('urgent', true)
                                    ->get();

        $invites = \Auth::user()->groups()->pluck('basic_group_id'); 
        $urgentGroupTasks = GroupTask::whereIn('basic_group_id', $invites)->where('urgent', true)->get();

        $invites = Invite::where('user_id', $userId)
                        ->where('accepted', false)
                        ->get();

        // $messages =

        return view('dashboard', compact('urgentTasks', 'urgentGroupTasks','invites'));
        
    }

    public function accept($id) {

        $invite = Invite::findOrFail($id);

        $invite->accepted = true;
        
        $invite->save();

        return redirect()->back();

    }

}
