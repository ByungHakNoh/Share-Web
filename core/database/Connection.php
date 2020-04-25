<?php

class Connection
{
    public static function connect_db($config)
    {
        try {

            return $pdo = new PDO(
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