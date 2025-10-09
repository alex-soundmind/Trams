<?php
require 'header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)')->execute([$name, $email, $password]);
header('Location: login.php');
}
?>
<h2>Регистрация</h2>
<form method="post">
<label>Имя</label><input name="name" required>
<label>Email</label><input name="email" type="email" required>
<label>Пароль</label><input name="password" type="password" required>
<input type="submit" value="Зарегистрироваться">
</form>

<?php require 'footer.php'; ?>