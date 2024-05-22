<?php
$config = require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Користувач з таким email вже існує
        $error = 'Користувач з таким email вже зареєстрований';
    } else {
        // Реєстрація нового користувача
        $query = "INSERT INTO users (email, password, date) VALUES ('$email', '$password', CURRENT_TIMESTAMP)";
        mysqli_query($db, $query);
        header('Location: login.php');
        exit;
    }

    mysqli_close($db);
}
?>
