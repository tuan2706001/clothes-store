<?php
if (
  isset($_GET["ten"]) && isset($_GET["gioi-tinh"]) && isset($_GET["email"]) && isset($_GET["sdt"]) && isset($_GET["ntn"])
  && isset($_GET["password"]) && isset($_GET["dia-chi"])
) {
  $ten = $_GET["ten"];
  $gioitinh = $_GET["gioi-tinh"];
  $email = $_GET["email"];
  $ngaySinh = $_GET["ntn"];
  $sdt = $_GET["sdt"];
  $pass = $_GET["password"];
  $diachi = $_GET["dia-chi"];


  include("../connect/open.php");

  $sql = "insert into khach_hang(tenKhachHang,gioiTinh,email,ngaySinh,dienThoai,password,diaChi) 
          values ('$ten',$gioitinh,'$email','$ngaySinh','$sdt','$pass','$diachi')";
  mysqli_query($con, $sql);

  include("../connect/close.php");
  header("Location: form-dang-nhap.php");
} else {
  header("Location: form-dang-ky.php");
}
