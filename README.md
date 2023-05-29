<p align="center"><img width=100% src="NotesAppBanner.png"></p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div style="display: inline-block;">
<img src="https://api.jm26.net/badge?g&label=php&icon=f457&message=v%208.1&color=a460d2" height="20px">

![Contributions welcome](https://img.shields.io/badge/contributions-welcome-orange.svg)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MITs)

</div>

# NotesApp - Overview

This is a simple NotesApp which allows the user to signup/login and create, view, update, delete and search notes.

## :pushpin: Table of Contents

- [Tech Stack](#tech-stack)
- [Features](#features)
- [Setting up Project](#setting-up-project)
- [Login details](#login-details)
- [Screenshots](#screenshots)
- [Contributing](#contributing)

## :pushpin: Tech Stack

- Frontend
  - HTML
  - CSS
  - Bootstrap
  - Javascript
- Backend
  - PHP
- Database
  - MySQL

## :pushpin: Features

- Custom Mini MVC architecture used.
- User Login and Signup with remember me using custom tokens.
- CRUD operations on Notes.
- Editing and Deleting user account.

## :pushpin: Setting up Project

**NotesApp** firstly requires a installation of PHP 5.4+ preferably over PHP 7 since we use the built-in server.

You may also install XAMPP as it provides the complete package (PHP,MySQL)

After installation import **notesapp.sql** into your database

Change the Existing database details from **app/core/Database.php** to your database.

```php
$hostname = 'localhost'; // Add your Host name
$port = '3306'; //Add your Port number
$db = 'notesapp'; // Add your db name
$user = 'root'; // Add user
$password = ''; // Add password
$this->pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$db", "$user", "$password");


```

Change directory

```bash
cd public
```

Run the php in-built server

```bash

    php -S localhost:8080

```
