<?php
include "header.php";
include "container.php";
include "connection.php";

if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to view this report.";
    exit;
}

$current_user_userid = $_SESSION['userid'];
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
<div class="container bg-warning p-4 ">
    <h2 class="h1-blockquote text-center fw-bold">REPORT ASSETS</h2>
</div>

<!DOCTYPE html>
<html>
<head>
    <title>Asset Report</title>
</head>

<body>
<br>
<h2 class="h1-blockquote text-center fw-bold">Asset Report for User: <?php echo htmlspecialchars($current_user_userid); ?></h2>

<?php

// ada asset dan category 
$sql = "
    SELECT asset.assetid, asset.value, asset.quantity, asset.department, asset.purchasedate, category.categoryname,
           CASE
               WHEN asset.status = 'In Used' THEN 'In Used'
               ELSE 'Inactive'
           END AS asset_status
    FROM asset
    JOIN category ON asset.categoryid = category.categoryid

    WHERE asset.userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' ";// for safety 
$result = mysqli_query($conn, $sql);

// Count Database punya Aggregation "In Used" (Active) and "Inactive" assets
$sql_count_in_used = "
    SELECT COUNT(*) AS in_used_count FROM asset 
    WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' 
    AND status = 'In Used'
";

//SQL count inactive asset
$sql_count_inactive = "
    SELECT COUNT(*) AS inactive_count FROM asset 
    WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' 
    AND status != 'In Used'
";

// SQL Asset Value (all assets)
$sql_total_value = "
    SELECT SUM(value * quantity) AS total_value FROM asset 
    WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'
";

// SQL In Used Asset Value
$sql_total_in_used_value = "
    SELECT SUM(value * quantity) AS total_in_used_value FROM asset 
    WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' 
    AND status = 'In Used'
";

$result_count_in_used = mysqli_query($conn, $sql_count_in_used);
$result_count_inactive = mysqli_query($conn, $sql_count_inactive);
$result_total_value = mysqli_query($conn, $sql_total_value);
$result_total_in_used_value = mysqli_query($conn, $sql_total_in_used_value);

// Fetch counts
$in_used_count = mysqli_fetch_assoc($result_count_in_used)['in_used_count'];
$inactive_count = mysqli_fetch_assoc($result_count_inactive)['inactive_count'];

$total_value = mysqli_fetch_assoc($result_total_value)['total_value'];
$total_in_used_value = mysqli_fetch_assoc($result_total_in_used_value)['total_in_used_value'];


echo "<div class='text-center'>
        <h4>In Used Assets: {$in_used_count}</h4>
        <h4>Inactive Assets: {$inactive_count}</h4>
      </div>";

if (mysqli_num_rows($result) > 0) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered table-striped">';
    echo '<thead class="table-dark"><tr>
                <th>Asset ID</th>
                <th>Category</th>
                <th>Department</th>
                <th>Value (RM)</th>
                <th>Quantity</th>
                <th>Inception Date</th>
                <th>Status</th>
                <th>Total (RM)</th>
              </tr></thead><tbody>';

    $grand_total = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $total = $row['value'] * $row['quantity'];
        $grand_total += $total;

        echo "<tr>
                <td>{$row['assetid']}</td>
                <td>{$row['categoryname']}</td>
                <td>{$row['department']}</td>
                <td>RM " . number_format($row['value'], 2) . "</td>
                <td>{$row['quantity']}</td>
                <td>{$row['purchasedate']}</td>
                <td>{$row['asset_status']}</td>
                <td>RM " . number_format($total, 2) . "</td>
              </tr>";
    }

    echo "</tbody></table></div>";

} else {
    echo "<div class='alert alert-warning'>No asset records found.</div>";
}

mysqli_close($conn);
?>


<div class="text-end mt-3" style="position: relative; bottom: 10px; right: 10px;">
    <h4><strong>Total In Used Asset Value: RM <?php echo number_format($total_in_used_value, 2); ?></strong></h4>
    <h4><strong>Total Asset Value: RM <?php echo number_format($total_value, 2); ?></strong></h4>
    
</div>

<div class="text-right mt-3">
    <button class="btn btn-outline-primary btn-sm" onclick="window.print()">Download as PDF</button>
</div>

<p class="generated-date text-center"><strong>Generated on:</strong> <?php echo date("Y-m-d H:i:s"); ?></p>

<br><br>

<?php include "footer.php"; ?>
</body>
</html>
