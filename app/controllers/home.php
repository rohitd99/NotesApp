<?php

namespace app\controllers;

use app\core\Router;
use app\models\Auth;
use app\models\User;
use app\models\Note;

date_default_timezone_set('Asia/Kolkata');
class Home
{
    public function index(Router $router)
    {
        session_start();
        $view = "views/home/index";
        $search = '';
        $notes = [];
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $notes = $router->db->getNotesLike($_SESSION['user_id'], $search);
        } else {
            $notes = $router->db->getNotes($_SESSION['user_id']);
        }
        $router->renderView($view, ["notes" => $notes, "user_id" => $_SESSION['user_id'], "username" => $_SESSION["username"], "search" => $search]);
    }
    public function about(Router $router)
    {
        session_start();
        $view = "views/home/about";
        $router->renderView($view, ["user_id" => $_SESSION['user_id'], "username" => $_SESSION["username"]]);
    }
    public function createNotes(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $view = "views/home/createnote";
        $errors = [];
        $data = [];
        static $visited = false;
        $userid = $_SESSION['user_id'];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $visited = true;
            if (isset($_POST['title']))
                $data['title'] = $_POST['title'];
            if (isset($_POST['description']))
                $data['description'] = $_POST['description'];
            $data['userid'] = $_SESSION['user_id'];
            $note = new Note;
            $note->load($data);
            $errors = $note->validate();
            if (empty($errors)) {
                $note->create($router);
                header("location: /NotesApp/home");
                exit;
            }
        }
        $router->renderView($view, ["errors" => $errors, "data" => $data]);
    }
    public function updateNotes(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $view = "views/home/editnote";
        $noteid = NULL;
        if (isset($_GET['id']))
            $noteid = $_GET['id'];
        $data = $router->db->getNoteByID($noteid)[0];
        if (empty($data)) {
            header("location:/NotesApp/home");
        }
        $note = new Note;
        $note->load($data);
        $errors = [];
        static $visited = false;
        $userid = $_SESSION['user_id'];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $visited = true;
            if (isset($_POST['title']))
                $note->setTitle($_POST['title']);
            if (isset($_POST['description']))
                $note->setDescription($_POST['description']);
            $errors = $note->validate();
            if (empty($errors)) {
                $note->setTimestamp(date("Y-m-d H:i:s"));
                $note->update($router);
                header("location: /NotesApp/home");
                exit;
            }
        }
        $router->renderView($view, ["errors" => $errors, "note" => $note]);
    }
    public function deleteNotes(Router $router)
    {
        $noteid = NULL;
        if (isset($_POST['noteid'])) {
            $noteid = $_POST['noteid'];
            $router->db->deleteByNoteID($noteid);
        }
        header("location: /NotesApp/home");
    }
    public function updateUser(Router $router)
    {
        session_start();
        $view = "views/home/edituser";
        $errors = [];
        $userid = $_SESSION['user_id'];
        $data = $router->db->getUserByID($userid)[0];
        $user = new User;
        $user->load($data);
        static $visited = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $visited = true;
            if (isset($_POST["username"]))
                $user->setUsername($_POST["username"]);
            if (isset($_POST["email"]))
                $user->setEmail($_POST["email"]);
            if (isset($_POST["password"]))
                $user->setPassword($_POST["password"]);
            $user->setID($userid);
            $errors = $user->validateEdit($router);
            if (empty($errors)) {
                $remember = isset($_COOKIE['remember_me']) ? true : false;
                // echo "<pre>";
                // var_dump($user, $remember);
                // echo "</pre>";
                if ($remember) {
                    $router->db->delete_user_token($user->getID());
                    Auth::remember_me($user->getUsername(), $user->getID(), $router);
                }
                $user->update($router);
                Auth::log_user_in($user->getUsername(), $user->getID());
                header("location: /NotesApp/home");
                exit;
            }
        }
        $router->renderView($view, ["user" => $user, "errors" => $errors, "visited" => $visited]);
    }
    public function deleteUser(Router $router)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $userid = $_SESSION['user_id'];
        if (isset($userid)) {
            echo $userid;
            $router->db->deleteByUserID($userid);
            Auth::logout($router);
            $router->db->deleteUser($userid);
        }
    }
    public function logout(Router $router)
    {
        Auth::logout($router);
    }
}
