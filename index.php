<?php
require 'header.php';

$tables = [
    'trams' => 'Трамваи',
    'drivers' => 'Водители',
    'routes' => 'Рейсы',
    'maintenance_teams' => 'Ремонтные бригады',
    'repairs' => 'Ремонты',
    'shifts' => 'Смены',
    'users' => 'Пользователи'
];

$table = $_GET['table'] ?? 'trams';
if (!isset($tables[$table])) die('<p class="error">Неверная таблица</p>');

$stmt = $pdo->query("SELECT * FROM $table ORDER BY 1");
$data = $stmt->fetchAll();

function translate($column) {
    $map = [
        // Таблица: Трамваи
        'tram_id' => 'ID трамвая',
        'model' => 'Модель',
        'capacity' => 'Вместимость',
        'manufacture_year' => 'Год выпуска',

        // Таблица: Водители (Drivers)
        'driver_id' => 'ID водителя',
        'full_name' => 'ФИО',
        'birth_date' => 'Дата рождения',
        'license_number' => 'Номер лицензии',

        // Таблица: Рейсы (Routes)
        'route_id' => 'ID рейса',
        'departure_time' => 'Время отправления',
        'arrival_time' => 'Время прибытия',
        'start_point' => 'Начальный пункт',
        'end_point' => 'Конечный пункт',

        // Таблица: Ремонтные бригады (Maintenance_Teams)
        'team_id' => 'ID бригады',
        'team_name' => 'Название бригады',
        'supervisor_name' => 'Имя руководителя',

        // Таблица: Ремонты (Repairs)
        'repair_id' => 'ID ремонта',
        'repair_date' => 'Дата ремонта',
        'issue_description' => 'Описание проблемы',
        'status' => 'Статус',

        // Таблица: Смены (Shifts)
        'shift_id' => 'ID смены',
        'shift_date' => 'Дата смены',
        'shift_start' => 'Начало смены',
        'shift_end' => 'Окончание смены',

        'user_id' => 'ID пользователя',
        'name' => 'ФИО',
        'email' => 'E-mail',
        'password' => 'Пароль',
    ];
    return $map[$column] ?? $column;
}

echo '<h2>' . $tables[$table] . '</h2>';
if (!$data) {
    echo '<p>Нет данных.</p>';
} else {
    echo '<table><tr>';
    foreach (array_keys($data[0]) as $col) {
        if ($col === 'password' && $table === 'users' && !isset($_SESSION['user'])) continue;
        echo '<th>' . translate($col, $table) . '</th>';
    }
    if (isset($_SESSION['user'])) echo '<th>Действия</th>';
    echo '</tr>';

foreach ($data as $row) {
echo '<tr>';
foreach ($row as $val) echo '<td>' . htmlspecialchars($val) . '</td>';
if (isset($_SESSION['user'])) {
$pk = array_keys($row)[0];
echo '<td><a href="form.php?table=' . $table . '&id=' . $row[$pk] . '">Редактировать</a> | ';
echo '<a href="delete.php?table=' . $table . '&id=' . $row[$pk] . '" onclick="return confirm(\'Удалить запись?\');">Удалить</a></td>';
}
echo '</tr>';
}
echo '</table>';
}
if (isset($_SESSION['user'])) echo '<br><a href="form.php?table=' . $table . '"><button>Добавить запись</button></a>';
?>

<?php require 'footer.php'; ?>