<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminderMail;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = session()->get('tasks', []); // Get tasks from session, default to empty array
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'reminder_time' => 'required|date',
        ]);

        $tasks = session()->get('tasks', []);

        $newId = count($tasks) > 0 ? end($tasks)['id'] + 1 : 1;

        $newTask = [
            'id' => $newId,
            'title' => $request->title,
            'reminder_time' => $request->reminder_time,
        ];

        $tasks[] = $newTask;

        session()->put('tasks', $tasks);

        // ✅ Send email
        Mail::to('olapuajay@gmail.com')->send(new TaskReminderMail($newTask));

        return redirect()->route('dashboard')->with('message', 'Task added successfully and email sent!');
    }

    public function destroy($id)
    {
        $tasks = session()->get('tasks', []);
        $tasks = array_filter($tasks, function ($task) use ($id) {
            return $task['id'] != $id;
        });

        session()->put('tasks', array_values($tasks)); // Reindex the array

        return redirect()->route('dashboard')->with('message', 'Task deleted successfully!');
    }
}
