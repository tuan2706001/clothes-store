<?php
if (isset($_GET["maKhachHang"])) {
    $makh = $_GET["maKhachHang"];
    include("../connect/open.php");

    $sql = "UPDATE khach_hang set trangThai=1 where maKhachHang = $makh";

    mysqli_query($con, $sql);
    include("../connect/close.php");
    header("Location: khachHang.php");
} else {
    header("Location: khachHang.php");
}
