<?php

namespace core\database;

use PDO;
use FFI\Exception;

class QueryBuilder
{

    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // 테이블을 선택하는 메소드 
    public function selectTable(String $table)
    {
        // Memo : prepare은 PDO 클래스 메소드이다.
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement;
    }

    public function fetchAllByArray($statement)
    {
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    // selectTable 메소드를 실행 후 모든 값들을 쿼리하는 메소드 
    public function fetchAllValues($statement, $dataClass)
    {

        return $statement->fetchAll(PDO::FETCH_CLASS, $dataClass);
    }

    // 제한된 개수만을 쿼리하는 메소드
    public function fetchLimitedValues($table, $columnName, $order, $startNumber, $endNumber, $dataClass)
    {
        $statement = $this->pdo->prepare("select * from {$table} order by {$columnName} {$order} limit {$startNumber}, {$endNumber}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, $dataClass);
    }

    public function fetchLimitedArray($table, $columnName, $order, $startNumber, $endNumber)
    {
        $statement = $this->pdo->prepare("select * from {$table} order by {$columnName} {$order} limit {$startNumber}, {$endNumber}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    // 특정 id 값을 선택하여 쿼리하는 메소드
    public function fetchValueByID($table, $requestID, $dataClass)
    {
        $statement = $this->pdo->prepare("select * from {$table} where id={$requestID}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, $dataClass);
    }

    public function fetchLoginData($tableName, $userID, $password, $dataClass)
    {
        $statement = $this->pdo->prepare("select * from {$tableName} where user_id='{$userID}' and password='{$password}'");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, $dataClass);
    }

    // 사용자 key 와 value로 db 검색후 데이터 쿼리하는 메소드
    public function fetchValueByName($tableName, $keyValueData, $dataClass)
    {
        $stringFormat = sprintf(
            'select * from %s where %s=%s',
            $tableName,
            implode(', ', array_keys($keyValueData)),
            implode(', ', array_values($keyValueData))
        );

        try {

            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute();
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }

        return $statement->fetchAll(PDO::FETCH_CLASS, $dataClass);
    }

    public function fetchArrayByName($tableName, $keyValueData)
    {
        $stringFormat = sprintf(
            'select * from %s where %s=%s',
            $tableName,
            implode(', ', array_keys($keyValueData)),
            implode(', ', array_values($keyValueData))
        );

        try {

            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute();
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    // 테이블에 데이터를 저장하는 메소드
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

    public function updateByName($tableName, $columnKeyValue, $keyValueData)
    {
        $stringFormat = sprintf(
            'update %s set %s = %s where %s=%s',
            $tableName,
            implode(', ', array_keys($keyValueData)),
            implode(', ', array_values($keyValueData)),
            implode(', ', array_keys($columnKeyValue)),
            implode(', ', array_values($columnKeyValue))
        );

        try {

            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute();
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }
    }

    // 수정이 필요할 것 같음... 좀 더 활용성 있게;
    public function updateByID($tableName, $requestID, $keyValueData)
    {
        $stringFormat = sprintf(
            'update %s set %s = %s where id=%s',
            $tableName,
            implode(', ', array_keys($keyValueData)),
            implode(', ', array_values($keyValueData)),
            $requestID
        );

        try {

            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute();
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }
    }

    public function updateBrand($tableName, $requestID, $keyValueData)
    {
        $stringFormat = sprintf(
            'update %s set average_rate=%s, total_votes=%s where id=%s',
            $tableName,
            $keyValueData['averageRate'],
            $keyValueData['totalVotes'],
            $requestID
        );

        try {
            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute();
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }
    }

    public function updateBoardScript($tableName, $requestID, $keyValueData)
    {
        $stringFormat = sprintf(
            'update %s set title=%s, content=%s where id=%s',
            $tableName,
            $keyValueData['title'],
            $keyValueData['content'],
            $requestID
        );

        try {
            $statement = $this->pdo->prepare($stringFormat);
            $statement->execute();
        } catch (Exception $th) {

            die('데이터 베이스 관련 에러 발생');
        }
    }

    public function deleteByID($tableName, $requestID)
    {
        $statement = $this->pdo->prepare("delete from {$tableName} where id = {$requestID}");
        $statement->execute();
    }

    public function deleteByColumn($tableName, $columnName, $value)
    {

        $statement = $this->pdo->prepare("delete from {$tableName} where {$columnName} = {$value}");
        $statement->execute();
    }

    // 페이지의 갯수를 결정하는 메소드
    public function paginationPageNum($tableName, $resultPerPage)
    {
        // 자유 계시판 계시글 전체 갯수를 받아온다.
        $totalRowCount = $this->selectTable($tableName)->rowCount();
        // 페이지의 갯수 선언
        return ceil($totalRowCount / $resultPerPage);
    }

    // 한 페이지에 보여줄 데이터를 쿼리하는 메소드
    public function pagination($tableName, $dataClass, $currentPage, $valuesPerPage)
    {
        // 데이터 저장소에서 계시판 정보 불러와야함
        $startNumber = ($currentPage - 1) * $valuesPerPage;

        return $this->fetchLimitedValues($tableName, 'id', 'desc', $startNumber, $valuesPerPage, $dataClass);
    }
}
