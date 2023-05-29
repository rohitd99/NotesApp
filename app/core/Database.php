<?php

namespace app\core;

use PDO;
use app\models\User;
use app\models\Auth;
use app\models\Note;

class Database
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=notesapp", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getNotes($userid)
    {
        $statement = $this->pdo->prepare("SELECT * FROM notes WHERE userid = :userid");
        $statement->bindValue("userid", $userid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getNotesLike($userid, $search)
    {

        $statement = $this->pdo->prepare("SELECT * FROM notes WHERE userid = :userid AND title LIKE :search");
        $statement->bindValue("userid", $userid);
        $statement->bindValue("search", "%$search%");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->bindValue("email", $email);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserByEmailExcept($email, $userid)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND userid != :userid");
        $statement->bindValue("email", $email);
        $statement->bindValue("userid", $userid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUserByID($userid)
    {
        $statement = $this->pdo->prepare("SELECT * FROM users WHERE userid = :userid");
        $statement->bindValue("userid", $userid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createUser(User $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO users (`username`,`email`,`password`) VALUES(:username,:email,:password)");
        $statement->bindValue("username", $user->getUsername());
        $statement->bindValue("email", $user->getEmail());
        $statement->bindValue("password", $user->generateHashPassword());
        $statement->execute();
    }
    public function insert_user_token(int $user_id, string $selector, string $hashed_validator, string $expiry): bool
    {


        $statement = $this->pdo->prepare("INSERT INTO user_tokens(`user_id`,`selector`,`hashed_validator`,`expiry`) VALUES(:user_id,:selector,:hashed_validator,:expiry)");
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':selector', $selector);
        $statement->bindValue(':hashed_validator', $hashed_validator);
        $statement->bindValue(':expiry', $expiry);

        return $statement->execute();
    }
    public function find_user_token_by_selector(string $selector)
    {

        $statement = $this->pdo->prepare("SELECT id, selector, hashed_validator, user_id, expiry
                FROM user_tokens
                WHERE selector = :selector AND
                    expiry >= NOW()
                LIMIT 1");
        $statement->bindValue(':selector', $selector);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function delete_user_token(int $user_id)
    {
        $statement = $this->pdo->prepare("DELETE FROM user_tokens WHERE user_id = :user_id");
        $statement->bindValue(':user_id', $user_id);

        return $statement->execute();
    }
    public function find_user_by_token(string $token)
    {
        $tokens = Auth::parse_token($token);

        if (!$tokens) {
            return null;
        }
        $statement = $this->pdo->prepare("SELECT users.userid, users.username
            FROM users
            INNER JOIN user_tokens ON user_id = users.userid
            WHERE selector = :selector AND
                expiry > now()
            LIMIT 1");
        $statement->bindValue(':selector', $tokens[0]);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUser(User $user)
    {
        $statement = $this->pdo->prepare("UPDATE `users` SET `username` = :username, `email` = :email, `password` = :password WHERE userid = :userid");
        $statement->bindValue("username", $user->getUsername());
        $statement->bindValue("userid", $user->getID());
        $statement->bindValue("email", $user->getEmail());
        $statement->bindValue("password", $user->generateHashPassword());
        $statement->execute();
    }
    public function createNote(Note $note)
    {
        $statement = $this->pdo->prepare("INSERT INTO notes (`title`,`description`,`userid`,`timestamp`) VALUES(:title,:description,:userid,:timestamp)");
        $statement->bindValue("title", $note->getTitle());
        $statement->bindValue("description", $note->getDescription());
        $statement->bindValue("userid", $note->getUserID());
        $statement->bindValue("timestamp", $note->getTimestamp());
        $statement->execute();
    }
    public function updateNote(Note $note)
    {
        $statement = $this->pdo->prepare("UPDATE `notes` SET `title` = :title, `description` = :description, `timestamp` = :timestamp WHERE noteid = :noteid");
        $statement->bindValue("title", $note->getTitle());
        $statement->bindValue("description", $note->getDescription());
        $statement->bindValue("noteid", $note->getNoteID());
        $statement->bindValue("timestamp", $note->getTimestamp());
        $statement->execute();
    }
    public function getNoteByID($noteid)
    {
        $statement = $this->pdo->prepare("SELECT * FROM notes WHERE noteid = :noteid");
        $statement->bindValue("noteid", $noteid);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteByNoteID($noteid)
    {
        $statement = $this->pdo->prepare("DELETE FROM notes WHERE noteid = :noteid");
        $statement->bindValue("noteid", $noteid);
        $statement->execute();
    }
    public function deleteByUserID($userid)
    {
        $statement = $this->pdo->prepare("DELETE FROM notes WHERE userid = :userid");
        $statement->bindValue("userid", $userid);
        $statement->execute();
    }
    public function deleteUser($userid)
    {
        $statement = $this->pdo->prepare("DELETE FROM users WHERE userid = :userid");
        $statement->bindValue("userid", $userid);
        $statement->execute();
    }
}
