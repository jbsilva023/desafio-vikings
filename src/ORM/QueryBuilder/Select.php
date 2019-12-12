<?php


namespace JbSilva\ORM\QueryBuilder;

use JbSilva\ORM\Filters\Join;
use JbSilva\ORM\Filters\Where;
use JbSilva\ORM\Filters\Pagination;

class Select implements QueryBuilderInterface
{
    use Where;
    use Join;
    use Pagination;

    private $query;
    private $values = [];

    public function __construct(
        string $table,
        array $conditions = [],
        array $junctions = [],
        $model = null,
        array $paginations = []
    ) {
        $this->query = $this->makeSql($table, $conditions, $junctions, $model, $paginations);
    }

    private function makeSql($table, $conditions, $junctions, $model, $paginations)
    {
        $sql = sprintf('SELECT * FROM %s', $table);

        if ($junctions) {
            $sql = sprintf('SELECT %s.* FROM %s', $model->table, $table);
            $sql .= $this->makeJunction($junctions, $model);
        }

        if ($conditions) {
            $sql .= $this->makeWhere($conditions);
        }

        if ($paginations) {
            $sql .= $this->makePagination($paginations);
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
