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
        // Memo : prepare은 PDO 클래스 메소드이다.
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement;
    }

    public function fetchAllValues($statement)
    {
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertData(String $table, $keyValueData)
    {
        $stringFormat = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($keyValueData)),
            implode(', ', array_values($keyValueData))
        );

        try {

            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute($keyValueData);
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }

        return $stringFormat;
    }
}
