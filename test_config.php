<?php
require_once __DIR__ . '/config/config.php';
echo "<h1>Configuration Test</h1>";
echo "<p><strong>APP_URL:</strong> " . APP_URL . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";
echo "<p><strong>Expected CSS Path:</strong> " . APP_URL . "assets/css/style.css</p>";
?>
