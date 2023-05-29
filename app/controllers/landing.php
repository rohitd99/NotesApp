<?php

namespace app\controllers;

use app\core\Router;
use app\models\User;
use app\models\Auth;

class Landing
{

    public function index(Router $router)
    {
        session_start();
        if (Auth::is_user_remember_on($router)) {
            header("location: /NotesApp/home");
            exit;
        }
        $view = "views/landing/index";
        $router->renderView($view);
    }
    public function login(Router $router)
    {
        session_start();
        if (Auth::is_user_remember_on($router)) {
            header("location: /NotesApp/home");
            exit;
        }
        $view = "views/landing/login";
        $errors = [];
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'remember' => ''
        ];
        static $visited = false;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['remember'] = $_POST['remember'] ?? NULL;
            $visited = true;
            $user = new User;
            $user->load($data);
            $errors = $user->validateLogin($router);
            if (empty($errors)) {
                $remember = isset($data['remember']) ? true : false;
                Auth::login($user->getUsername(), $user->getID(), $remember, $router);
                header("location: /NotesApp/home");
                exit;
            }
        }
        $router->renderView($view, ["data" => $data, "errors" => $errors, "visited" => $visited]);
    }
    public function signup(Router $router)
    {
        $view = "views/landing/signup";
        $errors = [];
        $data = [
            'username' => '',
            'email' => '',
            'password' => ''
        ];
        static $visited = false;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data['username'] = $_POST['username'];
            $data['email'] = $_POST['email'];
            $data['password'] = $_POST['password'];
            $visited = true;
            $user = new User;
            $user->load($data);
            $errors = $user->validateSignup($router);
            if (empty($errors)) {
                $user->create($router);
                header("location: /NotesApp/login");
                exit;
            }
        }
        $router->renderView($view, ["data" => $data, "errors" => $errors, "visited" => $visited]);
    }
}
