<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body>
    <h2>Email Verification</h2>
    <p>Hi {{$user->name}},</p>
    <p>Thank you for registering on our website. Please click on the following link to verify your email address:</p>
    <p><a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a></p>
    <p>If you did not create an account, no further action is required.</p>
    <p>Best regards,</p>
    <p>The Example Team</p>
</body>
</html>
