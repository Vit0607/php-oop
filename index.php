<?php

require_once 'Database.php';

$users = Database::getInstance()->query("SELECT * FROM users WHERE username IN (?, ?)", ['Alita Gray', 'Jim Ketty']);

if ($users->error()) {
    echo 'we have an error';
} else {
    foreach ($users->results() as $user) {
        echo $user->username . '<br>';
    }
}

if ($users->count()) {
    echo $users->count();
}