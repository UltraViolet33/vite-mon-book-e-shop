<?php

/**
 * show
 * show the data in a readable format
 * @return void
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
 * @return void
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

/**
 * validateData
 * validate $date before insert into the BDD
 * @param  mixed $data
 * @return mixed
 */
function validateData($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
