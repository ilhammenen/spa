<?php
include "header.php";
include "connection.php";
include "container.php";

// Get current logged-in user id from session
$current_user_userid = $_SESSION['userid'];
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container justify-center bg-warning p-4 ">
        <h2 class="h1-blockquote text-center fw-bold">ASSET STATUS</h2>
    </div>

    <div class="container justify-center-fixed md- mb-4"><br>

    <?php
    // cari untuk asset id, category
    // Handle search query
    $searchTerm = "";
    $whereClause = "asset.userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'";

    if (isset($_GET['search'])) {
        $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
        $whereClause .= " AND (
            asset.assetid LIKE '%$searchTerm%' 
            OR asset.department LIKE '%$searchTerm%' 
            OR category.categoryname LIKE '%$searchTerm%'
        )";
    }

    // SQL to retrieve assets for the current user with the search query
    $sql = "
        SELECT asset.assetid, asset.department, category.categoryname, asset.status, asset.purchasedate
        FROM asset
        JOIN category ON asset.categoryid = category.categoryid
        WHERE $whereClause
    ";

    $result = mysqli_query($conn, $sql);

    // Handle "Set Pending" action here
    if (isset($_GET['set_pending'])) {
        $assetid = mysqli_real_escape_string($conn, $_GET['set_pending']);
        $pending_sql = "UPDATE asset SET status = 'Pending' WHERE assetid = '$assetid' AND status = 'Inactive'";

        if (mysqli_query($conn, $pending_sql)) {
            echo "<script>alert('Asset status set to Pending successfully!'); window.location.href='status.php';</script>";
        } else {
            echo "<script>alert('Error setting asset to Pending.');</script>";
        }
    }

    ?>

    <div class="d-flex justify-center bg-secondary p-2 rounded mb-3">
        <form id="searchForm" class="form-inline d-flex" method="get" action="">
            <input id="searchInput" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" class="form-control me-2" type="search" placeholder="Search Asset ID / Department / Category" aria-label="Search">
            <button id="searchBtn" class="btn btn-warning" type="submit">Search</button>
        </form>
    </div>

    <?php
    echo '<div class="row mt-4">';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $statusclass = "";
            $statuslabel = "";
            $actionbutton = "";

            if ($row["status"] == "Activated") {
                $statusclass = "text-info fw-bold";
                $statuslabel = "Activated ";
                $actionbutton = "<a href='activateasset.php?assetid=" . $row['assetid'] . "' class=\"btn btn-success btn-sm\">Activate Now</a>";


            } elseif ($row["status"] == "Pending") {
                $statusclass = "text-warning fw-bold";
                $statuslabel = "Pending <br><br>";


            } elseif ($row["status"] == "In Used") {
                $statusclass = "text-success fw-bold";
                $statuslabel = "In Used <br><br>";

            } else {
               
                $statusclass = "text-danger fw-bold";
                $statuslabel = "Inactive";
                $actionbutton = "<a href='?set_pending=" . $row['assetid'] . "' class=\"btn btn-warning btn-sm\" 
                onclick='return confirm(\"Are you sure you want to set this asset as Pending?\");'>Set Pending</a>";
            }

            echo '<div class="col-12 col-md-3 col-lg-4 mb-4">';  
            echo '<div class="card shadow-sm p-3 rounded" style="border: 4px solid rgb(25, 24, 134);">';  // Added outline color and width
            echo "<h5 class=\"card-title\"><strong>Asset ID:</strong> " . $row["assetid"] . "</h5>";
            echo "<p><strong>Department:</strong> " . $row["department"] . "</p>";
            echo "<p><strong>Category:</strong> " . $row["categoryname"] . "</p>";
            echo "<p><strong>Date:</strong> " . $row["purchasedate"] . "</p>";
            echo "<p><strong>Status:</strong> <span class='$statusclass'>$statuslabel</span></p>";
            echo "<p>" . $actionbutton . "</p>";
            echo "</div></div>";
        }
    } else {
        echo "<div class='col-12'><p>No assets found for you.</p></div>";
    }

    echo "</div>"; // close row

    mysqli_close($conn);
    ?>

    </div>
</div>

<script>
function confirmActivate(assetid) {
    if (confirm("Are you sure you want to activate this asset?")) {
        if (confirm("Please double confirm. Do you really want to activate?")) {
            window.location.href = "activateasset.php?assetid=" + assetid;
        }
    }
}
</script>

<?php include "footer.php"; ?>
