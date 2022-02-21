<?php
if (isset($_GET["maAdmin"])) {
    $maAd = $_GET["maAdmin"];
    include("../connect/open.php");
    $sql = "DELETE FROM admin WHERE maAdmin = $maAd";
    mysqli_query($con, $sql);
    include("../connect/close.php");
    header("Location: thong-tin.php");
} else {
    header("Location: thong-tin.php");
}
