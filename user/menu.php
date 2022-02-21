<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="assets/css/style.css">
<style>
    #menu {
        display: flex;
        /* margin-left: 569px; */
    }

    ul {
        /* mat cham */
        list-style: none;
        padding: 0;
        margin: 0;

    }

    a {
        text-decoration: none;
        color: black;
    }

    #menu li {
        background-color: #919191;
        padding: 21px 10px 0 10px;
        border-right: 1px solid;
        transition: all 1s;
    }

    #menu li:hover {
        background-color: #EF4A43;
    }

    .cha {
        position: relative;
    }

    .con {
        position: absolute;
        left: 0;
        top: 70px;
        display: none;
    }

    .con li {
        min-width: 140px;
        height: 50px;
        line-height: 0px;
        border-top: 1px solid;
    }

    .cha:hover .con {
        display: block;
    }
</style>
<div class="header">
    <div class="logo" style="margin-top: 20px; width:100px;height:30px"> <a href="index.php"><i class="fab fa-artstation"></i></a><label> </label></div>
    <ul id="menu">
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="gioi-thieu.php">Giới thiệu</a></li>
        <li class="cha">
            <a href="San-pham.php">Sản phẩm</a>
            <ul class="con">
                <li><a href="index.php?search=Áo">Áo sơ mi</a></li>
                <li><a href="index.php?search=váy">Váy đầm</a></li>
                <li><a href="index.php?search=quần">Quần âu</a></li>

            </ul>
        </li>

        <li> <a href="Tim-kiem.php"><i class='fas fa-search'></i></a></li>
        <li><a href="form-dang-nhap.php"><i class="fas fa-user"></i></a></li>

        <?php if (isset($_SESSION["email"])) {

        ?>

            <li><a href="gio-hang.php"><i class="fas fa-cart-plus"></i></a></li>
        <?php
        }
        ?>
    </ul>
</div>