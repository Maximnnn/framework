<?php

namespace Framework\Storage;

interface QueryBuilderInterface {
    public function where(string $key, $operator, $value = null);
    public function orWhere(string $key, $operator, $value = null);
    public function select(array $keys);
    public function from(string $from);
    public function join(string $join, string $on = null, $type = 'left');
    public function limit(int $limit);
    public function offset(int $offset);

    public function getWhere();
    public function getSelect();
    public function getFrom();
    public function getJoin();
    public function getLimit();
    public function getOffset();
}