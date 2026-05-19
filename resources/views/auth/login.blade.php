<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Base CMS</title>
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background: #f4f6f9; /* Warna white-off Campus Creative */
            margin: 0; 
            position: relative; /* Penting untuk tombol absolute */
        }
        
        /* Tombol Kembali ke Beranda */
        .back-to-home {
            position: absolute;
            top: 25px;
            left: 25px;
            text-decoration: none;
            color: #ffffff;
            background-color: #ff6b00; /* Orange Campus Creative */
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(255, 107, 0, 0.2);
            transition: all 0.3s ease;
        }
        .back-to-home:hover {
            background-color: #e66000;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 107, 0, 0.3);
        }

        .login-card { 
            background: white; 
            padding: 40px; 
            border-radius: 12px; 
            box-shadow: 0 8px 24px rgba(0,0,0,0.06); 
            width: 100%; 
            max-width: 400px; 
            border-top: 4px solid #ff6b00; /* Aksen orange di atas card */
        }
        h2 { 
            margin-top: 0;
            margin-bottom: 25px; 
            text-align: center; 
            color: #222529;
            font-weight: 800;
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: bold; 
            color: #222529;
            font-size: 14px;
        }
        input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #ddd; 
            border-radius: 6px; 
            box-sizing: border-box; 
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #ff6b00;
            outline: none;
        }
        button { 
            width: 100%; 
            padding: 14px; 
            background: #222529; /* Dark Grey Campus Creative */
            color: white; 
            border: none; 
            border-radius: 6px; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold;
            margin-top: 15px; 
            transition: background 0.3s;
        }
        button:hover {
            background: #ff6b00; /* Berubah jadi orange saat dihover */
        }
        .error { 
            color: #dc3545; 
            font-size: 14px; 
            margin-bottom: 15px; 
            text-align: center;
            background: #f8d7da;
            padding: 10px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    
    <a href="{{ url('/') }}" class="back-to-home">
        &larr; Kembali ke Beranda
    </a>

    <div class="login-card">
        <h2>Admin Login</h2>
        
        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="admin@mail.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="******">
            </div>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>