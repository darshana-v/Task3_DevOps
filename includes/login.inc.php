<?php


if(isset($_POST['login'])) {
    require 'dbh.inc.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {
        require 'dbh.inc.php';
        $sql = "SELECT * FROM users_table WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
    else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_stmt_get_result($stmt)) {
            $pwdCheck = password_verify($password, $row['password']);
            if ($pwdCheck == false) {
                header("Location: ../index.php?error=wrongpassword");
                exit();
            }
            else if ($pwdCheck == true) {
                session_start();
                $_SESSION[id] = $row['id'];
                $_SESSION[username] = $row['username'];

                header("Location: ../index.php?login=success");
                exit();
            }
            else {
                header("Location: ../index.php?error=wrongpassword");
                exit();
            }

        }
        else {
            header("Location: ../index.php?error=nouser");
            exit();
        }
    }
    }

}
else {
    header("Location: ../index.php");
}