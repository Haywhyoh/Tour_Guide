<?php

require_once 'models/user.php';

$demo_user = [
    'username' => 'temp_user',
    'password' => 'demo12345',
    'email' => 'test@gmail.com',
    'firstName' => 'Test',
    'lastName' => 'User',
    'role' => 'user',
];

$user = new User();
$user->saveToDatabase($demo_user);
// $user->__set('username', $demo_user['username']);
// $user->__set('passwordHash', $demo_user['password']);
// $user->__set('email', $demo_user['email']);
// $user->__set('firstName', $demo_user['firstName']);
// $user->__set('lastName', $demo_user['lastName']);
// $user->__set('role', $demo_user['role']);
?>