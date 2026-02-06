<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';

try {
    $db = getDB();
    echo "<h2>Appointments Table Structure</h2>";
    $cols = $db->query("DESCRIBE appointments")->fetchAll();
    echo "<pre>" . print_r($cols, true) . "</pre>";
    
    echo "<h2>Appointments Table Data (First 3)</h2>";
    $data = $db->query("SELECT * FROM appointments LIMIT 3")->fetchAll();
    echo "<pre>" . print_r($data, true) . "</pre>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
