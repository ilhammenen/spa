<?php
include "header.php";
include "connection.php";
include "container.php";

$current_user_userid = $_SESSION['userid']; 
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
<div class="container justify-center bg-warning p-4 ">
   <div>
      <h2 class="h1-blockquote text-center fw-bold">ASSET MANAGEMENT</h2>
   </div>
</div>

<div class="container justify-center-fixed md- mb-4"><br>

<?php
$searchTerm = "";
$whereClause = "userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'";

if (isset($_GET['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    $whereClause .= " AND (assetid LIKE '%$searchTerm%' OR categoryid LIKE '%$searchTerm%' OR department LIKE '%$searchTerm%')";
}

$sql = "SELECT * FROM asset WHERE $whereClause";
$result = mysqli_query($conn, $sql);
?>

<script>
  function confirmDelete(id){
    if(confirm("Are you sure you want to delete this asset? " + id)) {
      window.location.href="deleteassetid.php?id=" + id;
    }
  }
</script>

<div class="d-flex justify-center bg-secondary p-2 rounded mb-3">
  <form id="searchForm" class="form-inline d-flex" method="get" action="">
    <input id="searchInput" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" class="form-control me-2" type="search" placeholder="Search Asset ID / Category / Department" aria-label="Search">
    <button id="searchBtn" class="btn btn-warning" type="submit">Search</button>
  </form>
</div>

<?php
echo '<div class="table-responsive">';
echo '<table class="table table-sm table-bordered table-striped">';
echo "<tr><th class=\"table-warning text-center\">ASSET ID</th>
<th class=\"table-warning text-center\">DEPARTMENT</th>
<th class=\"table-warning text-center\">CATEGORY</th>
<th class=\"table-warning text-center\">VALUE</th>
<th class=\"table-warning text-center\">QUANTITY</th>
<th class=\"table-warning text-center\">INCEPTION DATE</th>
<th class=\"table-warning text-center\" colspan=\"3\">ACTION</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='text-center'>
                <td>{$row['assetid']}</td>
                <td>{$row['department']}</td>
                <td>{$row['categoryid']}</td>
                <td>RM {$row['value']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['purchasedate']}</td>
                <td><a class=\"btn btn-primary\" href=\"viewasset.php?id={$row['assetid']}\">View</a></td>
                <td><a class=\"btn btn-primary\" href=\"updatestaff.php?id={$row['assetid']}\">Update</a></td>
                <td><a class=\"btn btn-danger\" href=\"#\" onclick=\"confirmDelete('{$row['assetid']}')\">Delete</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='9'>No assets found.</td></tr>";
}

echo "</table>";
echo "</div>"; 

mysqli_close($conn);
?>
</div>
</div>

<br><br><br><br><br><br><br><br><br><br><br>
<?php include "footer.php"; ?>
