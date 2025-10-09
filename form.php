<?php
require 'config.php';
require 'header.php';

if (!isset($_SESSION['user'])) die('Требуется авторизация.');

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? null;

$stmt = $pdo->query("SELECT * FROM $table LIMIT 1");
$columns = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

$values = [];
if ($id) {
$stmt = $pdo->prepare("SELECT * FROM $table WHERE {$columns[0]} = ?");
$stmt->execute([$id]);
$values = $stmt->fetch();
}

echo '<h2>' . ($id ? 'Редактировать' : 'Добавить') . ' запись в таблицу «' . $table . '»</h2>';
echo '<form method="post" action="save.php">';
foreach ($columns as $col) {
if ($col === $columns[0] && $id === null) continue;
$val = $values[$col] ?? '';
echo '<label>' . htmlspecialchars($col) . ': <input name="' . htmlspecialchars($col) . '" value="' . htmlspecialchars($val) . '" required></label><br>';
}
echo '<input type="hidden" name="table" value="' . htmlspecialchars($table) . '">';
if ($id) echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">';
echo '<input type="submit" value="Сохранить">';
echo '</form>';
?>