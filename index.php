<?php
require 'config.php';
require 'header.php';

$tables = [
    'subscribers' => 'Трамваи',
    'drivers' => 'Водители',
    'routes' => 'Рейсы',
    'maintenance_teams' => 'Ремонтные бригады',
    'repairs' => 'Ремонты',
    'shifts' => 'Смены',
    'users' => 'Пользователи'
];


$table = $_GET['table'] ?? 'movies';
if (!isset($tables[$table])) die('Неверная таблица.');

$stmt = $pdo->query("SELECT * FROM $table ORDER BY 1");
$data = $stmt->fetchAll();

if (!$data) {
echo '<p>Нет данных в таблице «' . $tables[$table] . '».</p>';
} else {
echo '<h2>' . $tables[$table] . '</h2>';
echo '<table border="1" cellpadding="5"><tr>';
foreach (array_keys($data[0]) as $col) {
echo '<th>' . htmlspecialchars($col) . '</th>';
}
if (isset($_SESSION['user'])) echo '<th>Действия</th>';
echo '</tr>';
foreach ($data as $row) {
echo '<tr>';
foreach ($row as $val) echo '<td>' . htmlspecialchars($val) . '</td>';
if (isset($_SESSION['user'])) {
echo '<td><a href="form.php?table=' . $table . '&id=' . $row[array_keys($row)[0]] . '">Редактировать</a> | ';
echo '<a href="delete.php?table=' . $table . '&id=' . $row[array_keys($row)[0]] . '" onclick="return confirm(\'Удалить запись?\');">Удалить</a></td>';
}
echo '</tr>';
}
echo '</table>';
}

if (isset($_SESSION['user'])) echo '<p><a href="form.php?table=' . $table . '">Добавить запись</a></p>';
?>