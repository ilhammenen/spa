<?php
include "header.php";
include "container.php";
include "connection.php";

if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to access the user settings.";
    exit;
}

$current_user_userid = $_SESSION['userid'];

$sql = "SELECT * FROM user WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found.";
    exit;
}

if (isset($_POST['update'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($userid !== $current_user_userid) {
        $check_userid = "SELECT * FROM user WHERE userid = '$userid'";
        $result_check = mysqli_query($conn, $check_userid);
       if (mysqli_num_rows($result_check) > 0) 
    echo "<script>
        alert('User ID already exists. Please choose a different one.');
        window.location.href = 'usersetting.php';
    </script>";
    exit;
}

    if (!empty($password)) {
        $update_sql = "UPDATE user 
                       SET userid = '$userid', username = '$username', email = '$email', department = '$department', password = '$password' 
                       WHERE userid = '$current_user_userid'";
    } else {
        $update_sql = "UPDATE user 
                       SET userid = '$userid', username = '$username', email = '$email', department = '$department' 
                       WHERE userid = '$current_user_userid'";
    }

    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['userid'] = $userid;
        echo "<script>alert('User settings updated successfully.'); window.location.href='usersetting.php';</script>";
    } else {
        echo "<script>alert('Error updating user settings.');</script>";
    }
}
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container bg-warning p-4">
        <h2 class="h1-blockquote fw-bold text-center">USER SETTINGS</h2>
    </div>

    <div class="container">
        <form method="POST" action="usersetting.php">
            <div class="form-group">
                <label for="userid">User ID:</label>
                <input type="text" id="userid" name="userid" class="form-control" 
                       value="<?php echo htmlspecialchars($user['userid']); ?>" required
                       pattern="[A-Za-z0-9]{1,20}" 
                       title="User ID must be 1–20 alphanumeric characters.">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" 
                       value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <select name="department" id="department" class="form-select" required>
                    <option value="FTMK" <?php if ($user['department'] == 'FTMK') echo 'selected'; ?>>FTMK</option>
                    <option value="FKEKK" <?php if ($user['department'] == 'FKEKK') echo 'selected'; ?>>FKEKK</option>
                    <option value="FKM" <?php if ($user['department'] == 'FKM') echo 'selected'; ?>>FKM</option>
                    <option value="FTKEE" <?php if ($user['department'] == 'FTKEE') echo 'selected'; ?>>FTKEE</option>
                    <option value="FTKMP" <?php if ($user['department'] == 'FTKMP') echo 'selected'; ?>>FTKMP</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">New Password (Leave blank to keep current password):</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password if changing">
            </div>

            <br>
            <button type="submit" name="update" class="btn btn-primary">Update Settings</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
