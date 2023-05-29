<?php

use app\core\Router;
use app\controllers\Home;
use app\controllers\Landing;
use app\models\Auth;

require __DIR__ . "/../vendor/autoload.php";


$router = new Router;
$router->get('/', [Landing::class, 'index']);
$router->get("/NotesApp/", [Landing::class, 'index']);
$router->get('/NotesApp/login', [Landing::class, 'login']);
$router->get('/NotesApp/signup', [Landing::class, 'signup']);
$router->post('/NotesApp/login', [Landing::class, 'login']);
$router->post('/NotesApp/signup', [Landing::class, 'signup']);
$router->get('/NotesApp/about', [Home::class, 'about']);
$router->get('/NotesApp/about/', [Home::class, 'about']);
$router->get('/NotesApp/home', [Home::class, 'index']);
$router->get('/NotesApp/home/', [Home::class, 'index']);
$router->post('/NotesApp/home/logout', [Home::class, 'logout']);
$router->get('/NotesApp/home/notes/create', [Home::class, 'createNotes']);
$router->get('/NotesApp/home/notes/edit', [Home::class, 'updateNotes']);
$router->post('/NotesApp/home/notes/create', [Home::class, 'createNotes']);
$router->post('/NotesApp/home/notes/edit', [Home::class, 'updateNotes']);
$router->post('/NotesApp/home/notes/delete', [Home::class, 'deleteNotes']);
$router->get('/NotesApp/home/user/edit', [Home::class, 'updateUser']);
$router->post('/NotesApp/home/user/edit', [Home::class, 'updateUser']);
$router->post('/NotesApp/home/user/delete', [Home::class, 'deleteUser']);
$router->resolve();
