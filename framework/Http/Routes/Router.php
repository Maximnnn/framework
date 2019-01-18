<?php
namespace Framework\Http\Routes;

class Router
{
    protected $routes = [
        'post' => [],
        'get' => [],
        'delete' => [],
        'put' => [],
        'patch' => [],
        'cli' => []
    ];

    public function get(Route $route){
        $this->routes['get'][$route->getPath()] = $route;
    }

    public function post(Route $route){
        $this->routes['post'][$route->getPath()] = $route;
    }

    public function put(Route $route) {
        $this->routes['put'][$route->getPath()] = $route;
    }

    public function delete(Route $route) {
        $this->routes['delete'][$route->getPath()] = $route;
    }

    public function patch(Route $route) {
        $this->routes['patch'][$route->getPath()] = $route;
    }

    public function cli(Route $route){
        $this->routes['cli'][$route->getPath()] = $route;
    }

    public function find($method, $realPath) {

        if (isset($this->routes[$method])) foreach ($this->routes[$method] as $route) {
            /**@var $route Route*/
            $patternAsRegex = $this->getRegex($route->getPath());

            if ($ok = !!$patternAsRegex) {
                // We've got a regex, let's parse a URL
                if ($ok = preg_match($patternAsRegex, $realPath, $matches)) {
                    // Get elements with string keys from matches
                    $params = array_intersect_key(
                        $matches,
                        array_flip(array_filter(array_keys($matches), 'is_string'))
                    );
                    return $route->addParams($params);
                }
            }
        }

        return null;
    }

    protected function getRegex($pattern){
        if (preg_match('/[^-:\/_{}()a-zA-Z\d]/', $pattern))
            return false; // Invalid pattern

        // Turn "(/)" into "/?"
        $pattern = preg_replace('#\(/\)#', '/?', $pattern);

        // Create capture group for ":parameter"
        $allowedParamChars = '[a-zA-Z0-9\_\-]+';
        $pattern = preg_replace(
            '/:(' . $allowedParamChars . ')/',   # Replace ":parameter"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Create capture group for '{parameter}'
        $pattern = preg_replace(
            '/{('. $allowedParamChars .')}/',    # Replace "{parameter}"
            '(?<$1>' . $allowedParamChars . ')', # with "(?<parameter>[a-zA-Z0-9\_\-]+)"
            $pattern
        );

        // Add start and end matching
        $patternAsRegex = "@^" . $pattern . "$@D";

        return $patternAsRegex;
    }

}