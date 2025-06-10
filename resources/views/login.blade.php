<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="icon" href="{{ asset('asset/logo2.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: rgba(44, 44, 44, 0.8);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            padding: 50px;
            width: 350px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        h2 {
            text-align: center;
            color: #d63031;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }
        input {
            width: calc(100% - 30px);
            padding: 12px 15px;
            background: rgba(58, 58, 58, 0.7);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            width: calc(100% - 30px);
            padding: 12px;
            background-color: #d63031;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #b42b2b;
        }
        .error {
            color: #d63031;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Hanya Admin yang bisa mengakses seluruh data</h2>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn">Masuk</button>
            </div>
        </form>
    </div>
</body>
</html>
