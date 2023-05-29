<?php

namespace app\models;

use app\core\Router;

date_default_timezone_set('Asia/Kolkata');
class Note
{
    protected ?int $noteid = NULL;
    protected ?string $title = NULL;
    protected ?string $description = NULL;
    protected ?int $userid = NULL;
    protected ?string $timestamp = NULL;
    public function load($data)
    {
        $this->noteid = $data['noteid'] ?? NULL;
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->userid = $data['userid'];
        $this->timestamp = date("Y-m-d H:i:s");
    }
    public function validate()
    {
        $errors = [];
        if (!$this->title) {
            $errors['title'] = "Please enter a title";
        }
        if (!$this->description) {
            $errors['description'] = "Please enter a description";
        }
        return $errors;
    }
    public function getNoteID()
    {
        return $this->noteid;
    }
    public function getUserID()
    {
        return $this->userid;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    public function setNoteID($noteid)
    {
        $this->noteid = $noteid;
    }
    public function setUserID($userid)
    {
        $this->userid = $userid;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }
    public function create(Router $router)
    {
        $router->db->createNote($this);
    }
    public function update(Router $router)
    {
        $router->db->updateNote($this);
    }
}
