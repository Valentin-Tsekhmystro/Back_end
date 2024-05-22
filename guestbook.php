<?php
$config = require_once 'config.php';

$db = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);
$query = "INSERT INTO comments";
mysqli_query($db, $query);
mysqli_close($db);

$db = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);
$query = 'SELECT * FROM comments';
$result = mysqli_query($db, $query);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($db);

foreach ($comments as $comment) {
    echo $comment['name'] . '<br>';
    echo $comment['email'] . '<br>';
    echo $comment['text'] . '<br>';
    echo $comment['date'] . '<hr>';
}