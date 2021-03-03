<?php

require 'vendor/autoload.php';

Role::create([
    'name' => 'admin'
]);

Staff::create([
    'role_id' => 1,
    'title' => 'Mr',
    'fname' => 'Ikhlas',
    'lname' => 'Oyelami',
    'email' => 'admin@gmail.com',
    'password' => password_hash('admin', PASSWORD_BCRYPT)
]);

?>