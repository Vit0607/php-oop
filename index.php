<?php
require_once 'init.php';

var_dump(Session::get(Config::get('session.user_session')));

$user = new User;
$anotherUser = new User(14);

if ($user->isLoggedIn()) {
    echo "Hi, <a href='#'>{$user->data()->username}</a>";
    echo '<br><br>';
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<a href="register.php">Register</a> or <a href="login.php">Login</a> ';
}