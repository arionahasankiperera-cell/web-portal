<?php
/**
 * Login Page
 * Handles user authentication for all roles
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';
require_once __DIR__ . '/includes/functions.php';

initSession();

// Redirect if already logged in
if (isLoggedIn()) {
    $role = strtoupper(getUserRole());
    switch ($role) {
        case 'ADMIN':
            redirect('/admin/dashboard.php');
            break;
        case 'DOCTOR':
            redirect('/doctor/dashboard.php');
            break;
        case 'STAFF':
            redirect('/staff/dashboard.php');
            break;
        case 'PATIENT':
            redirect('/patient/dashboard.php');
            break;
    }
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        try {
            $db = getDB();
            $stmt = $db->prepare("
                SELECT id, first_name, last_name, email, password, role, status
                FROM users
                WHERE email = ? AND status = 'ACTIVE'
            ");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            // Check both hashed and plain text (for demo accounts)
            $authenticated = false;
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $authenticated = true;
                } elseif ($password === $user['password']) {
                    $authenticated = true;
                }
            }
            
            if ($authenticated) {
                // Password correct, create session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
                
                // Get user's full name based on role
                $name = $username;
                // Log the action
                logAudit('User Login', 'users', $user['id'], 'User logged in successfully');
                
                // Redirect based on role
                $redirect_url = $_SESSION['redirect_url'] ?? null;
                unset($_SESSION['redirect_url']);
                
                if ($redirect_url) {
                    redirect($redirect_url);
                } else {
                    $role = strtoupper($user['role']);
                    switch ($role) {
                        case 'ADMIN':
                            redirect('/admin/dashboard.php');
                            break;
                        case 'DOCTOR':
                            redirect('/doctor/dashboard.php');
                            break;
                        case 'STAFF':
                            redirect('/staff/dashboard.php');
                            break;
                        case 'PATIENT':
                            redirect('/patient/dashboard.php');
                            break;
                    }
                }
            } else {
                $error = 'Invalid username or password';
                logAudit('Failed Login Attempt', 'users', null, "Failed login for: $username");
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            $error = 'An error occurred. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>assets/css/style.css">
</head>
<body class="login-page">
    <div class="login-wrapper">
        <!-- Left Side: Login Form -->
        <div class="login-panel">
            <div class="logo-container mb-4">
                <a href="<?php echo APP_URL; ?>public/index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <img src="<?php echo APP_URL; ?>assets/images/logo.png" alt="HealthyLife Hospital" style="height: 40px;">
                    <span style="font-size: 1.25rem; font-weight: 800; color: var(--secondary);">HealthyLife</span>
                </a>
            </div>
            
            <div class="login-content">
                <h1>Welcome Back</h1>
                <p class="subtitle">Please login to access your dashboard</p>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="ri-error-warning-line"></i>
                        <?php echo e($error); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($flash = getFlashMessage()): ?>
                    <div class="alert alert-<?php echo e($flash['type']); ?>">
                        <?php echo e($flash['message']); ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="" class="login-form">
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" id="username" name="username" class="form-control"
                               value="<?php echo e($_POST['username'] ?? ''); ?>" 
                               required autofocus placeholder="Enter your username">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <label class="checkbox-container" style="display: flex; gap: 0.5rem; align-items: center; font-size: 0.9rem;">
                            <input type="checkbox" name="remember"> Remember me
                        </label>
                        <a href="#" style="font-size: 0.9rem;">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                    </button>
                </form>
                
                <div class="login-footer">
                    <p>Don't have an account? <a href="<?php echo APP_URL; ?>public/contact.php">Contact Administration</a></p>
                </div>

                <div class="demo-credentials mt-4" style="background: #F8FAFC; padding: 1rem; border-radius: var(--radius-md); font-size: 0.85rem;">
                    <h5 style="margin-bottom: 0.5rem;">Demo Credentials:</h5>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 0.5rem;">
                        <div><strong>Admin:</strong> admin1@healthylife.lk / Admin@123</div>
                        <div><strong>Doctor:</strong> dr.silva@healthylife.lk / Doctor@123</div>
                        <div><strong>Staff:</strong> reception@healthylife.lk / Staff@123</div>
                        <div><strong>Patient:</strong> patient1@healthylife.lk / Patient@123</div>
                        <div style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.5rem;">
                            ⚠ Note: Use EMAIL address, not username
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side: Image/Brand -->
        <div class="image-panel">
            <div class="image-overlay">
                <div>
                    <h2 class="text-white">World Class Healthcare</h2>
                    <p class="text-white-opacity">Advanced medical technology and expert care you can trust.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
