<?php
$host = 'dpg-d3j56rali9vc73dorfng-a.singapore-postgres.render.com';
$db   = 'trams';
$user = 'user';
$pass = '0urzMvp0cvo7Oi7D2CzXEorPHYfQOwZc';

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
