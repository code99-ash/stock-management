<?php

require 'vendor/autoload.php';
Role::create([
    'name' => 'admin'
]);

Role::create([
    'name' => 'admin_staff'
]);

// Staff::create([
//     'role_id' => 1,
//     'title' => 'Mr',
//     'fname' => 'Admin',
//     'lname' => 'Lastname',
//     'email' => 'admin@gmail.com',
//     'password' => password_hash('admin', PASSWORD_BCRYPT)
// ]);


?>