<?php


namespace JbSilva\ORM\Drivers;

use JbSilva\ORM\Model;
//use JbSilva\ORM\Connection;
use JbSilva\ORM\QueryBuilder\QueryBuilderInterface;

interface DriverInterface
{
    public function connect();
    public function close();
    public function beginTransaction();
    public function commit();
    public function rollback();
    public function setQueryBuilder(QueryBuilderInterface $query);
    public function exec(string $query = null);
    public function lastInsertedId();
    public function first();
    public function all();
}
