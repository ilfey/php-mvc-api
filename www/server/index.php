<?php

// Constants

define("ROOT", __DIR__);
define("CORE", __DIR__ . "/core");


require_once CORE . "/app.php";

use Core\App;

$app = new App;

$app->use("DB", "Database connection :)");

$app->run();

// echo phpinfo();