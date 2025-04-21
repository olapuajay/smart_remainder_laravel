<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reminder: {{ $task['title'] }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            border-bottom: 2px solid #4361ee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4361ee;
            font-size: 24px;
            margin: 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .task-info {
            margin-bottom: 15px;
        }
        .task-info strong {
            color: #4361ee;
            display: inline-block;
            width: 120px;
        }
        .footer {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>⏰ Task Reminder</h1>
    </div>
    
    <div class="content">
        <div class="task-info">
            <strong>Task:</strong> {{ $task['title'] }}
        </div>
        <div class="task-info">
            <strong>Scheduled Time:</strong> {{ date('F j, Y \a\t g:i A', strtotime($task['reminder_time'])) }}
        </div>
    </div>
    
    <div class="footer">
        <p>This is an automated reminder from Smart Reminder.</p>
        <p>Have a productive day!</p>
    </div>
</body>
</html>