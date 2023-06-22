<?php

use core\Database;
use core\App;

$db = App::resolve(Database::class);

$heading = "Note";

$currentUserId = 3;

$note = $db->query("select * from notes where id = :id", [
    'id' => $_GET['id']
])->fetchOrFail();

require base_path('views/notes/show.view.php');
