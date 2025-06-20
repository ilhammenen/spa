<?php
include "header.php";
include "connection.php";
include "container.php";


if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p class='text-danger'>Asset ID is missing. Please make sure to specify a valid asset ID in the URL.</p>";
    exit; 
}

$assetid = mysqli_real_escape_string($conn, $_GET['id']);
$current_user_userid = $_SESSION['userid'];  
?>

<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container justify-center bg-warning p-4 ">
        <h2 class="h1-blockquote text-center fw-bold">VIEW ASSET</h2>
    </div>

    <div class="container justify-center-fixed md- mb-4"><br>

    <?php

    $sql = "
        SELECT asset.assetid, asset.department, category.categoryname, asset.status, asset.purchasedate
        FROM asset
        JOIN category ON asset.categoryid = category.categoryid
        WHERE asset.assetid = '$assetid' AND asset.userid = '$current_user_userid'
    ";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

       
        if ($row['status'] == 'In Used') {
            $status_class = "text-success";
            $status_label = "In Used";
        } elseif ($row['status'] == 'Pending') {
            $status_class = "text-warning";
            $status_label = "Pending";
        } elseif ($row['status'] == 'Activated') {
            $status_class = "text-info";
            $status_label = "Activated";
       

            $action_button = "<a href='viewasset.php?id=$assetid&set_in_used=true' class=\"btn btn-success btn-sm\">Activate Now</a>";
        } else {
            $status_class = "text-danger";
            $status_label = "Inactive";
        }

   
        echo '<div class="card shadow-sm p-3 border-light rounded">';
        echo "<h5 class=\"card-title\"><strong>Asset ID:</strong> " . $row["assetid"] . "</h5>";
        echo "<p><strong>Department:</strong> " . $row["department"] . "</p>";
        echo "<p><strong>Category:</strong> " . $row["categoryname"] . "</p>";
        echo "<p><strong>Purchase Date:</strong> " . $row["purchasedate"] . "</p>";
        echo "<p><strong>Status:</strong> <span class='$status_class'>$status_label</span></p>";

        
        if (isset($action_button)) {
            echo "<p>" . $action_button . "</p>";
        }

        echo '</div>';

     
        if (isset($_GET['set_in_used']) && $_GET['set_in_used'] == 'true') {
          
            $update_sql = "UPDATE asset SET status = 'In Used', purchasedate = CURDATE() WHERE assetid = '$assetid' AND status = 'Activated'";

            if (mysqli_query($conn, $update_sql)) {
                echo "<script>alert('Asset status updated to In Used successfully!'); window.location.href='management1.php?id=$assetid';</script>";
            } else {
                echo "<script>alert('Error updating asset status.');</script>";
            }
        }

    } else {
        echo "<p>Asset not found.</p>";
    }

    mysqli_close($conn);
    ?>

    </div>
</div>

<?php
include "footer.php";
?>
