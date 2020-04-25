<?php

class QueryBuilder
{

    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectTable(String $table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement;
    }

    public function fetchAllValues($statement)
    {
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
}