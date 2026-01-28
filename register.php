<?php
include 'includes/db.php';
session_start();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $phone = trim($_POST['phone']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    
    // Basic validations
    if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($password)) {
        $error = "Please fill in all required fields.";
    } else {
        // Hash password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        // Start Transaction
        $conn->begin_transaction();
        
        try {
            // 1. Insert into users table
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role, first_name, last_name, phone, date_of_birth, gender, address, status) VALUES (?, ?, ?, 'patient', ?, ?, ?, ?, ?, ?, 'active')");
            $stmt->bind_param("sssssssss", $username, $email, $passwordHash, $firstName, $lastName, $phone, $dob, $gender, $address);
            
            if (!$stmt->execute()) {
                throw new Exception("Error creating user account: " . $stmt->error);
            }
            $userId = $conn->insert_id;
            $stmt->close();
            
            // 2. Generate Patient Code (PAT + leading zeros)
            $patientCode = 'PAT' . str_pad($userId, 3, '0', STR_PAD_LEFT);
            
            // 3. Insert into patients table
            $stmt = $conn->prepare("INSERT INTO patients (user_id, patient_code, blood_group) VALUES (?, ?, NULL)");
            $stmt->bind_param("is", $userId, $patientCode);
            
            if (!$stmt->execute()) {
                throw new Exception("Error creating patient profile: " . $stmt->error);
            }
            $stmt->close();
            
            // Commit
            $conn->commit();
            $success = "Registration successful! You can now <a href='login.php'>Login</a>.";
            
        } catch (Exception $e) {
            $conn->rollback();
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                $error = "Username or Email already exists.";
            } else {
                $error = $e->getMessage();
            }
        }
    }
}
?>

<?php include 'includes/header.php'; ?>

<div class="container" style="padding: 4rem 1.5rem;">
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <div class="text-center mb-4">
            <h2 style="color: var(--primary);">Patient Registration</h2>
            <p>Create your account to book appointments and view medical reports</p>
        </div>

        <?php if($error): ?>
            <div style="background-color: #FEE2E2; color: #991B1B; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if($success): ?>
            <div style="background-color: #D1FAE5; color: #065F46; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem;">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="grid-3" style="grid-template-columns: 1fr 1fr; gap: 1.5rem; margin: 0;">
                
                <div class="form-group">
                    <label class="form-label">First Name *</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Last Name *</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="dob" class="form-control">
                </div>

                <div class="form-group">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="other">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" required placeholder="Minimum 6 characters">
                </div>
            </div>

            <div class="form-group mt-4">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-4" style="width: 100%;">Register Account</button>
        </form>
        
        <div class="text-center mt-4">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
