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
    $msgError = "";
    if (isset($_SESSION['error']) && $_SESSION['error'] != "") {
        $msgError .= '<div class="bg-danger p-3">
                            <span style="font-size:24px" >' . $_SESSION['error'] . '</span>
                    </div>';
    }
    unset($_SESSION['error']);
    echo $msgError;
}
