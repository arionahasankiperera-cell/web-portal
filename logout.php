<?php
/**
 * Logout Handler
 * Destroys session and logs user out
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';
require_once __DIR__ . '/includes/functions.php';

initSession();

if (isLoggedIn()) {
    $user_id = getUserId();
    $username = getUserName();
    
    // Log the logout action
    logAudit('User Logout', 'users', $user_id, "User $username logged out");
}

// Destroy session
session_unset();
session_destroy();

// Clear session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirect to login with success message
session_start();
setFlashMessage('You have been successfully logged out.', 'success');
redirect('/login.php');
?>
