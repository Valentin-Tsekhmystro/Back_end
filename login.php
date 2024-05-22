<?php
$config = require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: guestbook.php');
        exit;
    } else {
        $error = 'Неправильний email або пароль';
    }

    mysqli_close($db);
}
?>
