<?php

use core\Database;
use core\App;

$db = App::resolve(Database::class);

$heading = "Note";

$currentUserId = 3;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->fetchOrFail();

authorize($note['user_id'] === $currentUserId);

$heading = 'Edit Note';

require base_path('views/notes/edit.view.php');