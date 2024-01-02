<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PersonalTask;
use Carbon\Carbon;

class CheckUrgentTasks extends Command
{
    protected $signature = 'tasks:checkurgent';
    protected $description = 'Check tasks for urgency';

    public function handle()
    {
        $currentTime = Carbon::now()->setTimeZone('Asia/Amman')->addDay();
        $tasks = PersonalTask::whereNotNull('deadline')
        ->where('deadline', '<=', $currentTime)
        ->update(['urgent' => true]);

        $currentTime = Carbon::now()->setTimeZone('Asia/Amman')->addDay();
        $tasks = GroupTask::whereNotNull('deadline')
        ->where('deadline', '<=', $currentTime)
        ->update(['urgent' => true]);

        // foreach ($tasks as $task) {

        //     // $deadline = Carbon::parse($task->deadline);
        //     // $currentTime = Carbon::now();

        //     // info("====" . $task->id ."======");
        //     // info($currentTime);
        //     // info($deadline);
        //     // info($deadline->diffInHours($currentTime->setTimeZone('Asia/Amman')));
        //     // // Check if the task's deadline is within 24 hours
        //     // if ($deadline->diffInHours($currentTime) <= 24) {
        //     //     info("in if stat");
        //     //     $task->update(['urgent' => true]);
        //     // } else {
        //     //     $task->update(['urgent' => false]);
        //     // }

        //     info("====" . $task->id ."======");
        //     info($task->task);
        //     info($currentTime);
        //     info($task->deadline);
        
        // }

        info("urgent tasks run");
        $this->info('Urgent tasks checked.');
    }
}

