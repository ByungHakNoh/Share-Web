<?php

namespace core\database;

use PDO;
use PDOException;

class Connection
{
    public static function connectDB($config)
    {
        try {

            return new PDO(
                $config['connection'] . ';dbname=' . $config['dbName'],
                $config['userName'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }
}