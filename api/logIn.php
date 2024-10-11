<?php

include "functions.php";

if (empty ($_REQUEST["email"]) || empty ($_REQUEST["password"])) {
    header("location: ../index.php");
}
else {
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];

    $emailExists = isEmailExists($email);
    if ($emailExists) {

        $result = login($email, $password);
        echo json_encode($result);
        /*if($result) {
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }*/

    }else {
        echo json_encode("Email doe not exist");

    }
}