<?php
include 'config.php';
try {
    $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT,DB_USER,DB_PASS);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch (Exception $e) {
    echo "Could not conjhhnect to the database." . $e;
    exit;
}