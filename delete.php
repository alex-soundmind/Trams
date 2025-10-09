<?php
require 'config.php';
if (!isset($_SESSION['user'])) die('Требуется авторизация.');
$table = $_GET['table'];
$id = $_GET['id'];
$stmt = $pdo->query("SELECT * FROM $table LIMIT 1");
$pk = array_keys($stmt->fetch(PDO::FETCH_ASSOC))[0];
$pdo->prepare("DELETE FROM $table WHERE $pk = ?")->execute([$id]);
header('Location: index.php?table=' . $table);
?>