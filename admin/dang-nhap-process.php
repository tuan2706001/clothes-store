<?php
session_start();
if (isset($_POST["user"]) && isset($_POST["pass"])) {
    include("../connect/open.php");
    $user = mysqli_real_escape_string($con, $_POST["user"]);
    $pass = mysqli_real_escape_string($con, $_POST["pass"]);
    $hashpass = md5($pass);
    $sql = "SELECT * FROM admin WHERE username='$user' AND password='$hashpass'";
    $result = mysqli_query($con, $sql);
    $admin = mysqli_fetch_array($result);
    $check = mysqli_num_rows($result);
    if ($check == 0) {
        header("Location: dang-nhap.php?error=1");
    } else {
        $_SESSION["user"] = $user;
        if (isset($_POST["check"])) {
            setcookie("user", $user, time() + 84600);
            setcookie("pass", $pass, time() + 84600);
        } else {
            setcookie("user", $user, time() - 1);
            setcookie("pass", $pass, time() - 1);
        }
        if ($admin["quyen"] == 1) {
            $_SESSION["quyen"] = "Superadmin";
            $_SESSION["ma"] = $admin["maAdmin"];
        } else {
            $_SESSION["quyen"] = "Admin";
            $_SESSION["ma"] = $admin["maAdmin"];
        }
        header("Location:trangql.php");
    }
    include("../connect/close.php");
} else {
    header("Location: dang-nhap.php");
}
