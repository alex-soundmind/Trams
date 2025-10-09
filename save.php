<?php
require 'config.php';
if (!isset($_SESSION['user'])) die('Требуется авторизация.');

$table = $_POST['table'];
$id = $_POST['id'] ?? null;
$stmt = $pdo->query("SELECT * FROM $table LIMIT 1");
$columns = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

$data = [];
foreach ($columns as $col) {
if ($col === $columns[0] && !$id) continue;
if (isset($_POST[$col])) $data[$col] = $_POST[$col];
}

if ($id) {
$set = implode(', ', array_map(fn($k) => "$k = ?", array_keys($data)));
$query = "UPDATE $table SET $set WHERE {$columns[0]} = ?";
$pdo->prepare($query)->execute([...array_values($data), $id]);
} else {
$cols = implode(', ', array_keys($data));
$vals = implode(', ', array_fill(0, count($data), '?'));
$pdo->prepare("INSERT INTO $table ($cols) VALUES ($vals)")->execute(array_values($data));
}

header('Location: index.php?table=' . $table);
?>