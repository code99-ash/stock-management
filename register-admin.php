<?php
require 'server/vendor/autoload.php';

Staff::create([
    'role_id' => 1,
    'title' => 'Mr',
    'fname' => 'Ikhlas',
    'lname' => 'Oyelami',
    'email' => 'ikhlas@gmail.com',
    'password' => password_hash('ikhlas', PASSWORD_BCRYPT)
]);