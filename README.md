# An Stock management System

## Instructions

Run <addr>cd server</addr>
Run <addr>composer install</addr>

To set database name, go to .env file and replace update the database connection as below:
>   DATABASE_HOST=localhost
>   DATABASE_USER=root
>   DATABASE_PASSWORD=
>   DATABASE_NAME=ace


Run <addr>php database/migration.php</addr> to create your database tables

Go to start.php and create a new Admin data by uncommenting it and editing below:

Staff::create([
    'role_id' => 1,
    'title' => 'Mr',
    'fname' => 'Admin',
    'lname' => 'Lastname',
    'email' => 'admin@gmail.com',
    'password' => password_hash('admin', PASSWORD_BCRYPT)
]);

Run <addr>php start.php</addr>

there you have your inventory system

