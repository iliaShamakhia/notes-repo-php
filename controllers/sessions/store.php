<?php

use core\App;
use core\Database;
use core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if(!Validator::email($email)){
    $errors['email'] = 'Please provide a valid email address';
}

if(!Validator::string($password)){
    $errors['password'] = 'Please enter a valid password';
}

if(!empty($errors)){
    require base_path('views/sessions/create.view.php');
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->fetch();


if($user){
    if(password_verify($password, $user['password'])){
        login($user);
        header('location: /');
        exit();
    }
    
}


require base_path('views/sessions/create.view.php');