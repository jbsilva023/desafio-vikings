<?php


namespace JbSilva\ORM\Filters;

trait Where
{
    public function makeWhere(array $conditions) :string
    {
        $where = [];
        $values = [];

        foreach ($conditions as $condition) {
            $field = $condition[0];
            $value = $condition[1];

            if (isset($condition[2])) {
                $operator = $condition[1];
                $value = $condition[2];
            }

            $operator = $operator ?? '=';
            $where[] = $field . ' ' . $operator . ' ' . '?';
            $values[] = $value;
        }

        $this->values = array_merge($this->values, $values);

        return ' WHERE ' . implode(' and ', $where);
    }
}
