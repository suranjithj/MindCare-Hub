<!DOCTYPE html>
<html>
<head>
    <title>Appointment Notification</title>
</head>
<body>
    <h2>Hello {{ $userName }},</h2>
    <p>Your appointment has been {{ $status }}.</p>
    <p><strong>Date:</strong> {{ $appointmentDate }}<br>
       <strong>Time:</strong> {{ $appointmentTime }}<br>
       <strong>Counselor:</strong> {{ $counselorName }}</p>
    <p>Thank you for choosing MindCare Hub.</p>
</body>
</html>
