<?php
include "connection.php"; 

if (isset($_GET['assetid'])) {
    $assetid = $_GET['assetid'];

    
    $assetid = mysqli_real_escape_string($conn, $assetid);// for safety atau sql injection 

    //check asset id
    $check_sql = "SELECT status FROM asset WHERE assetid = '$assetid'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

       //bila tekan button pending
if ($row['status'] == 'Pending') {
    $update_sql = "UPDATE asset SET status = 'Activated', purchasedate = CURDATE() WHERE assetid = '$assetid'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Asset has been activated successfully.'); window.location.href = 'status.php';</script>";
    } else {
        echo "<script>alert('Error updating asset status.'); window.location.href = 'status.php';</script>";
    }
} elseif ($row['status'] == 'Activated') {
    $update_sql = "UPDATE asset SET status = 'In Used', purchasedate = CURDATE() WHERE assetid = '$assetid'";
    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Asset status updated to In Used.'); window.location.href = 'status.php';</script>";
    } else {
        echo "<script>alert('Error updating asset status.'); window.location.href = 'status.php';</script>";
    }
}
    } else {
        echo "<script>alert('Asset not found.'); window.location.href = 'status.php';</script>";
    }

    mysqli_close($conn); 
} else {
    echo "<script>alert('Asset ID is missing.'); window.location.href = 'status.php';</script>";
}
?>
