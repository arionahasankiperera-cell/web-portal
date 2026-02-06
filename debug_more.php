<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';

try {
    $db = getDB();
    foreach (['medical_reports', 'billing'] as $table) {
        echo "<h3>Table: $table</h3>";
        $cols = $db->query("DESCRIBE $table")->fetchAll();
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        foreach ($cols as $col) {
            echo "<tr>";
            foreach ($col as $val) echo "<td>$val</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        $data = $db->query("SELECT * FROM $table LIMIT 3")->fetchAll();
        echo "<pre>" . print_r($data, true) . "</pre>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
