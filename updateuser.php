<?php
include "connection.php";
include "header.php";

if (isset($_GET['userid'])) {
    $userid = mysqli_real_escape_string($conn, $_GET['userid']);

    // Fetch the user data to populate the form fields
    $sql = "SELECT * FROM user WHERE userid = '$userid'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // If the user is not found
    if (!$user) {
        echo "<p>User not found.</p>";
        exit;
    }
} else {
    echo "<p>No UserID specified.</p>";
    exit;
}

// Update the user data when the form is submitted
if (isset($_POST['update']))  //dekat submit
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if ($user['userid'] == 'admin' && !empty($password)) {
        echo "<script>alert('Admin password cannot be changed.');</script>";
        exit;
    }

    // Only update the password if it's provided (i.e., not empty)
    if (!empty($password)) {
        $password_update_query = ", password = '$password'";  //nak tukar password tanpa hashes
    } else {
        $password_update_query = "";  
    }

    $update_sql = "UPDATE user SET username = '$username', email = '$email', role = '$role', department = '$department' $password_update_query WHERE userid = '$userid'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('User updated successfully.'); window.location.href='edituser.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating user.');</script>";
    }
}
?>

<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container justify-center bg-warning p-4">
        <h2 class="h1-blockquote text-center fw-bold">UPDATE USER</h2>
    </div>
    <br>
    <form method="POST">

        <div class="form-group fw-bold">
            <label for="userid">User Id:</label>
            <input type="text" id="userid" name="userid" class="form-control" value="<?php echo htmlspecialchars($user['userid']); ?>" readonly>
        </div>

        <div class="form-group fw-bold">
            <label for="username">User Name:</label>
            <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>

        <div class="form-group fw-bold">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-select" required>
                <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                <option value="civil servant" <?php if ($user['role'] == 'civil servant') echo 'selected'; ?>>Civil Servant</option>
                <option value="others" <?php if ($user['role'] == 'others') echo 'selected'; ?>>Others</option>
            </select>
        </div>

        <div class="form-group fw-bold">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>

        <div class="form-group fw-bold">
            <label for="department">Department:</label>
            <select name="department" id="department" class="form-select" required>
                <option value="">Select Department</option>
                <option value="FTMK" <?php if ($user['department'] == 'FTMK') echo 'selected'; ?>>FTMK</option>
                <option value="FKEKK" <?php if ($user['department'] == 'FKEKK') echo 'selected'; ?>>FKEKK</option>
                <option value="FKM" <?php if ($user['department'] == 'FKM') echo 'selected'; ?>>FKM</option>
                <option value="FTKEE" <?php if ($user['department'] == 'FTKEE') echo 'selected'; ?>>FTKEE</option>
                <option value="FTKMP" <?php if ($user['department'] == 'FTKMP') echo 'selected'; ?>>FTKMP</option>
            </select>
        </div>

        <br>

        <div class="form-group fw-bold">
            <label for="password">Password (Leave blank to keep current password):</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password if changing">
        </div>

        <br>
        <button type="submit" name="update" class="btn btn-primary">Update User</button>
        <a href="edituser.php" class="btn btn-warning">Cancel</a>
    </form>
</div>

<?php
include "footer.php";
?>
