<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
$stmt->execute([$email, $password]);
$user = $stmt->fetch();

if ($user) {
$_SESSION['user'] = $user;
header('Location: index.php');
} else {
echo 'Неверные данные.';
}
}
?>

<form method="post">
Email: <input name="email" type="email" required><br>
Пароль: <input name="password" type="password" required><br>
<input type="submit" value="Войти">
</form>