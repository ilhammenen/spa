<?php
include "header.php";
include "connection.php";
include "container.php";


$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM asset";

//search fucntion
if (!empty($searchTerm)) {
    $sql .= " WHERE (assetid LIKE '%$searchTerm%' 
    OR userid LIKE '%$searchTerm%' 
    OR categoryid LIKE '%$searchTerm%'
     OR purchasedate LIKE '%$searchTerm%')";
}

$result = mysqli_query($conn, $sql);
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container justify-center bg-warning p-4">
        <h2 class="h1-blockquote text-center fw-bold">EDIT ASSET</h2>
    </div>

    <div class="container justify-center-fixed md- mb-4">
        <br>
      
<!--for search form -->
        <div class="d-flex justify-center bg-secondary p-2 rounded mb-3">
            <form id="searchForm" class="form-inline d-flex" method="get" action="">
                <input id="searchInput" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" class="form-control me-2" type="search" placeholder="Search Asset ID / Category / Date" aria-label="Search">
                <button id="searchBtn" class="btn btn-warning" type="submit">Search</button>
            </form>
        </div>


        <div class="d-flex justify-center mb-3">
            <form method="POST" action="">
                <button type="submit" name="set_all_active" class="btn btn-success btn-lg">Set All Active</button>
            </form>
        </div>

        <?php
        if (isset($_POST['set_all_active'])) {
            

            $update_sql = "UPDATE asset SET status = 'Activated' WHERE status != 'In Used' AND status != 'Inactive'";

            if (mysqli_query($conn, $update_sql)) {
                echo "<script>alert('All assets have been set to Active successfully, excluding inactive assets!'); window.location.href='';</script>";
            } else {
                echo "<script>alert('Error setting all assets to Active.');</script>";
            }
        }

        if (mysqli_num_rows($result) > 0) {
            
            echo "<div class='table-responsive'>";
            echo "<table class='table table-sm text-center table-bordered'>";
            echo "<tr class='table-warning'>
               <th>User ID </th>
            <th>Asset ID</th>
            <th>Category</th>
            <th>Value</th>
            <th>Quantity</th>
            <th>Inception Date</th>
            <th>Status</th>
            <th>Action</th></tr>";

            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <form method='POST' action=''>
                         <td>" .    $row["userid"] . "</td>
                            <td>" . $row["assetid"] . "</td>
                            <td>" . $row["categoryid"] . "</td>
                            <td>" . $row["value"] . "</td>
                            <td>" . $row["quantity"] . "</td>
                            <td><input type='date' name='new_date' value='" . $row["purchasedate"] . "' required></td>
                            <td>" . $row["status"] . "</td>
                            <td class='d-flex justify-content-center align-items-center'>
                               
                                <div class='mx-2'>
                                    <button type='submit' name='update_date' class='btn btn-primary btn-sm'>Update Date</button>
                                </div>

                              
                                <div class='mx-2'>
                                    <a href='?delete_asset=" . $row['assetid'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this asset?\");'>Delete</a>
                                </div>

                             
                                <div class='mx-2'>
                                    <a href='?activate_asset=" . $row['assetid'] . "' class='btn btn-success btn-sm' onclick='return confirm(\"Do you want to activate this asset?\");'>Activate</a>
                                </div>

                              
                                <div class='mx-2'>
                                    <a href='?pending_asset=" . $row['assetid'] . "' class='btn btn-warning btn-sm' onclick='return confirm(\"Do you want to set this asset as Pending?\");'>Set Pending</a>
                                </div>

                               
                                <div class='mx-2'>
                                    <a href='?inactive_asset=" . $row['assetid'] . "' class='btn btn-secondary btn-sm' onclick='return confirm(\"Do you want to set this asset as Inactive?\");'>Set Inactive</a>


                                    
                                </div>
                            </td>
                        </form>
                      </tr>";
            }
            echo "</table>";
            echo "</div>";


        } else {
            echo "<p>No assets found.</p>";
        }
        ?>
    </div>
</div>

<?php

if (isset($_POST['update_date'])) {
    $assetid = mysqli_real_escape_string($conn, $_POST['assetid']);
    $new_date = mysqli_real_escape_string($conn, $_POST['new_date']);


    // Update the asset's inception date
    $updatesql = "UPDATE asset SET purchasedate = '$new_date' WHERE assetid = '$assetid'";

    if (mysqli_query($conn, $updatesql)) {
        echo "<script>alert('Asset date updated successfully!'); window.location.href='';</script>";
    } else {
        echo "<script>alert('Error updating asset date.');</script>";
    }
}


if (isset($_GET['delete_asset'])) {
    $assetid = mysqli_real_escape_string($conn, $_GET['delete_asset']);

    // Delete  asset 
    $delete_sql = "DELETE FROM asset WHERE assetid = '$assetid'";

    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('Asset deleted successfully!'); window.location.href='editasset.php';</script>";
    } else {
        echo "<script>alert('Error deleting asset.');</script>";
    }
}

// check  activation
if (isset($_GET['activate_asset'])) {
    $assetid = mysqli_real_escape_string($conn, $_GET['activate_asset']);

    // Update asset status to Active
    $activate_sql = "UPDATE asset SET status = 'Activated' WHERE assetid = '$assetid'";

    if (mysqli_query($conn, $activate_sql)) {
        echo "<script>alert('Asset activated successfully!'); window.location.href='editasset.php';</script>";
    } else {
        echo "<script>alert('Error activating asset.');</script>";
    }
}

// chek setting asset to Pending
if (isset($_GET['pending_asset'])) {
    $assetid = mysqli_real_escape_string($conn, $_GET['pending_asset']);

    // Update the asset status to Pending
    $pending_sql = "UPDATE asset SET status = 'Pending' WHERE assetid = '$assetid'";

    if (mysqli_query($conn, $pending_sql)) {
        echo "<script>alert('Asset status set to Pending successfully!'); window.location.href='editasset.php';</script>";
    } else {
        echo "<script>alert('Error setting asset to Pending.');</script>";
    }
}

// cek  seting  asset to Inactive
if (isset($_GET['inactive_asset'])) {
    $assetid = mysqli_real_escape_string($conn, $_GET['inactive_asset']);

    // Update the asset status to Inactive
    $inactive_sql = "UPDATE asset SET status = 'Inactive' WHERE assetid = '$assetid'";

    if (mysqli_query($conn, $inactive_sql)) {
        echo "<script>alert('Asset status set to Inactive successfully!'); window.location.href='editasset.php';</script>";
    } else {
        echo "<script>alert('Error setting asset to Inactive.');</script>";
    }
}
?>

<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>

<?php
include "footer.php";
?>
