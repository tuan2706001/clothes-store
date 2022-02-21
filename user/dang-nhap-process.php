<?php
session_start();
//Khởi tạo tại dòng 2
if (isset($_POST["email"]) && isset($_POST["pass"])) {
    //Mở kết nối
    include("../connect/open.php");
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    //Câu query kiểm tra
    $sql = "SELECT * FROM `khach_hang` WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($con, $sql);
    $demBanGhi = mysqli_num_rows($result);
    //Đếm số bản ghi
    if ($demBanGhi == 0) {
        header("Location: form-dang-nhap.php?error=1");
    } else {
        $_SESSION["email"] = $email;
        if (isset($_POST["check"])) {
            setcookie("email", $email, time() + 84600);
            setcookie("pass", $pass, time() + 84600);
        } else {
            setcookie("email", $email, time() - 1);
            setcookie("pass", $pass, time() - 1);
        }
        header("Location: index.php");
    }
    include("../connect/close.php");
} else {
    header("Location: form-dang-nhap.php");
}
