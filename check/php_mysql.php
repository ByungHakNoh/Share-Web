<?php

$host = '127.0.0.1';
$db_name = 'practice';
$user_name = 'root';
$password = '!qudgkr931123';

try {

    $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $user_name, $password);
    echo '성공';
} catch (PDOException $e) {

    die($e->getMessage());
}

echo '<br>';

$mysqli = new mysqli($host, $user_name, $password, $db_name, 3306);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

echo $mysqli->host_info . "\n";
