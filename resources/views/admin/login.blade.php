<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login DCMI</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/dbs.ico') }}">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #0d1b2a;
        }

        .bg-layer {
            position: fixed;
            inset: 0;
            background-image: url('{{ asset('storage/assets/dbels-elevation.webp') }}');
            background-size: cover;
            background-position: center;
            filter: blur(6px) brightness(0.45);
            transform: scale(1.05);
            z-index: 0;
        }

        .bg-overlay {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, rgba(13,27,42,0.6) 0%, rgba(26,58,110,0.5) 100%);
            z-index: 1;
        }

        .login-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 420px;
            padding: 1rem;
        }

        .login-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(18px) saturate(160%);
            -webkit-backdrop-filter: blur(18px) saturate(160%);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 20px;
            padding: 2.5rem 2.25rem 2rem;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            animation: fadeUp 0.45s ease both;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .logo-wrap {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo-wrap img {
            height: 90px;
            width: 90px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.25);
            box-shadow: 0 6px 24px rgba(0,0,0,0.4);
            object-fit: contain;
            background: rgba(255,255,255,0.1);
            padding: 6px;
        }
        .logo-wrap h1 {
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 700;
            margin-top: 0.75rem;
            letter-spacing: 0.4px;
        }
        .logo-wrap p {
            color: rgba(255,255,255,0.55);
            font-size: 0.8rem;
            margin-top: 0.2rem;
        }

        .divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.12);
            margin: 1.25rem 0;
        }

        .alert-error {
            background: rgba(220,53,69,0.18);
            border: 1px solid rgba(220,53,69,0.45);
            color: #ff8a8a;
            border-radius: 10px;
            padding: 0.65rem 0.9rem;
            font-size: 0.83rem;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .field-group { margin-bottom: 1.1rem; }

        .field-label {
            display: block;
            color: rgba(255,255,255,0.7);
            font-size: 0.78rem;
            font-weight: 500;
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        .field-wrap { position: relative; }

        .field-wrap .field-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
            font-size: 0.85rem;
            pointer-events: none;
        }

        .field-wrap input {
            width: 100%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 10px;
            color: #ffffff;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            padding: 0.65rem 2.8rem 0.65rem 2.4rem;
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .field-wrap input::placeholder { color: rgba(255,255,255,0.3); }
        .field-wrap input:focus {
            border-color: rgba(100,149,237,0.7);
            background: rgba(255,255,255,0.12);
            box-shadow: 0 0 0 3px rgba(100,149,237,0.18);
        }

        .toggle-pass {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.35);
            cursor: pointer;
            font-size: 0.85rem;
            padding: 0;
            line-height: 1;
            transition: color 0.2s;
        }
        .toggle-pass:hover { color: rgba(255,255,255,0.7); }

        .field-error {
            color: #ff8a8a;
            font-size: 0.76rem;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.72rem;
            margin-top: 0.5rem;
            background: linear-gradient(135deg, #1a3a6e 0%, #2c51a1 100%);
            border: none;
            border-radius: 10px;
            color: #ffffff;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            letter-spacing: 0.3px;
            transition: opacity 0.2s, transform 0.15s, box-shadow 0.2s;
            box-shadow: 0 4px 18px rgba(44,81,161,0.45);
        }
        .btn-login:hover  { opacity: 0.92; transform: translateY(-1px); box-shadow: 0 6px 24px rgba(44,81,161,0.55); }
        .btn-login:active { transform: translateY(0); }

        .login-footer {
            text-align: center;
            margin-top: 1.4rem;
            color: rgba(255,255,255,0.3);
            font-size: 0.72rem;
        }
    </style>
</head>

<body>
    <div class="bg-layer"></div>
    <div class="bg-overlay"></div>

    <div class="login-wrapper">
        <div class="login-card">

            <div class="logo-wrap">
                <img src="{{ asset('storage/assets/dcm-logo.jpg') }}" alt="DCMI Logo">
                <h1>DCMP Admin</h1>
                <p>Sign in to your account</p>
            </div>

            <hr class="divider">

            @if (Session::has('error'))
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ Session::get('error') }}
                </div>
            @endif

            <form action="{{ route('admin.auth') }}" method="post" autocomplete="off">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="email">Email Address</label>
                    <div class="field-wrap">
                        <i class="fas fa-envelope field-icon"></i>
                        <input type="email" id="email" name="email"
                               placeholder="you@example.com"
                               value="{{ old('email') }}"
                               autocomplete="username">
                    </div>
                    @if ($errors->has('email'))
                        <div class="field-error">
                            <i class="fas fa-circle-exclamation"></i>
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="field-wrap">
                        <i class="fas fa-lock field-icon"></i>
                        <input type="password" id="password" name="password"
                               placeholder="��������"
                               autocomplete="current-password">
                        <button type="button" class="toggle-pass" onclick="togglePassword()" aria-label="Toggle password visibility">
                            <i class="fas fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <div class="field-error">
                            <i class="fas fa-circle-exclamation"></i>
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt" style="margin-right:6px;"></i> Sign In
                </button>
            </form>

            <p class="login-footer">&copy; {{ date('Y') }} DCMI. All rights reserved.</p>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>

</html>
