<?php
require_once 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$name, $email, $password]);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Регистрация</title>
</head>
<body>
<h2>Регистрация</h2>
<form method="post">
    <label>Имя</label><input name="name" required>
    <label>Email</label><input name="email" type="email" required>
    <label>Пароль</label><input name="password" type="password" required>
    <input type="submit" value="Зарегистрироваться">
</form>
</body>
</html>
