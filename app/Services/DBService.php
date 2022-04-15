<?php

namespace App\Services;

use PDO;

class DBService
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO($_ENV['DATABASE'].':host='.$_ENV['DATABASE_HOST'].';dbname='.$_ENV['DATABASE_NAME'].';charset='.$_ENV['DATABASE_CHARSET'],$_ENV['DATABASE_USERNAME'], $_ENV['DATABASE_PASSWORD']);
    }

    public function insertMulti(string $table, array $fields , array $values)
    {

        $fieldsForQuery = implode(', ',$fields);
        $valuesForQuery = implode(',', array_fill(0, count($fields), '?'));

        $stmt = $this->pdo->prepare("INSERT INTO {$table} ($fieldsForQuery) VALUES ($valuesForQuery)");
        try {
            $this->pdo->beginTransaction();
            foreach ($values as $row) {
                $stmt->execute($row);
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollback();
            throw $e;
        }
    }


}