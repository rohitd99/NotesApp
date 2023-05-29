<?php

namespace app\core;

class Router
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    protected $getRoutes = [];
    protected $postRoutes = [];
    public $db;
    public function __construct()
    {
        $this->db = new Database();
        // echo "Router";
    }

    public function parseURL()
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        if (strpos($uri, '?') !== false) {
            $uri = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
        }
        $uri = trim($uri, '/');
        $uri = filter_var($uri, FILTER_SANITIZE_URL);
        // $uri = explode('/', $uri);
        return $uri;
    }
    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $currentURL = $_SERVER['REQUEST_URI'] ?? '/';
        if (str_contains($currentURL, '?')) {
            $currentURL = substr($currentURL, 0, strpos($currentURL, '?'));
        }
        $method = $_SERVER['REQUEST_METHOD'];
        $fn = [];
        // echo "<pre>";
        // var_dump($currentURL);
        // echo "</pre>";   
        // echo "<pre>";
        // var_dump($method);
        // echo "</pre>";
        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentURL] ?? NULL;
        } else {
            $fn = $this->postRoutes[$currentURL] ?? NULL;
        }
        // echo "<pre>";
        // var_dump($fn);
        // echo "</pre>";
        if ($fn) {
            call_user_func([new $fn[0], $fn[1]], $this);
        } else {
            echo "Page not found";
        }
    }

    public function renderView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        // ob_start();
        // echo __DIR__ . "<br>";
        // var_dump($params);
        include_once __DIR__ . "/../$view.php";
        // $content = ob_get_clean();
        // include_once __DIR__ . "/../views/layout.php";
    }
}
