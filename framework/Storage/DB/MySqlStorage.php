<?php
namespace Framework\Storage\DB;

use Framework\Storage\StorageInterface;

class MySqlStorage extends StorageInterface {

    protected $connection;

    public function __construct(MySqlConnection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    public function get(BuilderInterface $builder): Collection
    {
        // TODO: Implement get() method.
    }

    public function insert(string $to, $data)
    {
        // TODO: Implement insert() method.
    }

    public function update(BuilderInterface $builder, $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(BuilderInterface $builder)
    {
        // TODO: Implement delete() method.
    }
}