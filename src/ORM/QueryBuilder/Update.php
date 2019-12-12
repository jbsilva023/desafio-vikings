<?php


namespace JbSilva\ORM\QueryBuilder;

use JbSilva\ORM\Filters\Where;
use JbSilva\ORM\Model;

class Update implements QueryBuilderInterface
{
    use Where;

    protected $query;
    protected $values = [];

    public function __construct(string $table, Model $model, array $conditions)
    {
        $this->query = $this->makeSql($table, $model, $conditions);
    }

    private function makeSql($table, $model, $conditions)
    {
        $fields_to_bind = [];
        $fields = array_keys($model->getAll());
        array_shift($fields);

        $this->values = array_values($model->getAll());
        array_shift($this->values);

        foreach ($fields as $field) {
            $fields_to_bind[] = $field . '=?';
        }

        $fields_to_bind = implode(', ', $fields_to_bind);

        $sql = sprintf('UPDATE %s SET %s', $table, $fields_to_bind);

        if ($conditions) {
            $sql .= $this->makeWhere($conditions);
        }

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
