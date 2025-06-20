<?php
include "header.php";
include "connection.php";
include "container.php";
?>

<div id="main">

<?php

if (isset($_GET["id"])) {
    $assetid = mysqli_real_escape_string($conn, $_GET["id"]);

   
    $sql = "DELETE FROM asset WHERE assetid = '$assetid'";

    if (mysqli_query($conn, $sql)) {
       
        echo "<script>alert('Asset $assetid deleted successfully.'); window.location.href = 'management1.php';</script>";
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error deleting asset: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No asset ID provided for deletion.</div>";
}

mysqli_close($conn);
?>

</div>

<?php include "footer.php"; ?>
