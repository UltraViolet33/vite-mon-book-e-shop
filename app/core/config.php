<?php

define("WEBSITE_TITLE", "Vite mon Book");

//database
define("DB_NAME", "vitemonbookdb");
define("DB_USER", "root");
//put your root password
define("DB_PASS", "root");
define("DB_TYPE", 'mysql');
define("DB_HOST", "localhost");

define("DEBUG", true);

if (DEBUG) {
    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}
