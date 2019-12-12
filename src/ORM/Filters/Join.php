<?php


namespace JbSilva\ORM\Filters;

trait Join
{
    public function makeJunction(array $junctions, $model) :string
    {
        $sql = '';

        foreach ($junctions as $junction) {
            $table = $junction[0];
            $primariKey = $junction[1];
            $foreignKey = $junction[2];

            if (isset($junction[3])) {
                $otherKey = $junction[3];
            }

            $sql .=   $model->table . '.' . $foreignKey . ' = ' . $table . '.' . $primariKey;
        }

        $join = sprintf(' INNER JOIN %s ON (%s)', $model->table, $sql);
        return $join;
    }
}
