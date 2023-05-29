<?php

namespace app\models;

use app\core\Router;

class Auth
{
    public static function is_user_remember_on(Router $router): bool
    {
        // check the session
        // if (isset($_SESSION["username"])) {
        //     return true;
        // }

        // check the remember_me in cookie
        $token = filter_input(INPUT_COOKIE, 'remember_me', FILTER_SANITIZE_STRING);

        if ($token && Auth::token_is_valid($token, $router)) {
            $user = $router->db->find_user_by_token($token);

            if ($user) {
                return Auth::log_user_in($user['username'], $user['userid']);
            }
        }
        return false;
    }
    public static function is_user_logged_in(Router $router): bool
    {
        // check the session
        if (isset($_SESSION["username"])) {
            return true;
        }
        return false;
    }
    public static function generate_tokens()
    {
        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));

        return [$selector, $validator, $selector . ':' . $validator];
    }
    public static function parse_token(string $token)
    {
        $parts = explode(':', $token);

        if ($parts && count($parts) == 2) {
            return [$parts[0], $parts[1]];
        }
        return null;
    }
    public static function token_is_valid(string $token, $router)
    { // parse the token to get the selector and validator [$selector, $validator] = parse_token($token);
        [$selector, $validator] = Auth::parse_token($token);
        $tokens = $router->db->find_user_token_by_selector($selector);
        if (!$tokens) {
            return false;
        }

        return password_verify($validator, $tokens['hashed_validator']);
    }
    public static function log_user_in($username, $user_id)
    {
        if (session_regenerate_id()) {
            // set username & id in the session
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            return true;
        }
        return false;
    }
    public static function login(string $username, int $user_id, bool $remember, Router $router)
    {
        Auth::log_user_in($username, $user_id);
        if ($remember) {
            Auth::remember_me($username, $user_id, $router);
        }
    }


    public static function remember_me($username, $user_id, Router $router, int $day = 30)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        [$selector, $validator, $token] = Auth::generate_tokens();

        // remove all existing token associated with the user id
        $router->db->delete_user_token($user_id);

        // set expiration date
        $expired_seconds = time() + 60 * 60 * 24 * $day;

        // insert a token to the database
        $hash_validator = password_hash($validator, PASSWORD_DEFAULT);
        $expiry = date('Y-m-d H:i:s', $expired_seconds);

        if ($router->db->insert_user_token($user_id, $selector, $hash_validator, $expiry)) {
            setcookie('remember_me', $token, $expired_seconds, '/');
        }
    }
    public static function logout(Router $router, $day = 30): void
    {
        session_start();
        if (Auth::is_user_logged_in($router)) {

            // delete the user token
            $router->db->delete_user_token($_SESSION['user_id']);
            // delete session
            unset($_SESSION['username'], $_SESSION['user_id`']);
            // remove the remember_me cookie
            if (isset($_COOKIE['remember_me'])) {
                setcookie('remember_user', null, time() - (60 * 60 * 24 * $day), "/");
                unset($_COOKIE['remember_me']);
            }

            // remove all session data
            session_destroy();

            // redirect to the login page
            header("location: /NotesApp/");
        }
    }
}
