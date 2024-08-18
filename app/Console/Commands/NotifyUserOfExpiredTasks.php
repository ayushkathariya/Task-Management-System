<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Notifications\TaskDeadlineNotification;
use Illuminate\Console\Command;

class NotifyUserOfExpiredTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-user-of-expired-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = Task::where('is_completed', false)
            ->where('deadline', '<=', now())
            ->get();

        foreach ($tasks as $task) {
            $user = $task->user;
            $user->notify(new TaskDeadlineNotification($task));
        }

    }
}
