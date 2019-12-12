<?php


namespace JbSilva\ORM\QueryBuilder;

use JbSilva\ORM\Model;

class Insert implements QueryBuilderInterface
{
    protected $query;
    protected $values = [];

    public function __construct(string $table, Model $model)
    {
        $this->query = $this->makeSql($table, $model);
    }

    private function makeSql($table, $model)
    {
        $fields = array_keys($model->getAll());
        $fields_to_bind = array_fill(0, count($model->getAll()), '?');
        $this->values = array_values($model->getAll());

        $fields = implode(', ', $fields);
        $fields_to_bind = implode(', ', $fields_to_bind);

        $sql = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table, $fields, $fields_to_bind);

        return $sql;
    }

    public function getvalues(): array
    {
        return $this->values;
    }

    public function __toString()
    {
        return $this->query;
    }
}
