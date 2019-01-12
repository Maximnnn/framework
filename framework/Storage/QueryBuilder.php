<?php

namespace Framework\Storage;


class QueryBuilder implements QueryBuilderInterface {

    protected $where = [];
    protected $select = [];
    protected $from;
    protected $join = [];
    protected $limit;
    protected $offset = 0;

    private $operators = [
        '>', '<', '=', '<>', '!=', '<=', '>=', 'IN', 'NOT IN', 'IS', 'IS NOT'
    ];

    public function where(string $key, $operator, $value = null)
    {
        if (is_null($value) && !in_array(strtoupper($operator), $this->operators)) {
            $value = $operator;
            $operator = '=';
        }
        $this->where[] = [$key, $operator, $value];
        return $this;
    }

    public function orWhere(string $key, $operator, $value = null)
    {
        // TODO: Implement orWhere() method.
        return $this;
    }

    public function select(array $keys)
    {
        $this->select = array_merge($this->select, $keys);
        return $this;
    }

    public function from(string $from)
    {
        $this->from = $from;
        return $this;
    }

    public function join(string $join, string $on = null, $type = 'left')
    {
        $this->join[] = [$type, $join, $on];
        return $this;
    }

    public function limit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function getSelect()
    {
        return $this->select;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getJoin()
    {
        return $this->join;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getOffset()
    {
        return $this->offset;
    }
}