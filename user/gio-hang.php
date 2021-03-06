<?php
session_start();
include("../connect/open.php");
$email = $_SESSION["email"];
$sql = "SELECT * FROM `khach_hang` WHERE email='$email'";
$result = mysqli_query($con, $sql);
$khachHang = mysqli_fetch_array($result);
include("../connect/close.php");
if (!isset($_SESSION["email"])) {
    header("Location: form-dang-nhap.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>



    </style>
</head>

<body>
    <?php
    include("menu.php");
    ?>

    <?php
    include("../connect/open.php");
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = array();
    }
    $error = false;

    if (isset($_GET["action"])) {
        function update_cart($add = false)
        {
            foreach ($_POST['quantity'] as $maSanPham => $quantity) {
                if ($quantity == 0) {
                    unset($_SESSION["cart"][$maSanPham]);
                } else {
                    if ($add) {
                        $_SESSION["cart"][$maSanPham] += $quantity;
                    } else {
                        $_SESSION["cart"][$maSanPham] = $quantity;
                    }
                }
            }
        }

        switch ($_GET['action']) {
            case "add":
                update_cart(true);

                header("Location: ./gio-hang.php");
                break;

            case "delete":

                if (isset($_GET['maSanPham'])) {
                    unset($_SESSION["cart"][$_GET['maSanPham']]);
                }
                header("Location: ./gio-hang.php");
                break;

            case "submit":

                if (isset($_POST['update_click'])) {
                    update_cart();

                    header("Location: ./gio-hang.php");
                } elseif (isset($_POST['oder_click'])) {
                    update_cart();
                    if (empty($_POST["hoTen"])) {
                        $error = "B???n ch??a nh???p ????? th??ng tin";
                    } else if (empty($_POST["dienThoai"])) {
                        $error = "B???n ch??a nh???p ????? th??ng tin";
                    } else if (empty($_POST["diaChi"])) {
                        $error = "B???n ch??a nh???p ????? th??ng tin";
                    } else if (empty($_POST['quantity'])) {
                        $error = "Gi??? h??ng r???ng";
                    }
                    if ($error == false && !empty($_POST['quantity'])) {
                    }
                    // echo $error;
                    // exit;
                }
                break;
        }
    }
    if (!empty($_SESSION["cart"])) {
        $sql = "SELECT * FROM `san_pham` WHERE maSanPham IN(" . implode(",", array_keys($_SESSION["cart"])) . ")";
        $result = mysqli_query($con, $sql);
    }
    ?>
    <div class="cart">
        <?php if (!empty($error)) { ?>
            <div id="notity-msg">
                <?= $error ?>.<a href="javascript:history.back()"><u>Quay l???i</u></a>
            </div>
        <?php } else { ?>
            <h1><b>Gi??? h??ng</b></h1>

            <form id="cart-form" action="gio-hang.php?action=submit" method="post">
                <table>
                    <tr>
                        <th class="stt">STT</th>
                        <th class="ten">T??n s???n Ph???m</th>
                        <th class="hinhAnh"> ???nh s???n ph???m</th>
                        <th class="gia">Gi??</th>
                        <th class="number">S??? l?????ng</th>
                        <th class="tong-tien">Th??nh ti???n</th>
                        <th class="product-delete">X??a</i></th>
                    </tr>
                    <?php
                    if (!empty($result)) {
                        $num = 1;
                        $tongtien = 0;
                        while ($row = mysqli_fetch_array($result)) {
                    ?>


                            <tr>
                                <td class="stt"><?= $num++; ?></td>
                                <td class="ten"><?= $row['tenSanPham'] ?></td>
                                <td class="hinhAnh"><img src="<?= $row['hinhAnh'] ?>" width="100px" height="100px"></td>
                                <td class=" gia"><?= $row['giaTien'] ?></td>
                                <td class="number"><input type="number" name="quantity[<?= $row['maSanPham'] ?>]" value="<?= $_SESSION["cart"][$row['maSanPham']] ?>" size="2"></td>

                                <td class="tong-tien"><?= $thanhtien = $row['giaTien'] * $_SESSION["cart"][$row['maSanPham']] ?></td>
                                <td class="product-delete"><a href="gio-hang.php?action=delete&maSanPham=<?= $row['maSanPham'] ?>">X??a</a></td>
                            </tr>
                        <?php
                            $num++;
                            // $tongtien = $thanhtien + $tongtien;
                            $tongtien += $thanhtien;
                        }
                        ?>

                        <tr>
                            <th class="">&nbsp;</th>
                            <th class="">T???ng ti???n:</th>
                            <th class="">&nbsp;</th>
                            <th class="">&nbsp;</th>
                            <th class="">&nbsp;</th>
                            <th class="money"><?= $tongtien ?></th>
                            <th class="">&nbsp;</th>
                        </tr>
                    <?php
                    }
                    ?>

                </table>

                <div id="form-button">
                    <input type="submit" name="update_click" value="C???p nh???p">
                </div>


            </form>

            <a href="San-pham.php"><button class="">Ti???p t???c mua h??ng</button></a>
        <?php } ?>
        <hr>
        </hr>
        <form action="dat-hang-process.php" method="post">
            <input type="hidden" name="maKhachHang" value="<?php echo $khachHang["maKhachHang"] ?>">
            <div class="dat-hang">Ng?????i nh???n:<input type="text" value="<?php echo $khachHang["tenKhachHang"] ?>" name="name" id="name"> </div>
            <div class="dat-hang">??i???n tho???i:<input type="text" value="<?php echo $khachHang["dienThoai"] ?>" name="phone" id="phone"></div>
            <div class="dat-hang">?????a ch???:<input type="text" value="<?php echo $khachHang["diaChi"] ?>" name="address" id="address"></div>
            <!-- <div class="dat-hang">Ng??y xu???t h??a ????n:<input type="date" value="" name="date" name="date"></div> -->
            <div class="dat-hang">Ghi ch??:<textarea type="text" name="note" cols="50" rows="7"></textarea></div>
            <input type="submit" name="oder_click" value="?????t h??ng" class="button1">

        </form>

        <a href="lich-su-mua-hang.php?ma=<?php echo $khachHang["maKhachHang"] ?>"><input type="submit" name="oder_click" value="Lich su mua hang" class="button1"></a>

    </div>
    <?php
    include("footer.php");
    ?>
</body>

</html>