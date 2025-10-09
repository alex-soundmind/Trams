<?php
if (!isset($_SESSION['user'])) {
echo '<a href="login.php">Войти</a> | <a href="register.php">Регистрация</a>';
} else {
echo 'Пользователь: ' . htmlspecialchars($_SESSION['user']['name']) . ' | <a href="logout.php">Выйти</a>';
}
?>
<hr>
<a href="index.php?table=subscribers">Трамваи</a> |
<a href="index.php?table=drivers">Водители</a> |
<a href="index.php?table=routes">Рейсы</a> |
<a href="index.php?table=maintenance_teams">Ремонтные бригады</a> |
<a href="index.php?table=repairs">Ремонты</a> |
<a href="index.php?table=shifts">Смены</a> |
<a href="index.php?table=users">Пользователи</a>
<hr>