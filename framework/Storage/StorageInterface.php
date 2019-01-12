<?php
namespace Framework\Storage;

use Framework\Collection;

abstract class StorageInterface {
    public function __construct(StorageConnectionInterface $connection){}
    public function get(QueryBuilderInterface $builder):Collection {}
    public function insert(string $to, $data){}
    public function update(QueryBuilderInterface $builder, $data){}
    public function delete(QueryBuilderInterface $builder){}
}