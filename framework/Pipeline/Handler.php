<?php
namespace Framework\Pipeline;

class Handler implements HandlerInterface
{
    /**
     * @var $next Handler
     */
    protected $next;
    protected $nextMethod;

    public function next($handler, $method = 'handle'){
        $this->next = $handler;
        $this->nextMethod = $method;
        return $handler;
    }

    protected function callNext(array $params = []){
        if ($this->next) {
            $method = $this->nextMethod;
            $reflection = new \ReflectionMethod($this->next, $method);
            $params = app()->resolveParameters($params, $reflection->getParameters());
            return $this->next->$method(...$params);
        }

        return null;
    }

}