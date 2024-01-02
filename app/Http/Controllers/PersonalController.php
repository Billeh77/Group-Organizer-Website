<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalTask;
use Carbon\Carbon;

class PersonalController extends Controller
{
    public function index() {
        return view('personal');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => ['required'],
        ]);

        if (!$validated) {
            return view('personal', [
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

        PersonalTask::create([
            'task' => $request->input('task'),
            'deadline' => $combinedDateTime, // Use the combined datetime value or null
            'user_id' => \Auth::user()->id,
            'urgent' => $isUrgent
        ]);

        session()->flash('messageAdd', 'Task Added Succesfully!'); 

        return redirect()->back();
    }

    public function destroy($id)
    {
        PersonalTask::destroy($id);

        session()->flash('messageDelete', 'Task Completed!'); 

        return redirect()->back();
    }

    public function inProgress($id) {

        $task = PersonalTask::findOrFail($id);

        if ($task->inProgress) {
            $task->inProgress = false;
        }
        else {
            $task->inProgress = true;
        }
        
        $task->save();

        return redirect()->back();
    }

    public function edit(Request $request) {

        $id = $request->input('personalTaskId');

        $task = PersonalTask::findOrFail($id);

        $validated = $request->validate([
            'edittask' => ['required'],
        ]);

        if (!$validated) {
            return view('personal', [
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
