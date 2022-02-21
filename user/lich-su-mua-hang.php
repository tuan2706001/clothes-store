<?php
session_start();
if (isset($_SESSION["email"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="icon/font-awesome/css/font-awesome.min.css">
        <style>
            * {

                box-sizing: border-box;
            }

            body {
                font-family: Times New Roman;
                line-height: 25px;
                margin: 0px;
                padding: 100px;
                color: blueviolet;
                position: relative;
                /* background-image: linear-gradient(rgba(247, 243, 243, 0.7),rgba(255, 255, 255, 0.7)), url(../img/anhDong.gif);
    background-size: 150px; 
	background-position: center; */
            }

            a {
                text-decoration: none;
                transition: all 1.5s;
            }

            a:hover {
                color: red;
            }

            .div {
                /* padding-left: 100px; */
                position: relative;
                left: 0px;
                width: 100%;
                font-size: 14px;

            }

            /* sizebar */



            /* header */

            .div1 {
                background-image: linear-gradient(rgba(247, 243, 243, 0.7), rgba(255, 255, 255, 0.7)), url(../img/anh.jpg);
                position: fixed;
                height: 100px;
                top: 0px;
                position: absolute;
                top: 0px;
                left: 0px;
                display: inline-flex;
                width: 100%;
                border-bottom: 1px solid white;
            }

            .div1 {
                position: fixed;
                height: 100px;
                top: 0px;
                z-index: 2;
            }
        </style>
    </head>

    <body>
        <div class="div">
            <div class="div1">
                <?php
                include("menu.php");
                ?>
            </div>


            <h1>DON HANG DA DUYET</h1>
            <table>
                <table border="1">
                    <tr>
                        <th>Mã Hóa Đơn</th>
                        <th>Sản Phẩm</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </table>
                <tfoot>
                    <?php
                    include("../connect/open.php");
                    $limit = 15;
                    $start = 0;
                    $sqlDem = "SELECT COUNT(*) as tong FROM `hoa_don`";
                    $resultDem = mysqli_query($con, $sqlDem);
                    $dem = mysqli_fetch_array($resultDem);
                    $tong = $dem["tong"];
                    $soTrang = ceil($tong / $limit);
                    if (isset($_GET["trang"])) {
                        $trang = $_GET["trang"];
                        $start = ($trang - 1) * $limit;
                    }

                    // $trangThai = "";
                    $sql = "SELECT * FROM hoa_don
                    INNER JOIN hoa_don_chi_tiet on hoa_don.maHoaDon = hoa_don_chi_tiet.maHoaDon 
                    where maKhachHang = '$ma'";
                    // echo $sql;

                    $result = mysqli_query($con, $sql);
                    include("../connect/close.php");
                    $dem = 0;
                    while ($ad = mysqli_fetch_array($result)) {
                        $dem++;
                    ?>
                        <table>
                            <tr>
                                <th><?php echo $dem; ?></th>
                                <th><?php echo $ad["maHoaDon"] ?></th>
                                <th><?php echo $ad[""] ?></th>
                                <th><?php echo $ad["diaChi"] ?></th>
                                <th><?php echo $ad["ngayXuatHoaDon"] ?></th>
                                <th><?php echo $ad["ghiChu"] ?></th>
                            </tr>
                        </table>
                    <?php
                    }
                    ?>
                </tfoot>
            </table>
            <ul>
                <?php
                for ($j = 1; $j <= $soTrang; $j++) {
                ?>
                    <li><a href="?trang=<?php echo $j; ?>" class="trang<?php if ($trang == $j) {
                                                                            echo " a";
                                                                        } ?>"><?php echo $j; ?></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("location: form-dang-nhap.php");
}
?>