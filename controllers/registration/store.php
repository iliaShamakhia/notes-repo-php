<?php

use core\Validator;
use core\App;
use core\Database;

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if(!Validator::email($email)){
    $errors['email'] = 'Please provide a valid email address';
}

if(!Validator::string($password, 6, 16)){
    $errors['password'] = 'Please enter a valid password';
}

if(!Validator::string($name)){
    $errors['name'] = 'Please enter a name';
}

if(!empty($errors)){
    require base_path('views/registration/create.view.php');
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->fetch();

if($user){
    header('location: /');
    exit();
}else{

    $db->query('insert into users(name, email, password) values(:name, :email, :password)', [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login([
        'email' => $email
    ]);

    header('location: /');
    exit();
}