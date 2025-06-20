<?php
include "header.php";
include "container.php";
include "connection.php";

if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to access the dashboard.";
    exit;
}

$current_user_userid = $_SESSION['userid'];

// Query to get the latest purchased date
$sql = "SELECT MAX(purchasedate) AS latest_date FROM asset WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$purchasedate = $row['latest_date'] ?? 'N/A';

$formattedDate = $purchasedate !== 'N/A' ? date("F j, Y", strtotime($purchasedate)) : 'N/A';

// Count assets based on their status
$countPending = "SELECT COUNT(*) AS pending_count FROM asset WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' AND status = 'Pending'";
$countActivated = "SELECT COUNT(*) AS activated_count FROM asset WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' AND status = 'Activated'";
$countInactive = "SELECT COUNT(*) AS inactive_count FROM asset WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' AND status = 'Inactive'";
$countInUsed = "SELECT COUNT(*) AS in_used_count FROM asset WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "' AND status = 'In Used'";

$pendingResult = mysqli_query($conn, $countPending);
$activatedResult = mysqli_query($conn, $countActivated);
$inactiveResult = mysqli_query($conn, $countInactive);
$inUsedResult = mysqli_query($conn, $countInUsed);

$pendingCount = mysqli_fetch_assoc($pendingResult)['pending_count'];
$activatedCount = mysqli_fetch_assoc($activatedResult)['activated_count'];
$inactiveCount = mysqli_fetch_assoc($inactiveResult)['inactive_count'];
$inUsedCount = mysqli_fetch_assoc($inUsedResult)['in_used_count'];
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container bg-warning p-4">
        <h2 class="h1-blockquote text-center fw-bold">DASHBOARD</h2>
    </div>

    <div class="container text-center my-4">
        <div class="card-group">
            <div class="card">
                <div class="card-img-top text-center mt-3">
                    <i class="bi bi-pie-chart-fill" style="font-size: 3rem;"></i>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary" href="management1.php">
                        <h5 class="card-title">Assets Management</h5>
                    </a>
                    <p class="card-text mt-2">View, Delete and Update</p>
                    <p class="card-text"><small class="text-muted">Last updated: <?php echo $formattedDate; ?></small></p>
                </div>
            </div>

            <div class="card">
                <div class="card-img-top text-center mt-3">
                    <i class="bi bi-file-spreadsheet-fill" style="font-size: 3rem;"></i>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary" href="apply1.php">
                        <h5 class="card-title">Assets Appliances</h5>
                    </a>
                    <p class="card-text mt-2">Apply your assets and make sure they are legally yours</p>
                    <p class="card-text"><small class="text-muted">Last updated: <?php echo $formattedDate; ?></small></p>
                </div>
            </div>

            <div class="card">
                <div class="card-img-top text-center mt-3">
                    <i class="bi bi-printer-fill" style="font-size: 3rem;"></i>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-primary" href="report.php">
                        <h5 class="card-title">Asset Report</h5>
                    </a>
                    <p class="card-text mt-2">Generate detailed reports on your assets for analysis and decision-making.</p>
                    <p class="card-text"><small class="text-muted">Last updated: <?php echo $formattedDate; ?></small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Display counts for Pending, Activated, Inactive, and In Used assets -->
    <div class="container text-center my-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Assets Pending</h5>
                        <p class="card-text h4 fw-bold"><?php echo $pendingCount; ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Activated Assets</h5>
                        <p class="card-text h4 fw-bold"><?php echo $activatedCount; ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Inactive Assets</h5>
                        <p class="card-text h4 fw-bold"><?php echo $inactiveCount; ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">In Used Assets</h5>
                        <p class="card-text h4 fw-bold"><?php echo $inUsedCount; ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
