<?php
/**
 * Debug Login - Check what credentials work
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';
require_once __DIR__ . '/includes/functions.php';

echo "<h1>Login Debug - Available Accounts</h1>";

try {
    $db = getDB();
    echo "<p>✅ Database connected</p>";
    
    // Get all users
    $stmt = $db->query("SELECT id, first_name, last_name, email, password, role, status FROM users ORDER BY role, id");
    $users = $stmt->fetchAll();
    
    echo "<h2>Available User Accounts:</h2>";
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #f0f0f0;'>";
    echo "<th>ID</th><th>Name</th><th>Email (Login)</th><th>Password</th><th>Role</th><th>Status</th><th>Action</th>";
    echo "</tr>";
    
    foreach ($users as $user) {
        $rowColor = $user['role'] === 'ADMIN' ? 'background: #e3f2fd;' : '';
        echo "<tr style='$rowColor'>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) . "</td>";
        echo "<td><strong>" . htmlspecialchars($user['email']) . "</strong></td>";
        echo "<td><code>" . htmlspecialchars($user['password']) . "</code></td>";
        echo "<td><span style='padding: 4px 8px; background: ";
        
        switch($user['role']) {
            case 'ADMIN': echo '#f44336'; break;
            case 'DOCTOR': echo '#2196F3'; break;
            case 'STAFF': echo '#4CAF50'; break;
            case 'PATIENT': echo '#FF9800'; break;
        }
        
        echo "; color: white; border-radius: 4px;'>" . $user['role'] . "</span></td>";
        echo "<td>" . $user['status'] . "</td>";
        echo "<td><button onclick=\"fillLogin('" . htmlspecialchars($user['email']) . "', '" . htmlspecialchars($user['password']) . "')\">Use →</button></td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
    echo "<hr>";
    echo "<h2>Quick Login Test</h2>";
    echo "<form method='POST' action='login.php' style='max-width: 500px; padding: 20px; border: 1px solid #ddd; border-radius: 8px;'>";
    echo "<div style='margin-bottom: 15px;'>";
    echo "<label><strong>Email Address:</strong></label><br>";
    echo "<input type='text' id='test_username' name='username' required style='width: 100%; padding: 8px; font-size: 14px;' placeholder='admin1@healthylife.lk'>";
    echo "</div>";
    
    echo "<div style='margin-bottom: 15px;'>";
    echo "<label><strong>Password:</strong></label><br>";
    echo "<input type='password' id='test_password' name='password' required style='width: 100%; padding: 8px; font-size: 14px;' placeholder='Admin@123'>";
    echo "<small style='color: #666;'>Passwords from table above</small>";
    echo "</div>";
    
    echo "<button type='submit' style='padding: 10px 20px; background: #2196F3; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;'>Test Login →</button>";
    echo "</form>";
    
    echo "<script>";
    echo "function fillLogin(email, password) {";
    echo "  document.getElementById('test_username').value = email;";
    echo "  document.getElementById('test_password').value = password;";
    echo "  alert('Filled! Email: ' + email + ', Password: ' + password);";
    echo "}";
    echo "</script>";
    
    echo "<hr>";
    echo "<h3>Important Notes:</h3>";
    echo "<ul>";
    echo "<li>⚠ The login form says 'Username' but it actually expects an <strong>EMAIL ADDRESS</strong></li>";
    echo "<li>⚠ Passwords are stored in <strong>PLAIN TEXT</strong> (security issue!)</li>";
    echo "<li>✅ Use the email addresses from the table above, not usernames</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
