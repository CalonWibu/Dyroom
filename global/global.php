<?php
session_start();
include 'config/db.php';

$database = new Database();
$conn = $database->getConnection();
?>
