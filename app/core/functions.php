<?php


/**
 * show
 * show the data in a readable format
 */
function show($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * checkError
 * check if there is an error and display it
 */
function checkError()
{
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        echo $_SESSION['error'];
        // unset($_SESSION['error']);
    }
}

/**
 * debug
 * debug a variable
 */
function debug($data, $mode = 1)
{
    echo '<div style="background: orange; padding: 5px; float: right; clear: both; ">';
    $trace = debug_backtrace();
    $trace = array_shift($trace);
    echo 'Debug demandé dans le fichier : $trace[file] à la ligne $trace[line].';
    if ($mode === 1) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    } else {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
    echo '</div>';
}
