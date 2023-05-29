<?php

namespace app\models;

use app\core\Router;

class User
{
    protected ?int $id = NULL;
    protected ?string $username = NULL;
    protected ?string $email = NULL;
    protected ?string $password = '';

    public function load($data)
    {
        $this->id = $data['id'] ?? NULL;
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];
    }
    public function validateSignup(Router $router)
    {
        $errors = [];
        $regex_pass = "/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";
        if (!$this->username) {
            $errors['username'] = 'Please enter a username';
        }
        if (!$this->email) {
            $errors['email'] = 'Please enter a email';
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email";
        } else if (!empty($router->db->getUserByEmail($this->email))) {
            $errors['email'] = "Sorry there already exists a user with this email";
        }
        if (!$this->password) {
            $errors['password'] = "Please enter a password";
        } else if (strlen($this->password) < 8 || strlen($this->password) > 20) {
            $errors['password'] = "Password must be between 8 and 20 characters";
        } else if (!preg_match($regex_pass, $this->password)) {
            $errors['password'] = "Password must contain atleast one number and special character";
        }
        return $errors;
    }
    public function validateLogin(Router $router)
    {
        $errors = [];
        $user = $router->db->getUserByEmail($this->email);
        if (!$user) {
            $errors['is_match'] = "Sorry but the given account does not exist";
        } else {
            $regex_pass = "/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";
            if (!$this->username) {
                $errors['username'] = 'Please enter a username';
            } else if (!($this->username == $user[0]['username'])) {
                $errors['username'] = 'Username does not match';
            }
            if (!$this->email) {
                $errors['email'] = 'Please enter a email';
            } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please enter a valid email";
            }

            if (!$this->password) {
                $errors['password'] = "Please enter a password";
            } else if (strlen($this->password) < 8 || strlen($this->password) > 20) {
                $errors['password'] = "Password must be between 8 and 20 characters";
            } else if (!preg_match($regex_pass, $this->password)) {
                $errors['password'] = "Password must contain atleast one number and special character";
            } else if (!password_verify($this->password, $user[0]['password'])) {
                $errors['password'] = "Password does not match";
            }
        }
        if (empty($errors)) {
            $this->id = $user[0]['userid'];
        }
        return $errors;
    }
    public function validateEdit(Router $router)
    {
        $errors = [];
        $regex_pass = "/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";
        if (!$this->username) {
            $errors['username'] = 'Please enter a username';
        }
        if (!$this->email) {
            $errors['email'] = 'Please enter a email';
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email";
        } else if (!empty($router->db->getUserByEmailExcept($this->email, $this->id))) {
            $errors['email'] = "Sorry there already exists a user with this email";
        }
        if (!$this->password) {
            $errors['password'] = "Please enter a password";
        } else if (strlen($this->password) < 8 || strlen($this->password) > 20) {
            $errors['password'] = "Password must be between 8 and 20 characters";
        } else if (!preg_match($regex_pass, $this->password)) {
            $errors['password'] = "Password must contain atleast one number and special character";
        }
        return $errors;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getID()
    {
        return $this->id;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setID($id)
    {
        $this->id = $id;
    }
    public function generateHashPassword()
    {
        return password_hash(
            $this->password,
            PASSWORD_DEFAULT
        );
    }
    public function create(Router $router)
    {
        $router->db->createUser($this);
    }
    public function update(Router $router)
    {
        $router->db->updateUser($this);
    }
}
