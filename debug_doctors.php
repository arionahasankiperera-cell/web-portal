<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';

try {
    $db = getDB();
    echo "<h2>Doctors Table Structure</h2>";
    $cols = $db->query("DESCRIBE doctors")->fetchAll();
    echo "<pre>" . print_r($cols, true) . "</pre>";
    
    echo "<h2>Doctors Table Data (First 3)</h2>";
    $data = $db->query("SELECT * FROM doctors LIMIT 3")->fetchAll();
    echo "<pre>" . print_r($data, true) . "</pre>";
    
    echo "<h2>Specializations Table Data</h2>";
    $specs = $db->query("SELECT * FROM specializations")->fetchAll();
    echo "<pre>" . print_r($specs, true) . "</pre>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
