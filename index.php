<?php

require_once 'Database.php';

// $users = Database::getInstance()->query("SELECT * FROM users WHERE username IN (?, ?)", ['Alita Gray', 'Jim Ketty']);
$users = Database::getInstance()->get('users', ['username', '=', 'orange']);
// $users = Database::getInstance()->delete('users', ['id', '=', '13']);

// Database::getInstance()->insert('users', [
//     'username' => 'orange',
//     'password' => '123',
//     'email' => 'b@gmail.com'
// ]);

Database::getInstance()->update('users', 15, [
    'username' => 'orange2',
    'password' => '1234',
    'email' => 'bb@gmail.com'
]);

echo $users->first()->email;

echo '<br>';
echo '<br>';
echo '<br>';

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