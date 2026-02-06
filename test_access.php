<?php
echo "<h1>✅ Apache and PHP are working!</h1>";
echo "<p>Current directory: " . __DIR__ . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Time: " . date('Y-m-d H:i:s') . "</p>";

echo "<hr>";
echo "<h2>Test Links:</h2>";
echo "<ul>";
echo "<li><a href='http://localhost/WDD/index.php'>Main Homepage (index.php)</a></li>";
echo "<li><a href='http://localhost/WDD/login.php'>Login Page</a></li>";
echo "<li><a href='http://localhost/WDD/admin/debug_admin.php'>Debug Admin Page</a></li>";
echo "<li><a href='http://localhost/WDD/admin/add_doctor.php'>Add Doctor Page</a></li>";
echo "<li><a href='http://localhost/WDD/admin/dashboard.php'>Admin Dashboard</a></li>";
echo "</ul>";

echo "<hr>";
echo "<h2>File Existence Check:</h2>";
$files = [
    'index.php',
    'login.php',
    'admin/dashboard.php',
    'admin/add_doctor.php',
    'admin/debug_admin.php',
    'config/config.php'
];

echo "<ul>";
foreach ($files as $file) {
    $exists = file_exists(__DIR__ . '/' . $file);
    echo "<li>" . ($exists ? "✅" : "❌") . " $file</li>";
}
echo "</ul>";
?>
