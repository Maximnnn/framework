<?php namespace Framework;


use Framework\Exceptions\BaseException;

class Container {

    use singleInstanceTrait;

    private $storage = [];
    private $closures = [];

    public function __construct()
    {
        $this->storage[get_class($this)] = $this;
    }

    public function register(string $className, $func, $single = false) {
        $this->closures[$className] = [
            'call' => $func,
            'single' => $single
            ];
        return $this;
    }

    public function registerSingleton(string $className, $func = null) {
        $this->closures[$className] = [
            'call' => $func,
            'single' => true
        ];
    }

    public function make($className, array $parameters = []) {
        if (isset($this->closures[$className])) {
            if ($this->closures[$className]['single'] !== true) {
                return $this->createObject($className, $this->closures[$className]['call'], $parameters);
            } else if (!isset($this->storage[$className])) {
                $this->storage[$className] = $this->createObject($className, $this->closures[$className]['call'], $parameters);
            }
            return $this->storage[$className];
        }
        return $this->createObject($className, null, $parameters);
    }

    protected function createObject($className, callable $func = null, array $parameters = [])
    {
        if ($func) {
            $reflection = new \ReflectionFunction($func);
            $params = $reflection->getParameters() ?? [];
            $parameters = $this->resolveParameters($parameters, $params);
            return call_user_func_array($func, $parameters);
        }
        $reflection = new \ReflectionClass($className);
        $constructor = $reflection->getConstructor();
        $params = [];
        if ($constructor)
            $params = $constructor->getParameters();
        $params = $this->resolveParameters($parameters, $params);
        return new $className(...$params);
    }

    public function resolveParameters($parameters, array $reflectionParameters = null) {

        $return = [];

        if ($reflectionParameters) foreach ($reflectionParameters as $key => $parameter) {
            /**@var $parameter \ReflectionParameter*/
            if (isset($parameters[$key])) {
                $value = $parameters[$key];
                if ($this->isParamAffordable($parameter, $value)) {
                    $return[] = $value;
                } else {
                    $this->error($parameter);
                }
            } else if ($parameter->getClass()) {
                $value = $this->make($parameter->getClass()->getName());
                if (!$value)
                    $this->error($parameter);
                $return[] = $value;
            } else if (isset($parameters[$parameter->getName()])) {
                $value = $parameters[$parameter->getName()];
                if ($this->isParamAffordable($parameter, $value)){
                    $return[] = $value;
                } else {
                    $this->error($parameter);
                }
            } else if (isset($parameters[$key])) {
                $value = $parameters[$key];
                if ($this->isParamAffordable($parameter, $value)) {
                    $return[] = $value;
                } else {
                    $this->error($parameter);
                }
            } else if (!$parameter->isOptional()) {
                $this->error($parameter);
            }
        }

        return $return;
    }

    protected function isParamAffordable(\ReflectionParameter $parameter, $value):bool {

        if (!$parameter->getType()) {
            return true;
        }

        $class = $parameter->getClass();

        if ($class) {
            $name = $class->getName();
            if ($value instanceof $name) {
                return true;
            }
            return false;
        }

        if ($parameter->getType()->getName() === 'int' && is_int($value))
            return true;

        if ($parameter->getType()->getName() === 'string' && is_string($value))
            return true;

        if ($parameter->isArray() && is_array($value))
            return true;

        if ($parameter->isCallable() && is_callable($value))
            return true;

        return false;
    }

    public function __call($name, $arguments)
    {
        return $this->make($name, $arguments);
    }

    protected function error(\ReflectionParameter $parameter) {
        throw new BaseException('unresolved parameter "' . $parameter->getName() . '"');
    }
}