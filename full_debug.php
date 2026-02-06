<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/db_connect.php';

try {
    $db = getDB();
    $tables = $db->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        echo "<h3>Table: $table</h3>";
        $cols = $db->query("DESCRIBE `$table`")->fetchAll();
        echo "<table border='1'><tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
        foreach ($cols as $col) {
            echo "<tr>";
            foreach ($col as $val) echo "<td>$val</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
