<?php
include 'includes/db.php';
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT user_id, username, password_hash, role, first_name, last_name, status FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                if ($user['status'] !== 'active') {
                    $error = "Your account is " . $user['status'] . ". Please contact support.";
                } else {
                    // Login Success
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['name'] = $user['first_name'] . ' ' . $user['last_name'];

                    // Redirect based on role
                    switch ($user['role']) {
                        case 'admin':
                            header("Location: admin/index.php");
                            break;
                        case 'doctor':
                            header("Location: doctor/index.php");
                            break;
                        case 'receptionist':
                            header("Location: receptionist/index.php");
                            break;
                        case 'patient':
                        default:
                            header("Location: patient/index.php");
                            break;
                    }
                    exit();
                }
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with that email/username.";
        }
        $stmt->close();
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 80px - 300px); padding: 4rem 0;">
    <div class="card" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <h2 style="color: var(--primary);">Welcome Back</h2>
            <p>Login to access your dashboard</p>
        </div>

        <?php if($error): ?>
            <div style="background-color: #FEE2E2; color: #991B1B; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="email" class="form-label">Email or Username</label>
                <input type="text" id="email" name="email" class="form-control" required placeholder="Enter your email">
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>

        <div class="text-center mt-4">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
