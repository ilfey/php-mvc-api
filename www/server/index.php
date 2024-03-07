<?php

// Constants

define("ROOT", __DIR__);
define("CORE", __DIR__ . "/core");


require_once CORE . "/app.php";

use Core\App;

$app = new App;

$app->run();

// echo phpinfo();