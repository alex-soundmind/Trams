<?php
$db   = 'trams_db';
$host = 'dpg-d4v9dk3e5dus73a9raig-a.singapore-postgres.render.com';
$user = 'trams_db_user';
$pass = 'Gbj0c9Akmi32On4MsJWjH4dLkUCnp31t';

$dsn = "pgsql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $pdo->exec("SET NAMES 'UTF8'");
} catch (PDOException $e) {
    die('Ошибка подключения к базе данных: ' . $e->getMessage());
}

session_start();
?>
