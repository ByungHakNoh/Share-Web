<?php

// 앱에 필요한 config 정보를 저장하는 배열을 반환한다.
return [
    'database' => [
        'connection' => 'mysql:host=127.0.0.1',
        'userName' => 'root',
        'password' => '!qudgkr931123',
        'dbName' => 'fashion_web_database',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING

        ]
    ]
];
