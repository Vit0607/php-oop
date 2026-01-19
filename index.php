<?php
require_once 'init.php';

$user = new User;
$anotherUser = new User(14);

if ($user->isLoggedIn()) {
    echo "Hi, <a href='logout.php'>{$user->data()->username}</a>";
    echo '<br><br>';
    echo '<a href="logout.php">Logout</a>';
    echo '<br><br>';
    echo '<a href="update.php">Update profile</a>';
} else {
    echo '<a href="register.php">Register</a> or <a href="login.php">Login</a> ';
}