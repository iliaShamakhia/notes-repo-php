<?php

use core\Database;
use core\App;

$db = App::resolve(Database::class);

$heading = "Note";

$currentUserId = 3;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_POST['id']
])->fetchOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query("delete from notes where id = :id", [
    "id" => $_POST['id']
]);

header('location: /notes');
exit();
