<?php
namespace App\Controllers\Console;

use Framework\Exceptions\ConsoleException;
use Framework\Http\Interfaces\ConsoleControllerInterface;
use Framework\Http\Interfaces\ResponseInterface;

class ConsoleRouter
{
    protected $args = [];

    protected $route = '';

    public function __construct()
    {
        global $argv;
        foreach ($argv as $key => $value) {
            if ($key === 0) continue;
            if ($key === 1) {
                $this->route = $value;
            } else {
                $this->args[] = $value;
            }
        }
    }

    public function index() {

        if (empty($this->route))
            return app()->make(ConsoleHelper::class)->handleError($this->args);

        $route = explode(':', $this->route);

        $class = $route[0];

        $method = $route[1] ?? '';

        $return = null;

        if (class_exists(__NAMESPACE__ . '\\' . ucfirst($class) . 'Command')) {
            $obj = app()->make(__NAMESPACE__ . '\\' . ucfirst($class) . 'Command');
            if ($obj instanceof ConsoleControllerInterface) {
                if (!empty($method) and method_exists($obj, $method))
                    $return = $obj->$method($this->args);
                else
                    $return = $obj->handleError($this->args);
            }
        }

        if ($return instanceof ResponseInterface)
            return $return;

        throw new ConsoleException('route not found');
    }
}