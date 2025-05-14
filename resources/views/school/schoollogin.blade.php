<!DOCTYPE html>
<html>
<head>
    <title>School Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1580582932707-520aed937b7b?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #4A90E2;
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-box button:hover {
            background-color: #357ABD;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>School Login</h2>

    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form action="{{ route('confirm-login') }}" method="POST">
        @csrf
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
