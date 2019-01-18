<?php
namespace Framework\Pipeline;

use Framework\Exceptions\BaseException;

class Pipeline extends Handler
{
    protected $pipeline = [];

    public function add($class, $method = 'handle') {
        $this->pipeline[] = ['class' => $class, 'method' => $method];
        return $this;
    }

    public function pipe(array $data = []){
        $first = $this;
        $next = null;
        foreach ($this->pipeline as $class) {
            if (!$next) {
                $next = $first->next($this->makeObj($class['class']), $class['method']);
            } else {
                $next = $next->next($this->makeObj($class['class']), $class['method']);
            }
        }

        return $this->callNext($data);
    }

    protected function makeObj($class) {
        if (is_string($class))
            return app()->make($class);
        if (is_object($class) and $class instanceof HandlerInterface) {
            return $class;
        }
        if (is_callable($class)) {
            return $class();
        }
        throw new BaseException('unknown handler ' . (string)$class);
    }

}