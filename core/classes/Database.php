<?php

namespace core\classes;

use core\exception\CustomException;
use PDO;
use PDOException;

class Database
{

    private PDO|null $binding;

    /**
     * @throws CustomException
     */
    public function delete(string $sql, ?array $parameters = null): bool
    {
        if (!preg_match('/^DELETE/i', $sql)) {
            throw new CustomException('Database - It\'s not a delete statement');
        }
        $this->connect();
        try {
            $execute = $this->binding->prepare($sql);
            $this->disconnect();
            if (!empty($parameters)) {
                return $execute->execute($parameters);
            }
            return $execute->execute();
        } catch (PDOException $exception) {
            $this->disconnect();
            return false;
        }
    }

    private function connect(): void
    {
        $this->binding = new PDO(
            'mysql:' .
            'host=' . MYSQL_SERVER . ';' .
            'dbname=' . MYSQL_DATABASE . ';' .
            'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASSWORD,
            array(PDO::ATTR_PERSISTENT => true)
        );
        $this->binding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    private function disconnect(): void
    {
        $this->binding = null;
    }

    /**
     * @throws CustomException
     */
    public function insert(string $sql, ?array $parameters = null): bool
    {
        $sql = trim($sql);
        if (!preg_match('/^INSERT/i', $sql)) {
            throw new CustomException('Database - It\'s not a insert statement');
        }
        $this->connect();
        try {
            $execute = $this->binding->prepare($sql);
            $this->disconnect();
            if (!empty($parameters)) {
                return $execute->execute($parameters);
            }
            return $execute->execute();
        } catch (PDOException $exception) {
            $this->disconnect();
            return false;
        }
    }

    /**
     * @throws CustomException
     */
    public function select(string $sql, ?array $parameters = null): bool|array
    {
        $sql = trim($sql);
        if (!preg_match('/^SELECT/i', $sql)) {
            throw new CustomException('Database - It\'s not a select statement');
        }
        $this->connect();
        try {
            $execute = $this->binding->prepare($sql);
            if (!empty($parameters)) {
                $execute->execute($parameters);
            } else {
                $execute->execute();
            }
            $this->disconnect();
            return $execute->fetchAll(PDO::FETCH_CLASS);
        } catch (PDOException $exception) {
            $this->disconnect();
            return false;
        }
    }

    /**
     * @throws CustomException
     */
    public function statement(string $sql, ?array $parameters = null): bool
    {
        $sql = trim($sql);
        if (preg_match('/^(SELECT|INSERT|UPDATE|DELETE)/i', $sql)) {
            throw new CustomException('Database - Invalid instruction');
        }
        $this->connect();
        try {
            $execute = $this->binding->prepare($sql);
            $this->disconnect();
            if (!empty($parameters)) {
                return $execute->execute($parameters);
            }
            return $execute->execute();
        } catch (PDOException $exception) {
            $this->disconnect();
            return false;
        }
    }

    /**
     * @throws CustomException
     */
    public function update(string $sql, ?array $parameters = null): bool
    {
        $sql = trim($sql);
        if (!preg_match('/^UPDATE/i', $sql)) {
            throw new CustomException('Database - It\'s not a update statement');
        }
        $this->connect();
        try {
            $execute = $this->binding->prepare($sql);
            $this->disconnect();
            if (!empty($parameters)) {
                return $execute->execute($parameters);
            }
            return $execute->execute();
        } catch (PDOException $exception) {
            $this->disconnect();
            return false;
        }
    }
}