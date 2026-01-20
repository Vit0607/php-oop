<?php
require_once 'init.php';

echo Session::flash('success');

$user = new User;
$anotherUser = new User(14);

if ($user->isLoggedIn()) {
    echo "Hi, <a href='logout.php'>{$user->data()->username}</a>";
    echo '<br><br>';
    echo '<a href="logout.php">Logout</a>';
    echo '<br><br>';
    echo '<a href="update.php">Update profile</a>';
    echo '<br><br>';
    echo '<a href="changepassword.php">Change password</a>';
} else {
    echo '<a href="register.php">Register</a> or <a href="login.php">Login</a> ';
}