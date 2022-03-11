<?php

session_start();

// path on MAMP
// $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
// define("ASSETS", $path . "assets/");

include "../app/init.php";

// path on WAMP
$path = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$path = str_replace("index.php", "", $path);


define("ROOT", $path);

echo $path;

$app = new App();
