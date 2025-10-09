<?php
require_once 'config.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && $password === $user['password']) {
        $_SESSION['user'] = $user;
        header('Location: index.php?table=trams');
        exit;
    } else {
        $error_message = '<p class="error">Неверный email или пароль</p>';
    }
}

require 'header.php';

if ($error_message) {
    echo $error_message;
}
?>

<h2>Вход</h2>
<form method="post">
    <label>Email</label><input name="email" type="email" required>
    <label>Пароль</label><input name="password" type="password" required>
    <input type="submit" value="Войти">
</form>

<?php require 'footer.php'; ?>