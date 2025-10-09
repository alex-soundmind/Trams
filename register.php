<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)')
->execute([$name, $email, $password]);
header('Location: login.php');
}
?>

<form method="post">
Имя: <input name="name" required><br>
Email: <input name="email" type="email" required><br>
Пароль: <input name="password" type="password" required><br>
<input type="submit" value="Зарегистрироваться">
</form>