<?php

if(isset($_POST['signup'])) {

    require 'dbh.inc.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (empty($username) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&user=".$username);
        exit();
    }
    else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        header("Location: ../signup.php?error=invalidpassword");
        exit();
    }
    else if (preg_match('/\s/',$username)){
        echo 'Username must not contain any whitespaces.';
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }
    else if ($password !== $passwordRepeat){
        header("location: ../signup.php?error=passwordcheck");
        exit();
    }
    else {
        $sql = "SELECT username FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken");
                exit();
            } else {

                $sql = "INSERT INTO users_table (username, password) VALUES (?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}

else {
    header("Location: ../signup.php");
    exit();
}