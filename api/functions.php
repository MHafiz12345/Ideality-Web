<?php

include "../auth/db.php";

function signUp($user, $email, $password, $created_Date)
{
    global $con;

    // Check if email already exists
    if (isEmailExists($email)) {
        return false; // Email already exists
    }

    $USER_NAME = mysqli_real_escape_string($con, $user);
    $USER_EMAIL = mysqli_real_escape_string($con, $email);
    $HASHED_PASSWORD = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO `users`(`name`, `email`, `password`, `created_date`) ";
    $query .= "VALUES ('$USER_NAME', '$USER_EMAIL', '$HASHED_PASSWORD', '$created_Date')";

    $result = mysqli_query($con, $query);

    if (!$result) {
        error_log("Query failed: " . mysqli_error($con));
        return false;
    } else {
        return true;
    }
}

function login($email, $password)
{
    global $con;
    $USER_EMAIL = mysqli_real_escape_string($con, $email);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM `users` WHERE `email` = '$USER_EMAIL' ";
    $result = mysqli_query($con, $query);
    if ($result) {

        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 1) {
            $user = mysqli_fetch_array($result);
            $PASSWORD = $user['password'];

            if (password_verify($USER_PASSWORD, $PASSWORD)) {
                return true;

            } else {
                return "Password does not match";
            }
        }
    } else {
        die ("query failed: " . mysqli_error($con));
    }
}

function isEmailExists($email) {
    global $con;

    $email = mysqli_real_escape_string($con, $email);
    $query = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $exists = mysqli_num_rows($result) > 0;
        mysqli_free_result($result);
        return $exists;
    } else {
        error_log("Query failed: " . mysqli_error($con));
        return false;
    }
}