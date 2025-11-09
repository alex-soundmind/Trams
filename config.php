<?php
$db   = 'trams';
$host = 'dpg-d4847mbipnbc73d8hlm0-a.singapore-postgres.render.com';
$user = 'user';
$pass = 'RFa4bfOpswyRFBK3cZvaU9okEORsFxYO';

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
