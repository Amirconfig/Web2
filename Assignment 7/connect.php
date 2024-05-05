<?php
require_once('info.php');

try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
} catch (Exception $e) {
    die('Could not connect to DB: ' . $e->getMessage());
}
?>
