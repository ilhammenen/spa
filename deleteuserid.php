<?php

include "connection.php";  


if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Check if the user is 'admin' to prevent the deletion of the admin account
    if ($userid == 'admin') {
        echo "<script>
                alert('You cannot delete the admin account.');
                window.location.href = 'edituser.php'; // Redirect to manage users page
              </script>";
        exit(); // Stop further execution
    }

    // SQL query to delete the user
    $sql = "DELETE FROM user WHERE userid = '$userid'";

    // Execute the delete query
    if (mysqli_query($conn, $sql)) {
        // If successful, show a success message and redirect
        echo "<script>
                alert('User deleted successfully!');
                window.location.href = 'edituser.php';  // Redirect to the user management page
              </script>";
    } else {
        // If the query fails, show an error message
        echo "<script>
                alert('Error deleting user: " . mysqli_error($conn) . "');
                window.location.href = 'edituser.php';  // Redirect to the user management page
              </script>";
    }
} else {
    // If 'userid' is not set, redirect to the user management page
    echo "<script>
            alert('Invalid user ID!');
            window.location.href = 'edituser.php';  // Redirect to the user management page
          </script>";
}

// Close the database connection
mysqli_close($conn);

// Include footer for the page
include "footer.php";
?>
