<?php
namespace Framework\Storage;


abstract class Repository {
    protected $storage;
    public function __construct(StorageInterface $storage){
        $this->storage = $storage;
    }

    public function save(Model $model){}
    public function update(Model $model){}
    public function delete(Model $model){}
    public function get(){}
}