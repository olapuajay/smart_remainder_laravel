<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'title' => 'required | string | max:255',
            'reminder_time' => 'required | date',
        ]);

        $tasks = session()->get('tasks', []);

        // Generate a new ID (you can use uniqid() if needed)
        $newId = count($tasks) > 0 ? end($tasks)['id'] + 1 : 1;

        $tasks[] = [
            'id' => $newId,
            'title' => $request->title,
            'reminder_time' => $request->reminder_time,
        ];

        session()->put('tasks', $tasks); // Save updated list to session

        return redirect()->route('dashboard')->with('message', 'Task added successfully!');
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
