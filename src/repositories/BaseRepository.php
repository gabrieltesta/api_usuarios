<?php

namespace Src\repositories;

class BaseRepository
{
    /**
     * Retorna script SELECT de SQL.
     *
     * @param string $select
     * @param string $from
     * @param array $join
     * @param array $where
     * @param array $orderBy
     * @param array $having
     * @param int $limit
     * @param int $offset
     * @return string
     */
    protected function buildSQLSelect(string $select, string $from, array $join = [], array $where = [], array $orderBy = [], array $having = [], int $limit = 0, int $offset = 0): string
    {
        $sql = "SELECT {$select} ";
        $sql .= "FROM {$from} ";

        if($join) {
            foreach ($join as $table => $condition)
                $sql .= "{$table} ON {$condition} ";
        }

        if($where) {
            $sql .= "WHERE 1=1 ";
            foreach ($where as $firstCondition => $secondCondition)
                $sql .= "AND {$firstCondition} {$secondCondition} ";
        }

        if($orderBy)
            $sql .= "ORDER BY ".implode(',', $orderBy)." ";

        if($having) {
            $sql .= "HAVING 1=1 ";
            foreach ($having as $firstCondition => $secondCondition)
                $sql .= "AND {$firstCondition} {$secondCondition} ";
        }

        if($limit)
            $sql .= "LIMIT {$limit} ";

        if($offset)
            $sql .= "OFFSET {$offset}";

        $sql .= ";";
        return $sql;
    }

    /**
     * Retorna script INSERT de SQL.
     *
     * @param string $columns
     * @param string $table
     * @param array $data
     * @return string
     */
    protected function buildSQLInsert(string $columns, string $table, array $data): string
    {
        $sql = "INSERT INTO {$table} ({$columns}) VALUES (";

        $sql .= implode(',', $data);

        $sql .= ");";
        return $sql;
    }

    /**
     * Retorna script DELETE de SQL.
     *
     * @param string $table
     * @param array $where
     * @return string
     */
    protected function buildSQLDelete(string $table, array $where): string
    {
        $sql = "DELETE FROM {$table} WHERE 1=1 ";

        foreach($where as $firstCondition => $secondCondition)
            $sql .= "AND {$firstCondition} {$secondCondition} ";

        $sql .= ";";
        return $sql;
    }

    protected function buildSQLUpdate(string $table, array $data, array $where): string
    {
        if(!$data)
            return '';

        $sql = "UPDATE {$table} SET ";

        foreach($data as $column => $value)
            $sql .= "{$column} = \"{$value}\", ";

        $sql = rtrim($sql, ', ')." WHERE 1=1 ";

        foreach($where as $firstCondition => $secondCondition)
            $sql .= "AND {$firstCondition} {$secondCondition} ";

        $sql .= ";";
        return $sql;
    }
}