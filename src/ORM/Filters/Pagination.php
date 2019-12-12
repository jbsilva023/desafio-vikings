<?php


namespace JbSilva\ORM\Filters;

trait Pagination
{
    public function makePagination(array $pagination = []): string
    {
        $sql = '';

        if ($pagination) {
            $limit = $pagination[0];
            $page = $pagination[1];
            $offset = ($page - 1) * $limit;

            if ($pagination[2]) {
                $column = $pagination[2][0];
                $order = $pagination[2][1] ?? 'DESC';

                $sql .= sprintf(' ORDER BY %s %s', $column, $order);
            }

            $sql = sprintf('%s LIMIT %s OFFSET %s', $sql, $limit, $offset);
        }

        return $sql;
    }
}
