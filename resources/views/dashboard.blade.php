@extends('layouts.app')

@section('content')
    @if(session('message'))
        <p style="color: green">{{ session('message') }}</p>
    @endif

    <h2>Add New Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Task title" required>
        <input type="datetime-local" name="reminder_time" required>
        <button type="submit">Add</button>
    </form>

    <h3>Your Tasks</h3>
    @if(count($tasks))
        <ul>
            @foreach($tasks as $task)
                <li>
                    <strong>{{ $task['title'] }}</strong> - {{ $task['reminder_time'] }}
                    <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit">Delete</button>
                  </form>                  
                </li>
            @endforeach
        </ul>
    @else
        <p>No tasks added yet.</p>
    @endif
@endsection
