<?php

use core\Validator;
use core\Database;
use core\App;

$db = App::resolve(Database::class);

$errors = [];

if (!Validator::string($_POST['body'])) {
    $errors['body'] = 'A body of no more than 200 characters is required';
}

if (empty($errors)) {
    $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
        'body' => $_POST['body'],
        'user_id' => 3
    ]);
    header('location: /notes');
    exit();
}
