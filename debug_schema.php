<?php
require_once __DIR__ . '/config/db_connect.php';
$db = getDB();

echo "--- DOCTOR_SCHEDULE SCHEMA ---\n";
$stmt = $db->query("DESCRIBE doctor_schedule");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}

echo "\n--- APPOINTMENTS SCHEMA ---\n";
$stmt = $db->query("DESCRIBE appointments");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}

echo "\n--- DOCTORS SCHEMA ---\n";
$stmt = $db->query("DESCRIBE doctors");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}

echo "\n--- USERS SCHEMA ---\n";
$stmt = $db->query("DESCRIBE users");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
?>
