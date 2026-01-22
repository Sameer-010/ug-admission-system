<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test & Interview Slip</title>

    <style>
        body { font-family: "DejaVu Sans", sans-serif;  }
        .header {
            background: #002855;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }
        .box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 20px;
            border-radius: 10px;
        }
        .label { font-weight: bold; }
    </style>
</head>
<body>

<div class="header">
    <h2>University of Gwadar</h2>
    <h3>Test & Interview Slip</h3>
</div>

<div class="box">
    <p><span class="label">Student Name:</span> {{ $app->user->name }}</p>
    <p><span class="label">Program:</span> {{ $app->program->name }}</p>
    <p><span class="label">Email:</span> {{ $app->user->email }}</p>
</div>

<div class="box">
    <p><span class="label">Test & Interview Date:</span> {{ $app->interview_date }}</p>
    <p><span class="label">Time:</span> {{ $app->interview_time }}</p>
    <p><span class="label">Venue:</span> {{ $app->interview_venue }}</p>
</div>

@if($app->interview_notes)
<div class="box">
    <p><span class="label">Notes:</span></p>
    <p>{{ $app->interview_notes }}</p>
</div>
@endif

<div style="margin-top: 20px;">
    <p><strong>Instructions:</strong></p>
    <ul>
        <li>Bring original CNIC/B-Form</li>
        <li>Arrive at least 15 minutes before the test time</li>
        <li>Keep this slip with you</li>
    </ul>
</div>

</body>
</html>
