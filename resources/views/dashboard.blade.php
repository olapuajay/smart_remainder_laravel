@extends('layouts.app')

@section('content')
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="form-group">
        <h2 class="form-title">Add New Task</h2>
        <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
            @csrf
            <div class="form-row">
                <input type="text" name="title" placeholder="Enter task title" required>
                <input type="datetime-local" name="reminder_time" required>
                <button type="submit" class="btn-add">Add Task</button>
            </div>
        </form>
    </div>

    <div class="task-list-group">
        <h3 class="task-list-title">Your Tasks</h3>
        @if(count($tasks))
            <ul class="task-list">
                @foreach($tasks as $task)
                    <li class="task-item">
                        <div class="task-info">
                            <div class="task-title">{{ $task['title'] }}</div>
                            <div class="task-time">Due: {{ date('M j, Y g:i A', strtotime($task['reminder_time'])) }}</div>
                        </div>
                        <div class="task-actions">
                            <form action="{{ route('tasks.destroy', $task['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty-state">No tasks added yet. Add your first task above!</p>
        @endif
    </div>
@endsection