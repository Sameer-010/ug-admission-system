<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Test & Interview Slip</title>

    <style>
        /* DomPDF SAFE styles — DO NOT add @font-face */
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #222;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .small {
            font-size: 12px;
            color: #555;
        }

        .card {
            border: 1px solid #ddd;
            padding: 14px;
            margin-bottom: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #e6e6e6;
            text-align: left;
        }

        th {
            background: #f5f5f5;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>

<body>
<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="title">UG Admission — Test & Interview Slip</div>
        <div class="small">
            Generated: <?php echo e(now()->format('M d, Y — h:i A')); ?>

        </div>
    </div>

    <!-- STUDENT INFO -->
    <div class="card">
        <strong>Student Information</strong>
        <table>
            <tr>
                <th>Name</th>
                <td><?php echo e($student->name); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo e($student->email); ?></td>
            </tr>
            <tr>
                <th>Application ID</th>
                <td>#<?php echo e($application->id); ?></td>
            </tr>
            <tr>
                <th>Program</th>
                <td><?php echo e($program->code); ?> — <?php echo e($program->name); ?></td>
            </tr>
        </table>
    </div>

    <!-- TEST INFO -->
    <div class="card">
        <strong>Test Schedule</strong>
        <table>
            <tr>
                <th>Date</th>
                <td><?php echo e(\Carbon\Carbon::parse($test_date)->format('M d, Y')); ?></td>
            </tr>
            <tr>
                <th>Time</th>
                <td><?php echo e(\Carbon\Carbon::parse($test_time)->format('h:i A')); ?></td>
            </tr>
            <tr>
                <th>Venue</th>
                <td><?php echo e($test_venue); ?></td>
            </tr>
        </table>
    </div>

    <!-- INTERVIEW INFO -->
    <div class="card">
        <strong>Interview Schedule</strong>
        <table>
            <tr>
                <th>Date</th>
                <td><?php echo e(\Carbon\Carbon::parse($interview_date)->format('M d, Y')); ?></td>
            </tr>
            <tr>
                <th>Time</th>
                <td><?php echo e(\Carbon\Carbon::parse($interview_time)->format('h:i A')); ?></td>
            </tr>
            <tr>
                <th>Venue</th>
                <td><?php echo e($interview_venue); ?></td>
            </tr>
        </table>
    </div>

    <!-- NOTES -->
    <?php if(!empty($notes)): ?>
        <div class="card">
            <strong>Notes</strong>
            <div class="small" style="margin-top:6px;">
                <?php echo e($notes); ?>

            </div>
        </div>
    <?php endif; ?>

    <!-- FOOTER -->
    <div class="footer">
        Please bring a printed copy of this slip and your original CNIC / Form-B
        on the test and interview day.
    </div>

</div>
</body>
</html>
<?php /**PATH C:\Users\PMLS\projects\ug-admission-system\resources\views/admin/applications/partials/test-interview-slip.blade.php ENDPATH**/ ?>