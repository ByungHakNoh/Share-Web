<?php

return [
    'database' => [
        'connection' => 'mysql:host=127.0.0.1',
        'userName' => 'root',
        'password' => '!qudgkr931123',
        'dbName' => 'practice',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING

        ]
    ]
];