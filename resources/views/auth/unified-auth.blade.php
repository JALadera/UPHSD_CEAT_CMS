<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UPH Engineering') }} - Authentication</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
        }

        body {
            background: #f5f5f5;
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(-100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(-100%);
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(100%);
            }
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        body.page-exit {
            animation: fadeOut 0.4s ease-out forwards;
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: slideUp 0.6s ease-out;
        }

        .auth-box {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            min-height: 600px;
            position: relative;
        }

        .form-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            background: white;
            overflow-y: auto;
            max-height: 100vh;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            position: absolute;
            width: 55%;
            height: 100%;
        }

        .form-column.login-form {
            left: 0;
            animation: slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-column.register-form {
            left: 45%;
            animation: slideInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-column.swapping-out-left {
            animation: slideOutLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .form-column.swapping-out-right {
            animation: slideOutRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .brand-panel {
            background: linear-gradient(135deg, #a52a2a 0%, #8b0000 100%);
            position: relative;
            overflow: hidden;
            width: 45%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 50px;
            color: white;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 10;
        }

        .brand-panel::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(139, 0, 0, 0.3);
            border-radius: 50%;
            top: -50px;
            right: -50px;
        }

        .brand-panel::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(165, 42, 42, 0.2);
            border-radius: 50%;
            bottom: -80px;
            left: -50px;
        }

        .brand-panel.login-panel {
            order: 1;
            animation: slideInRight 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand-panel.register-panel {
            order: 2;
            margin-left: auto;
            animation: slideInLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand-panel.swapping-out-left {
            animation: slideOutLeft 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .brand-panel.swapping-out-right {
            animation: slideOutRight 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .checkmark-icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fbbf24;
            border: 2px solid #fbbf24;
            border-radius: 50%;
            color: #8b0000;
            font-size: 14px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .input-field {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .input-field:focus {
            outline: none;
            background: white;
            border-color: #8b0000;
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: #8b0000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover:not(:disabled) {
            background: #6b0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(139, 0, 0, 0.2);
        }

        .btn-primary:active:not(:disabled) {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            background: white;
            color: #8b0000;
            border: 2px solid #8b0000;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        .logo-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #8b0000;
            font-size: 18px;
        }

        .feature-item {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .feature-item p {
            margin: 0;
            line-height: 1.5;
        }

        .feature-title {
            font-weight: 600;
            font-size: 15px;
        }

        .feature-description {
            font-size: 13px;
            opacity: 0.9;
        }

        .spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        .btn-primary.loading .spinner {
            display: block;
        }

        .btn-primary.loading .btn-text {
            opacity: 0.8;
        }

        .form-group {
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .auth-box {
                flex-direction: column;
            }

            .form-column {
                position: relative;
                width: 100%;
                left: auto;
                padding: 40px 30px;
            }

            .brand-panel {
                width: 100%;
                padding: 40px 30px;
                order: 1;
            }

            .form-column.register-form {
                left: 0;
            }
        }

        .hidden-form {
            display: none;
        }

        .visible-form {
            display: flex;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-box" id="authBox">
            <!-- LOGIN FORM -->
            <div class="form-column login-form visible-form" id="loginForm">
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <div class="mb-8">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1f2937; margin: 0 0 8px 0;">Sign In</h2>
                    <p style="font-size: 14px; color: #6b7280; margin: 0;">Enter your credentials to access your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginFormElement">
                    @csrf

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Email Address</label>
                        <input type="email" name="email" class="input-field" value="{{ old('email') }}" placeholder="student@uphsd.edu.ph" required autofocus autocomplete="username" />
                        @error('email')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Password</label>
                        <input type="password" name="password" class="input-field" placeholder="Enter your password" required autocomplete="current-password" />
                        @error('password')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; color: #374151;">
                            <input type="checkbox" name="remember" style="width: 18px; height: 18px; cursor: pointer;" />
                            Remember me
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 14px; color: #fb923c; text-decoration: none; font-weight: 500;">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary" id="loginSubmitBtn">
                        <span class="spinner"></span>
                        <span class="btn-text">Sign In</span>
                    </button>
                </form>

                <div style="display: flex; align-items: center; gap: 15px; margin: 30px 0;">
                    <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                    <span style="font-size: 12px; color: #9ca3af;">or continue with</span>
                    <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                    <button type="button" class="btn-secondary">Google</button>
                    <button type="button" class="btn-secondary">Microsoft</button>
                </div>

                <p style="text-align: center; font-size: 14px; color: #6b7280; margin-top: 30px;">
                    Don't have an account?
                    <a href="#" onclick="switchToRegister(event)" style="color: #fb923c; text-decoration: none; font-weight: 600;">Sign up here</a>
                </p>
            </div>

            <!-- REGISTER FORM -->
            <div class="form-column register-form hidden-form" id="registerForm">
                <div class="mb-8">
                    <h2 style="font-size: 32px; font-weight: 700; color: #1f2937; margin: 0 0 8px 0;">Create Account</h2>
                    <p style="font-size: 14px; color: #6b7280; margin: 0;">Join thousands of engineering students shaping the future</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerFormElement">
                    @csrf

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Full Name</label>
                        <input type="text" name="name" class="input-field" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus autocomplete="name" />
                        @error('name')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Email Address</label>
                        <input type="email" name="email" class="input-field" value="{{ old('email') }}" placeholder="student@uphsd.edu.ph" required autocomplete="username" />
                        @error('email')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Password</label>
                        <input type="password" name="password" class="input-field" placeholder="••••••••" required autocomplete="new-password" />
                        @error('password')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 8px;">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="input-field" placeholder="••••••••" required autocomplete="new-password" />
                        @error('password_confirmation')<p style="color: #dc2626; font-size: 13px; margin-top: 5px;">{{ $message }}</p>@enderror
                    </div>

                    <button type="submit" class="btn-primary" id="registerSubmitBtn">
                        <span class="spinner"></span>
                        <span class="btn-text">Create Account</span>
                    </button>
                </form>

                <p style="text-align: center; font-size: 14px; color: #6b7280; margin-top: 30px;">
                    Already have an account?
                    <a href="#" onclick="switchToLogin(event)" style="color: #fb923c; text-decoration: none; font-weight: 600;">Sign in here</a>
                </p>
            </div>

            <!-- LOGIN BRAND PANEL -->
            <div class="brand-panel login-panel" id="loginBrand">
                <div class="brand-content">
                    <div class="logo-badge">
                        <div class="logo-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"></path>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">UPHSD</div>
                            <div style="font-size: 12px; opacity: 0.9;">College of Engineering</div>
                        </div>
                    </div>

                    <h1 style="font-size: 42px; font-weight: 700; margin: 0 0 16px 0; line-height: 1.2;">Welcome Back</h1>
                    <p style="font-size: 16px; margin: 0 0 32px 0; opacity: 0.95; line-height: 1.6;">Continue your engineering journey with us</p>

                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div><p class="feature-title">Access your courses and materials</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div><p class="feature-title">Connect with faculty and peers</p></div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div><p class="feature-title">Track your academic progress</p></div>
                    </div>
                </div>
            </div>

            <!-- REGISTER BRAND PANEL -->
            <div class="brand-panel register-panel hidden-form" id="registerBrand">
                <div class="brand-content">
                    <div class="logo-badge">
                        <div class="logo-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"></path>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 15px;">UPHSD</div>
                            <div style="font-size: 12px; opacity: 0.9;">College of Engineering</div>
                        </div>
                    </div>

                    <h1 style="font-size: 42px; font-weight: 700; margin: 0 0 16px 0; line-height: 1.2;">Start Your Journey</h1>
                    <p style="font-size: 16px; margin: 0 0 32px 0; opacity: 0.95; line-height: 1.6;">Join thousands of engineering students shaping the future</p>

                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Quality Education</p>
                            <p class="feature-description">Access world-class engineering curriculum and resources</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Expert Faculty</p>
                            <p class="feature-description">Learn from experienced professors and industry professionals</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Modern Facilities</p>
                            <p class="feature-description">State-of-the-art laboratories and learning spaces</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="checkmark-icon">✓</div>
                        <div>
                            <p class="feature-title">Career Support</p>
                            <p class="feature-description">Industry partnerships and job placement assistance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentMode = 'login';

        function switchToRegister(e) {
            e.preventDefault();
            if (currentMode === 'register') return;

            const authBox = document.getElementById('authBox');
            const loginForm = document.getElementById('loginForm');
            const loginBrand = document.getElementById('loginBrand');
            const registerForm = document.getElementById('registerForm');
            const registerBrand = document.getElementById('registerBrand');

            // Add swapping animations
            loginForm.classList.add('swapping-out-left');
            loginBrand.classList.add('swapping-out-left');

            setTimeout(() => {
                // Hide login elements
                loginForm.classList.remove('visible-form', 'swapping-out-left');
                loginForm.classList.add('hidden-form');
                loginBrand.classList.remove('visible-form', 'swapping-out-left');
                loginBrand.classList.add('hidden-form');

                // Reposition and show register elements
                registerForm.classList.remove('hidden-form');
                registerForm.classList.add('visible-form');
                registerBrand.classList.remove('hidden-form');
                registerBrand.classList.add('visible-form');

                currentMode = 'register';
            }, 300);
        }

        function switchToLogin(e) {
            e.preventDefault();
            if (currentMode === 'login') return;

            const authBox = document.getElementById('authBox');
            const loginForm = document.getElementById('loginForm');
            const loginBrand = document.getElementById('loginBrand');
            const registerForm = document.getElementById('registerForm');
            const registerBrand = document.getElementById('registerBrand');

            // Add swapping animations
            registerForm.classList.add('swapping-out-right');
            registerBrand.classList.add('swapping-out-right');

            setTimeout(() => {
                // Hide register elements
                registerForm.classList.remove('visible-form', 'swapping-out-right');
                registerForm.classList.add('hidden-form');
                registerBrand.classList.remove('visible-form', 'swapping-out-right');
                registerBrand.classList.add('hidden-form');

                // Reposition and show login elements
                loginForm.classList.remove('hidden-form');
                loginForm.classList.add('visible-form');
                loginBrand.classList.remove('hidden-form');
                loginBrand.classList.add('visible-form');

                currentMode = 'login';
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const loginFormElement = document.getElementById('loginFormElement');
            const registerFormElement = document.getElementById('registerFormElement');
            const loginSubmitBtn = document.getElementById('loginSubmitBtn');
            const registerSubmitBtn = document.getElementById('registerSubmitBtn');

            // Handle login form submission
            if (loginFormElement) {
                loginFormElement.addEventListener('submit', function(e) {
                    loginSubmitBtn.disabled = true;
                    loginSubmitBtn.classList.add('loading');
                    
                    setTimeout(() => {
                        document.body.classList.add('page-exit');
                    }, 300);
                });
            }

            // Handle register form submission
            if (registerFormElement) {
                registerFormElement.addEventListener('submit', function(e) {
                    registerSubmitBtn.disabled = true;
                    registerSubmitBtn.classList.add('loading');
                    
                    setTimeout(() => {
                        document.body.classList.add('page-exit');
                    }, 300);
                });
            }
        });
    </script>
</body>
</html>