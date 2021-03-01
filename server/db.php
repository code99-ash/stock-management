<?php
    use Illuminate\Database\Capsule\Manager as Capsule;
    require 'vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $capsule = new Capsule;

    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => $_ENV['DATABASE_HOST'],
        'database'  => $_ENV['DATABASE_NAME'],
        'username'  => $_ENV['DATABASE_USER'],
        'password'  => $_ENV['DATABASE_PASSWORD'],
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);

    // Set the event dispatcher used by Eloquent models... (optional)
    use Illuminate\Events\Dispatcher;
    use Illuminate\Container\Container;
    $capsule->setEventDispatcher(new Dispatcher(new Container));

    // Make this Capsule instance available globally via static methods... (optional)
    $capsule->setAsGlobal();

    // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
    $capsule->bootEloquent();
?>