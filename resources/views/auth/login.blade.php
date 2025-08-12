<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} | Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --bg1: #f3f7ff;
        --bg2: #f8f2ff;
        --accent: #7c6cff;
        --accent-hover: #685aff;
        --muted: #6b7280;
        --glass: rgba(255, 255, 255, 0.12);
        --glass-border: rgba(255, 255, 255, 0.18);
        --radius: 14px;
        --shadow-soft: 0 10px 30px rgba(20, 20, 50, 0.08);
        --text-color: #0f172a;
        --input-bg: rgba(255, 255, 255, 0.08);
    }

    body.dark {
        --bg1: #1e1f29;
        --bg2: #2b2c3b;
        --accent: #9fb7ff;
        --accent-hover: #7c92ff;
        --muted: #a3a7c2;
        --glass: rgba(255, 255, 255, 0.06);
        --glass-border: rgba(255, 255, 255, 0.12);
        --text-color: #f1f1f8;
        --input-bg: rgba(255, 255, 255, 0.06);
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: "Inter", sans-serif;
        height: 100%;
        background: linear-gradient(120deg, var(--bg1), var(--bg2));
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .eyebrow {
        color: var(--muted);
        font-weight: 600;
        margin-bottom: 8px;
    }

    /* 
    h1 {
        font-size: 46px;
        margin: 0;
        color: var(--text-color);
    } */

    p.lead {
        color: var(--muted);
        margin-top: 6px;
        font-size: 16px;
        max-width: 400px;
    }

    .card {
        background: var(--glass);
        border-radius: var(--radius);
        padding: 28px;
        backdrop-filter: blur(8px) saturate(120%);
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-soft);
        animation: slideIn 0.8s ease forwards;
    }

    .card h2 {
        text-align: center;
        margin-bottom: 20px;
        color: var(--text-color);
    }

    .form-row {
        margin-bottom: 14px;
        position: relative;
    }

    .input {
        width: 100%;
        padding: 12px 40px 12px 14px;
        border-radius: 10px;
        border: 1px solid transparent;
        background: var(--input-bg);
        color: var(--text-color);
        font-size: 14px;
        outline: none;
        transition: border 0.2s, background 0.2s;
    }

    .input::placeholder {
        color: var(--muted);
    }

    .input:focus {
        border-color: var(--accent);
    }

    .toggle-pass {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        color: var(--muted);
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s, transform 0.1s;
    }

    .btn:hover {
        background: var(--accent-hover);
        transform: translateY(-1px);
    }

    .small {
        text-align: center;
        margin-top: 12px;
        font-size: 13px;
        color: var(--muted);
    }

    .dark-toggle {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--glass);
        border: 1px solid var(--glass-border);
        color: var(--text-color);
        padding: 6px 10px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 13px;
        backdrop-filter: blur(6px);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media (max-width: 900px) {
        .wrap {
            grid-template-columns: 1fr;
            text-align: center;
        }
    }
    </style>
</head>

<body>
    <div class="card">
        <h2>Selamat Datang</h2>
        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}"
            style="padding-left:20px;padding-right:20px;" onsubmit="return validateForm()">
            @csrf

            {{-- Email --}}
            <div class="form-row">
                <input type="email" class="input" id="email" name="email" placeholder="email" value="{{ old('email') }}"
                    required autocomplete="off" autofocus />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-row">
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="input" name="password" placeholder="password"
                        aria-describedby="password" required autocomplete="off" />
                    <button type="button" class="toggle-pass" onclick="togglePassword()">👁</button>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            {{-- Recaptcha --}}
            <div class="form-row">
                <div class="form-group">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mb-3">
                <center>
                    <button class="btn d-grid w-50"
                        style="background:#6e56ff;color:white;width: 70%!important;border-radius: 25px;text-transform: uppercase;"
                        type="submit">
                        {{ __('Login') }}
                    </button>
                </center>
            </div>
        </form>
    </div>

    <script>
    function togglePassword() {
        const pass = document.getElementById("password");
        pass.type = pass.type === "password" ? "text" : "password";
    }

    function validateForm() {
        const email = document.getElementById("email").value.trim();
        const pass = document.getElementById("password").value.trim();

        if (!email || !pass) {
            alert("Email dan password harus diisi!");
            return false;
        }
        return true;
    }
    </script>

</body>

</html>