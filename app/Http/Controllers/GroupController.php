<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupTask;
use App\Models\BasicGroup;
use App\Models\Invite;
use App\Models\User;
use Carbon\Carbon;

class GroupController extends Controller
{

    public function index() {

        return view('create', ['userNotFound' => null]);

    }

    public function create(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
        ]);

        if (!$validated) {
            return view('create', [
                'errors' => 'Required fields for creating new group required.'
            ]);
        }

        $invites = $request->input('invitations');
        $emails = explode(' ', $invites);

        foreach($emails as $email) {
            try {
                $user = User::where('email', $email)->first();

                if (!$user) {
                    return view('create', [
                        'userNotFound' => $email .' is not registered'
                    ]);
                }
            } catch(Exception $error) {
                return view('create', [
                    'errors' => 'An error occurred while processing the invitations'
                ]);
            }

        }

        
        $newGroup = BasicGroup::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'), 
            'user_id' => \Auth::user()->id,
        ]);

        $note = "You are invited by " . \Auth::user()->name . " to join their group " . $newGroup->name; 
        Invite::create([
            'basic_group_id' =>  $newGroup->id,
            'user_id' => \Auth::user()->id,
            'note' => $note,
            'accepted' => true
        ]);

        foreach($emails as $email) {
            
            $user = User::where('email', $email)->first();

            Invite::create([
                'basic_group_id' =>  $newGroup->id,
                'user_id' => $user->id,
                'note' => $note
            ]);

        }

        session()->flash('createdGroup', 'Group Created Succesfully!'); 

        return redirect()->back();
    }

    public function groups() {
        $userId = \Auth::user()->id;
        $invites = Invite::where('user_id', $userId)
                         ->where('accepted', true)
                         ->get();
        
        $groupIds = [];
        
        foreach ($invites as $invite) {
            $groupIds[] = $invite->basic_group_id;
        }
    
        $groups = BasicGroup::whereIn('id', $groupIds)->get();

        return view('groups', compact('groups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => ['required'],
        ]);

        if (!$validated) {
            return view('groups', [
               'errors' => 'Required fields for adding tasks are empty.'
            ]);
        }
        
        $dateInput = $request->input('dateInput');
        $timeInput = $request->input('timeInput');

        $combinedDateTime = null;

        $isUrgent = false;

        if ($dateInput && $timeInput) {
            $combinedDateTime = Carbon::createFromFormat('Y-m-d H:i', $dateInput . ' ' . $timeInput);

            $deadline = $combinedDateTime;
            $currentTime = Carbon::now();

            // Check if the task's deadline is within 24 hours
            if ($deadline->diffInHours($currentTime) <= 24) {
                $isUrgent = true;
            }
        }

        GroupTask::create([
            'task' => $request->input('task'),
            'deadline' => $combinedDateTime, // Use the combined datetime value or null
            'basic_group_id' => $request->input('groupId'),
            'urgent' => $isUrgent
        ]);

        session()->flash('messageAdd', 'Task Added Succesfully!'); 

        return redirect()->back();
    }

    public function destroy($id)
    {
        GroupTask::destroy($id);

        session()->flash('messageDelete', 'Task Completed!'); 

        return redirect()->back();
    }

    public function inProgress($id) {

        $task = GroupTask::findOrFail($id);


        if ($task->inProgress && ($task->userName != \Auth::user()->name)) {
            return redirect()->back();
        }
        elseif ($task->inProgress && ($task->userName == \Auth::user()->name)){
            $task->inProgress = false;
            $task->userName = null;
        }
        else {
            $task->inProgress = true;
            $task->userName = \Auth::user()->name;
        }
        
        $task->save();

        return redirect()->back();
    }

    public function edit(Request $request) {

        $id = $request->input('personalTaskId');

        $task = GroupTask::findOrFail($id);

        $validated = $request->validate([
            'edittask' => ['required'],
        ]);

        if (!$validated) {
            return view('groups', [
                'errors' => 'Required fields for adding new FAQ are empty.'
            ]);
        }
        
        $dateInput = $request->input('dateInput');
        $timeInput = $request->input('timeInput');

        $combinedDateTime = null;

        $isUrgent = false;

        if ($dateInput && $timeInput) {
            $combinedDateTime = Carbon::createFromFormat('Y-m-d H:i', $dateInput . ' ' . $timeInput);

            $deadline = $combinedDateTime;
            $currentTime = Carbon::now();

            // Check if the task's deadline is within 24 hours
            if ($deadline->diffInHours($currentTime) <= 24) {
                $isUrgent = true;
            }
        }

        $task->task = $request->input('edittask');
        $task->deadline = $combinedDateTime;
        $task->urgent = $isUrgent;
        $task->save();

        return redirect()->back();

    }
}
