<?php


namespace JbSilva\ORM\Drivers;

use JbSilva\ORM\Connection;
use JbSilva\ORM\QueryBuilder\QueryBuilderInterface;

class Mysql implements DriverInterface
{
    protected $pdo;
    protected $query;
    protected $stmt;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->pdo = Connection::init();
    }

    public function close()
    {
        $this->pdo = null;
    }

    public function setQueryBuilder(QueryBuilderInterface $query)
    {
        $this->query =  $query;
        return $this;
    }

    public function exec(string $query = null)
    {
        $this->stmt = $this->pdo->prepare((string)$this->query);
        $this->stmt->execute($this->query->getValues());
        return $this;
    }

    public function lastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

    public function first()
    {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all()
    {
        return $this->stmt->fetchall(\PDO::FETCH_ASSOC);
    }

    public function count()
    {
        return $this->stmt->rowCount();
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }
}
