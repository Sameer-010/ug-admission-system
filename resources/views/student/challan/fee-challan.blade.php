<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fee Challan</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .box { border: 1px solid #000; padding: 15px; }
        h2 { text-align: center; }
        table { width: 100%; margin-top: 10px; }
        td { padding: 6px; }
    </style>
</head>
<body>

<h2>UG ADMISSION FEE CHALLAN</h2>

<div class="box">
    <table>
        <tr><td><strong>Challan No:</strong></td><td>{{ $application->challan_number }}</td></tr>
        <tr><td><strong>Applicant Name:</strong></td><td>{{ $application->user->name }}</td></tr>
        <tr><td><strong>Program:</strong></td><td>{{ $application->program->name }}</td></tr>
        <tr><td><strong>Fee Amount:</strong></td><td>PKR 2,000</td></tr>
        <tr><td><strong>Status:</strong></td><td>{{ strtoupper($application->challan_status) }}</td></tr>
        <tr><td><strong>Issue Date:</strong></td><td>{{ now()->format('d M Y') }}</td></tr>
    </table>
</div>

<p style="margin-top:20px;">
    Pay this challan at any designated bank and upload the paid copy in the portal.
</p>

</body>
</html>
