# An Stock management System

## Instructions

Run cd server
Run composer install
Go to .env and set DATABASE_NAME
Run php database/migration.php

Go to start.php and create a new Admin data by appending as below:

Staff::create([
    'role_id' => 1,
    'title' => 'Mr',
    'fname' => 'Ikhlas',
    'lname' => 'Oyelami',
    'email' => 'admin@gmail.com',
    'password' => password_hash('admin', PASSWORD_BCRYPT)
]);

Run php start.php

