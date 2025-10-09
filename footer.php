</div> <footer>
    <hr>
    <?php
    if (!isset($_SESSION['user']) || !isset($_SESSION['user']['name'])) {
        echo '<a href="login.php">Войти</a> | <a href="register.php">Регистрация</a>';
    } else {
        echo 'Пользователь: <b>' . htmlspecialchars($_SESSION['user']['name']) . '</b> | <a href="logout.php">Выйти</a>';
    }
    ?>
</footer>

</body>
</html>