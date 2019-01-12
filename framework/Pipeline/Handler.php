<?php
namespace Framework\Pipeline;

abstract class Handler
{
    /**
     * @var $next Handler
     */
    protected $next;

    public function next(Handler $handler){
        $this->next = $handler;
        return $handler;
    }

    public function handle($data = null) {
        if ($this->next)
            return $this->next->handle($data);

        return $data;
    }

}