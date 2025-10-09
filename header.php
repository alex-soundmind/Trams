<?php
require_once 'config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>Трамвайное депо</title>
</head>
<body>
<header>
<?php
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['name_user'])) {
    echo '<a href="login.php">Войти</a> | <a href="register.php">Регистрация</a>';
} else {
    echo 'Пользователь: <b>' . htmlspecialchars($_SESSION['user']['name_user']) . '</b> | <a href="logout.php">Выйти</a>';
}
?>
<nav>
<a href="index.php?table=trams">Трамваи</a> |
<a href="index.php?table=drivers">Водители</a> |
<a href="index.php?table=routes">Рейсы</a> |
<a href="index.php?table=maintenance_teams">Ремонтные бригады</a> |
<a href="index.php?table=repairs">Ремонты</a> |
<a href="index.php?table=shifts">Смены</a> |
<a href="index.php?table=users">Пользователи</a>
</nav>
</header>
<div class="container">