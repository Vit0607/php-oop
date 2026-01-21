<?php
require_once 'init.php';

echo Session::flash('success');

$user = new User;
$anotherUser = new User(14);

if ($user->isLoggedIn()) {
    echo "Hi, <a href='logout.php'>{$user->data()->username}</a>";

    echo '<p><a href="logout.php">Logout</a></p>';
    echo '<p><a href="update.php">Update profile</a></p>';
    echo '<p><a href="changepassword.php">Change password</a></p>';

    if ($user->hasPermissions('moderator')) {
        echo 'You are moderator!';
    }
} else {
    echo '<a href="register.php">Register</a> or <a href="login.php">Login</a> ';
}