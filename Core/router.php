<?php
// Router class

class router
{
    //  Associative arrays are arrays that use named keys that you assign to them.

    protected $routes = [];
    protected $params = [];

    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($url)
    {
        // to loop through and print all the values of an associative array, you could use a foreach loop like this
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params; //assign the current route params
                return true;
            }
        }
        return false;
    }

    public function getParams()
    {
        return $this->params;
    }
}
