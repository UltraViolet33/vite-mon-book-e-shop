<?php

session_start();

$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

include "../app/init.php";

$path = str_replace("index.php", "", $path);

define("ROOT", $path);
define("ASSETS", $path . "assets/");
define("ROOT_PATH", "/Vite-mon-Book-E-Shop/");

$app = new App();
