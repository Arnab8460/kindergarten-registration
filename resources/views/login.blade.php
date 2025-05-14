<!DOCTYPE html>
<html>
<head>
    <title>OTP Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .otp-form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .otp-form-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .otp-form-container label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .otp-form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        .otp-form-container button {
            background-color: #4A90E2;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .otp-form-container button:hover {
            background-color: #357ABD;
        }

        .otp-form-container .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="otp-form-container">
    <h2>Mobile Login</h2>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('pickup.send.otp') }}">
        @csrf
        <label for="contact_no">Enter Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no" pattern="\d{10}" maxlength="10" required placeholder="Enter Mobile No">

        <button type="submit">Send OTP</button>
    </form>
</div>

</body>
</html>
