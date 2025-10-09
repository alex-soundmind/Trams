<?php
require 'header.php';

$table = $_GET['table'] ?? '';
$id = $_GET['id'] ?? null;

$stmt = $pdo->query("SELECT * FROM $table LIMIT 1");
$columns = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

$values = [];
if ($id) {
    $pk = $columns[0];
    $stmt = $pdo->prepare("SELECT * FROM $table WHERE $pk = ?");
    $stmt->execute([$id]);
    $values = $stmt->fetch();
}
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

$isLogged = isset($_SESSION['user']);
echo '<h2>' . ($id ? 'Редактировать' : 'Добавить') . ' запись</h2>';
echo '<form method="post" action="save.php">';

foreach ($columns as $col) {
    if ($col === $columns[0]) continue;
    if ($table === 'users' && !$isLogged && $col === 'password') continue;

    $val = $values[$col] ?? '';
    $label = translate($col, $table);

    $type = 'text';
    $attrs = 'required';

    if (strpos($col, 'email') !== false) $type = 'email';
    elseif (strpos($col, 'password') !== false) $type = 'password';
    elseif (in_array($col, ['duration','capacity','seat'])) $type = 'number';
    elseif (in_array($col, ['ticket_price'])) { $type = 'number'; $attrs .= ' step="0.01"'; }
    elseif (strpos($col, 'date') !== false) $type = 'date';
    elseif (strpos($col, 'time') !== false) $type = 'time';

    echo "<label>$label</label>";
    echo "<input type=\"$type\" name=\"" . htmlspecialchars($col) . "\" value=\"" . htmlspecialchars($val) . "\" $attrs>";
}

echo '<input type="hidden" name="table" value="' . htmlspecialchars($table) . '">';
if ($id) echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">';
echo '<input type="submit" value="Сохранить">';
echo '</form>';
?>

<?php require 'footer.php'; ?>