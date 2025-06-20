<?php
include "connection.php"; 

if (isset($_GET['assetid'])) {
    $assetid = $_GET['assetid'];

    $assetid = mysqli_real_escape_string($conn, $assetid);

    
    $check_sql = "SELECT status FROM asset WHERE assetid = '$assetid'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // bila status pending, so dia jadi activated bila tekan button process
        if (strtolower($row['status']) == 'pending') {
            $update_sql = "UPDATE asset SET status = 'Activated', purchasedate = CURDATE() WHERE assetid = '$assetid'";

            if (mysqli_query($conn, $update_sql)) {
                echo "<script>alert('Asset has been activated successfully.'); window.location.href = 'management1.php';</script>";
            } else {
                echo "<script>alert('Error updating asset status to Activated.'); window.location.href = 'management1.php';</script>";
            }
        }
        // 
        elseif (strtolower($row['status']) == 'activated') {
            $update_sql = "UPDATE asset SET status = 'In Used', purchasedate = CURDATE() WHERE assetid = '$assetid'";

            if (mysqli_query($conn, $update_sql)) {
                echo "<script>alert('Asset status updated to In Used successfully.'); window.location.href = 'management1.php';</script>";
            } else {
                echo "<script>alert('Error updating asset status to In Used.'); window.location.href = 'management1.php';</script>";
            }
        }
        else {
            echo "<script>alert('Asset is already in the correct status.'); window.location.href = 'management1.php';</script>";
        }
    } else {
        echo "<script>alert('Asset not found.'); window.location.href = 'management1.php';</script>";
    }

    mysqli_close($conn); 
} else {
    echo "<script>alert('Asset ID is missing.'); window.location.href = 'management1.php';</script>";
}
?>
