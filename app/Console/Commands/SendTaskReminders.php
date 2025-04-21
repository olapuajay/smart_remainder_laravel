<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;

class SendTaskReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send task email reminders (session-based)';

    public function handle()
    {
        $tasks = session()->get('tasks', []); // Only works per-user if session persisted

        $now = now()->format('Y-m-d H:i');

        foreach ($tasks as $task) {
            if (substr($task['reminder_time'], 0, 16) === $now) {
                // Send mail to the logged-in user (replace with actual user email)
                Mail::to('ajju6533@gmail.com')->send(new TaskReminderMail($task));
            }
        }

        $this->info('Reminders sent (if any matched current time)');
    }
}
