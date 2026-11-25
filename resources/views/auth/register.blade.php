<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-box {
            background: white;
            width: 380px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.2s;
        }

        input:focus {
            border-color: #6c9bcf;
            box-shadow: 0 0 4px rgba(108, 155, 207, 0.5);
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="register-box">
        <h2>Registrasi Pegawai</h2>

        {{-- Tampilkan semua error --}}
        @if ($errors->any())
            <div style="background-color:#f8d7da;color:#721c24;padding:10px;border-radius:6px;margin-bottom:15px;">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tampilkan success message --}}
        @if (session('success'))
            <div style="background-color:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf

            <label>Nama</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" required>

            <button type="submit">Daftar</button>
        </form>
    </div>
