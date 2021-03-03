<?php
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager;

Manager::schema()->dropIfExists('roles');
Manager::schema()->create('roles', function($table) {
    $table->increments('id');
    $table->string('name');
    $table->timestamps();
});


Manager::schema()->dropIfExists('staffs');
Manager::schema()->create('staffs', function($table) {
    $table->increments('id');
    $table->integer('role_id')->unsigned();
    $table->enum('title', ['Mr', 'Mrs', 'Mrss'])->default('Mr');
    $table->string('fname');
    $table->string('lname');
    $table->enum('gender', ['male', 'female'])->default('male');
    $table->string('email')->unique();
    $table->string('phone_no')->nullable();
    $table->string('avatar')->nullable();
    $table->enum('active', ['true', 'false'])->default('true');
    $table->string('password')->nullable();
    $table->integer('token')->nullable();
    $table->string('remember_token')->nullable();
    $table->timestamps();
    $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
});

Manager::schema()->dropIfExists('stock');
Manager::schema()->create('stock', function($table) {
    $table->increments('id');
    $table->string('name');
    $table->float('price', 7, 2);
    $table->integer('quantity');
    $table->integer('added_by')->unsigned();
    $table->integer('updated_by')->unsigned();
    $table->timestamps();
    $table->foreign('added_by')->references('id')->on('staffs')->onDelete('no action');
    $table->foreign('updated_by')->references('id')->on('staffs')->onDelete('no action');
});


Manager::schema()->dropIfExists('sales');
Manager::schema()->create('sales', function($table) {
    $table->increments('id');
    $table->integer('stock_id')->unsigned();
    $table->string('payment_reference');
    $table->string('transaction_id');
    $table->integer('quantity');
    $table->float('amount', 7, 2);
    $table->enum('paid_with', ['cash', 'credit card'])->default('cash');
    $table->integer('signed_by')->unsigned();
    $table->timestamps();
    $table->foreign('stock_id')->references('id')->on('stock')->onDelete('no action');
    $table->foreign('signed_by')->references('id')->on('staffs')->onDelete('no action');
});

Role::create([
    'name' => 'admin'
]);

Role::create([
    'name' => 'admin_staff'
]);

Role::create([
    'name' => 'staff'
]);


?>