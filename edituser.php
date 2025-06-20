<?php
include "connection.php";
include "header.php";

// Capture the search term from the form
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Construct the SQL query based on the search term
$sql = "SELECT * FROM user WHERE userid LIKE '%$searchTerm%' OR username LIKE '%$searchTerm%' OR department LIKE '%$searchTerm%'";

// Execute the query
$result = mysqli_query($conn, $sql);
?>

<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
  <div class="container justify-center bg-warning p-4 ">
    <h2 class="h1-blockquote text-center fw-bold">EDIT USER</h2>
  </div>

  <div>
    <br>
    
    <div class="d-flex justify-center bg-secondary p-2 rounded mb-3">
      <form id="searchForm" class="form-inline d-flex" method="get" action="">
        <input id="searchInput" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" 
        class="form-control me-2" 
        type="search"
         placeholder="Search ID / Name " aria-label="Search">
        <button id="searchBtn" class="btn btn-warning" type="submit">Search</button>
      </form>
    </div>
    
    <?php

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' class=' table table-sm table-bordered table-striped'>";
        echo "<tr><th class='text-center table-warning'>USERID</th><th class='table-warning text-center'>NAME</th><th class='table-warning text-center' colspan='3'>ACTION</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
        
            if ($row["userid"] == "admin") {
                echo "<tr class='text-center'>
                        <td class = ''>" . $row["userid"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td colspan='3' class=''>Admin, cannot be edited</td> <!-- Admin cannot be edited -->
                      </tr>";
            } else {
                echo "<tr class='text-center'>
                        <td>" . $row["userid"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>
                            <a href='viewuser.php?id=" . $row["userid"] . "' class='btn btn-primary'>View</a>
                        </td>
                        <td>
                            <a href='updateuser.php?userid=" . $row["userid"] . "' class='btn btn-primary'>Update</a>
                        </td>
                        <td>
                            <a href='deleteuserid.php?userid=" . $row["userid"] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p>No users found.</p>";
    }
    ?>
  </div>
</div>

<?php
include "footer.php";
?>
