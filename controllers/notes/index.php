<?php

use core\Database;
use core\App;

$db = App::resolve(Database::class);

$heading = "Notes";

$notes = $db->query("select * from notes where user_id = 3")->fetchAll();

require base_path('views/notes/index.view.php');