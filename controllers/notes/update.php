<?php

use core\App;
use core\Database;
use core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 3;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_POST['id']
])->fetchOrFail();

authorize($note['user_id'] === $currentUserId);

$errors = [];

if (!Validator::string($_POST['body'])) {
    $errors['body'] = 'A body of no more than 200 characters is required';
}

if(count($errors)){
    return view('notes/edit.view.php',/* [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ] */);
}

$db->query('update notes set body = :body where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

header('location: /notes');
die();