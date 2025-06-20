<?php
include "connection.php";
include "header.php";
?>

<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
  <div class="container justify-center bg-warning p-4 ">
    <h2 class="h1-blockquote text-center fw-bold">VIEW USER</h2>
  </div>

  <div>
    <br>
    <?php

    if (isset($_GET['id'])) {
        $userid = mysqli_real_escape_string($conn, $_GET['id']);  // Escape user input to prevent SQL injection and userid= id
        $sql_user = "SELECT * FROM user WHERE userid = '$userid'";
        $result_user = mysqli_query($conn, $sql_user);


        if (mysqli_num_rows($result_user) > 0) {
            $row_user = mysqli_fetch_assoc($result_user);
            echo "<h5>User ID: " . $row_user['userid'] . "</h5>";
            echo "<h5>User Name: " . $row_user['username'] . "</h5>";
            echo "<h5>Department: " . $row_user['department'] . "</h5>";
            echo "<h5>Email: " . $row_user['email'] . "</h5>";

       
            $sql_active = "
                SELECT COUNT(*) AS active_count
                FROM asset 
                WHERE userid = '$userid' 
                AND status = 'In Used'
            ";

            $sql_pending = "
                SELECT COUNT(*) AS pending_count
                FROM asset 
                WHERE userid = '$userid' 
                AND status = 'Pending'
            ";

            $sql_activated = "
                SELECT COUNT(*) AS activated_count
                FROM asset 
                WHERE userid = '$userid' 
                AND status = 'Activated'
            ";

            $sql_inactive = "
                SELECT COUNT(*) AS inactive_count
                FROM asset 
                WHERE userid = '$userid' 
                AND status = 'Inactive'
            ";

        
            $result_active = mysqli_query($conn, $sql_active);
            $result_pending = mysqli_query($conn, $sql_pending);
            $result_activated = mysqli_query($conn, $sql_activated);
            $result_inactive = mysqli_query($conn, $sql_inactive);

          
            $active_data = mysqli_fetch_assoc($result_active);
            $pending_data = mysqli_fetch_assoc($result_pending);
            $activated_data = mysqli_fetch_assoc($result_activated);
            $inactive_data = mysqli_fetch_assoc($result_inactive);

      
            echo "<div class='text-start'>
                    <h5 class='fw-bold'>Total Active Assets: " . $active_data['active_count'] . "</h5>
                    <h5 class='fw-bold'>Total Pending Assets: " . $pending_data['pending_count'] . "</h5>
                    <h5 class='fw-bold'>Total Activated Assets: " . $activated_data['activated_count'] . "</h5>
                    <h5 class='fw-bold'>Total Inactive Assets: " . $inactive_data['inactive_count'] . "</h5>
                  </div>";
        } else {
            echo "<p class='text-start text-danger'>User not found.</p>";
        }
    } else {
        echo "<p class='text-start text-danger'>No user ID specified.</p>";
    }
    ?>
  </div>
</div>

<?php
include "footer.php";
?>
