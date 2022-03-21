<?php

session_start();

// path on MAMP
$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
// define("ASSETS", $path . "assets/");

include "../app/init.php";

// path on WAMP
//$path = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$path = str_replace("index.php", "", $path);
show($_SERVER['HTTP_HOST']);

define("ROOT", $path);
define("ASSETS", $path . "assets/");
define("ROOT_PATH", "/Vite-mon-Book-E-Shop/");

$app = new App();

http://localhost:81/Vite-mon-Book-E-Shop/public/
