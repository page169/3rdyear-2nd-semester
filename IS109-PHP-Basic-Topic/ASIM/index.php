<?php
    session_start();
    require_once "lib/database.php";
    require_once "lib/route.php";
    require_once "backend/login.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>TPC Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="SB_Admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #055160 0%, #198754 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background Image with Lower Opacity */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('tpclogo.png');
            background-size: 60% auto;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.08;
            pointer-events: none;
            z-index: 0;
        }
        
        /* Animated Background Elements */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(184, 154, 107, 0.1);
            filter: blur(60px);
            z-index: 0;
            animation: float 20s infinite ease-in-out;
        }
        
        .shape-1 {
            width: 500px;
            height: 500px;
            top: -200px;
            left: -200px;
            background: radial-gradient(circle, rgba(184,154,107,0.2) 0%, rgba(107,30,44,0.1) 100%);
        }
        
        .shape-2 {
            width: 600px;
            height: 600px;
            bottom: -250px;
            right: -200px;
            background: radial-gradient(circle, rgba(184,154,107,0.15) 0%, rgba(107,30,44,0.08) 100%);
            animation-delay: -5s;
        }
        
        .shape-3 {
            width: 300px;
            height: 300px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(184,154,107,0.12) 0%, rgba(107,30,44,0.05) 100%);
            animation-delay: -10s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -30px) scale(1.05);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.95);
            }
        }
        
        /* Main Container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            padding: 1.5rem;
        }
        
        /* Card Styles */
        .login-card {
            max-width: 480px;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35);
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: slideUp 0.6s ease-out;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 60px -15px rgba(0, 0, 0, 0.4);
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Header Section */
        .card-header-custom {
            background: linear-gradient(135deg, #198754 0%, #0f5132 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .card-header-custom::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(184,154,107,0.15) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        .logo-icon {
            font-size: 3.5rem;
            color: #D4B88C;
            margin-bottom: 1rem;
            display: inline-block;
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .institution-name {
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        
        .system-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        .system-subtitle {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 0.5rem;
        }
        
        /* Body Content */
        .card-body-custom {
            padding: 2.5rem;
        }
        
        /* Form Styles */
        .input-group-custom {
            margin-bottom: 1.5rem;
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #B89A6B;
            font-size: 1.1rem;
            z-index: 10;
            transition: all 0.3s ease;
        }
        
        .form-control-custom {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.75rem;
            font-size: 0.95rem;
            font-weight: 500;
            border: 2px solid #E8E0D4;
            border-radius: 16px;
            background: white;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }
        
        .form-control-custom:focus {
            outline: none;
            border-color: #B89A6B;
            box-shadow: 0 0 0 4px rgba(184, 154, 107, 0.1);
        }
        
        .form-control-custom::placeholder {
            color: #ADADAD;
            font-weight: 400;
        }
        
        /* Error Messages */
        .error-message {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            animation: shake 0.3s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .error-message i {
            font-size: 0.9rem;
        }
        
        .error-username {
            background: #FFF5F5;
            color: #DC3545;
            border-left: 3px solid #DC3545;
        }
        
        .error-password {
            background: #FFF5F5;
            color: #DC3545;
            border-left: 3px solid #DC3545;
        }
        
        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 0.875rem;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, #198754 0%, #0f5132 100%);
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 0.5rem;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(107, 30, 44, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        /* Footer Links */
        .login-footer {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #E8E0D4;
            margin-top: 1rem;
        }
        
        .footer-text {
            font-size: 0.75rem;
            color: #8B8B8B;
        }
        
        .footer-text a {
            color: #8B2C3E;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .footer-text a:hover {
            color: #B89A6B;
        }
        
        /* Stats Section */
        .stats-section {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            animation: fadeInUp 0.6s ease-out 0.2s backwards;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 800;
            color: #096b30;
            display: block;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.7rem;
            color: #8B8B8B;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .card-header-custom {
                padding: 1.5rem;
            }
            
            .card-body-custom {
                padding: 1.5rem;
            }
            
            .system-title {
                font-size: 1.25rem;
            }
            
            .logo-icon {
                font-size: 2.5rem;
            }
            
            .stats-section {
                gap: 1rem;
            }
            
            .stat-number {
                font-size: 1.25rem;
            }
            
            body::before {
                background-size: 50% auto;
            }
        }
        
        /* Tablet Responsive */
        @media (min-width: 768px) and (max-width: 1024px) {
            body::before {
                background-size: 40% auto;
            }
        }
        
        /* Loading State */
        .btn-login.loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }
        
        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            border: 2px solid white;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        @keyframes spin {
            to {
                transform: translateY(-50%) rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>
    
    <div class="login-container">
        <div class="login-card">
            <!-- Header Section -->
            <div class="card-header-custom">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="institution-name">
                    TALIBON POLYTECHNIC COLLEGE
                </div>
                <h1 class="system-title">
                    Student Management System
                </h1>
                <div class="system-subtitle">
                    Empowering Education, Enabling Excellence
                </div>
            </div>
            
            <!-- Body Section -->
            <div class="card-body-custom">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="loginForm">
                    <!-- Username Field -->
                    <div class="input-group-custom">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            class="form-control-custom" 
                            id="username" 
                            name="username" 
                            placeholder="Username"
                            autocomplete="off"
                            required
                        />
                    </div>
                    
                    <!-- Username Error -->
                    <?php if ($error['isWrongUsername']) { ?>
                        <div class="error-message error-username">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Invalid username. Please check and try again.</span>
                        </div>
                    <?php } ?>
                    
                    <!-- Password Field -->
                    <div class="input-group-custom">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            class="form-control-custom" 
                            id="password" 
                            name="password" 
                            placeholder="Password"
                            required
                        />
                    </div>
                    
                    <!-- Password Error -->
                    <?php if ($error['isWrongPassword']) { ?>
                        <div class="error-message error-password">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Invalid password. Please try again.</span>
                        </div>
                    <?php } ?>
                    
                    <!-- Login Button -->
                    <button type="submit" class="btn-login" id="loginBtn">
                        <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>
                        Access Dashboard
                    </button>
                </form>
                
                <!-- Stats Section -->
                <div class="stats-section">
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Secure Access</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Availability</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">Real-time</span>
                        <span class="stat-label">Updates</span>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="login-footer">
                    <div class="footer-text">
                        &copy; <?php echo date('Y'); ?> Talibon Polytechnic College | v2.0
                    </div>
                    <div class="footer-text" style="margin-top: 0.5rem;">
                        <i class="fas fa-shield-alt"></i> Protected by advanced security protocols
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="SB_Admin/js/scripts.js"></script>
    
    <script>
        // Loading animation on form submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i> Authenticating...';
        });
        
        // Auto-focus on username field
        document.getElementById('username').focus();
        
        // Add floating label effect (optional)
        const inputs = document.querySelectorAll('.form-control-custom');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
        
        // Prevent multiple submissions
        let submitted = false;
        document.getElementById('loginForm').addEventListener('submit', function() {
            if (submitted) return false;
            submitted = true;
            return true;
        });
    </script>
</body>

</html>