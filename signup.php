<!DOCTYPE html>
<title>User Registration</title>

<?php
include "header.php";
include "connection.php";
include "container.php";
?>

<div class="col- text-start bg-white p-4 shadow">
    <h1 class="text-primary text-center">User Registration</h1>

    <div class="col-12 col-md-6 mx-auto bg-light p-4 rounded shadow">
        <form name="myForm" class="form" method="post" action="">
            <p>
                User Name:
                <input class="form-control text-uppercase" type="text" name="username" id="username" size="50" required
                       pattern="[A-Za-z\s]{1,50}" title="Fullname must be A-Z alphabet characters and spaces only.">
            </p>

            <p>
                User ID:
                <input class="form-control" type="text" name="userid" size="50" required
                       pattern="[A-Za-z0-9]{1,20}" title="User ID must be 1-20 alphanumeric characters.">
            </p>

            <p>
                Department:
                <select name="department" class="form-select" required>
                    <option value="">Select Department </option>
                    <option value="FTMK">FTMK</option>
                    <option value="FKEKK">FKEKK</option>
                    <option value="FKM">FKM</option>
                    <option value="FTKEE">FTKEE</option>
                    <option value="FTKMP">FTKMP</option>
                </select>
            </p>

            <p>
                Role:
                <input type="radio" name="role" value="staff" class="form-check-input" required> Staff &nbsp;&nbsp;
                <input type="radio" name="role" value="student" class="form-check-input"> Student&nbsp;&nbsp;
                <input type="radio" name="role" value="teacher" class="form-check-input"> Lecturer&nbsp;&nbsp;
                <input type="radio" name="role" value="civilservant" class="form-check-input"> Civil Servant&nbsp;&nbsp;
                <input type="radio" name="role" value="staff" class="form-check-input" required> Others&nbsp;&nbsp;
            </p>

            <p>
                Email:
                <input type="email" class="form-control" name="email" size="50" required
                       title="Please enter a valid email address.">
            </p>

            <p>Password:</p>
            <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn">
                    <i id="togglePasswordIcon" class="bi bi-eye-fill"></i>
                </button>
            </div>

            <input class="btn btn-primary w-100" type="submit" name="update" value="Register" />
            <input class="btn btn-warning w-100 mt-2" type="reset" name="Reset" value="Reset" />
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userid = $_POST["userid"];
            $username = strtoupper($_POST["username"]);
            $password = $_POST["password"];
            $department = $_POST["department"];
            $email = $_POST["email"];
            $role = $_POST["role"];

            $check = "SELECT * FROM user WHERE userid='$userid'";
            $sql = mysqli_query($conn, $check);

            if (mysqli_num_rows($sql) > 0) {
                // Jquery
                $terlebihmessage = " User ID already exists!";
                echo "<script>
                    $(document).ready(function() {
                        alert('$terlebihmessage');
                    });
                </script>";
            } elseif (empty($userid) || empty($username) || empty($password) || empty($department) || empty($email) || empty($role)) {
                //J query
                $fillmessage = " All fields are required.";
                echo "<script>
                    $(document).ready(function() {
                        alert('$fillmessage');
                    });
                </script>";
            } else {
                $query = "INSERT INTO user (userid, username, password, department, email, role) 
                          VALUES ('$userid', '$username', '$password', '$department', '$email', '$role')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $successmessage = " Registration successful! You can now log in.";
                    echo "<script>
                        $(document).ready(function() {
                            alert('$successmessage');
                            window.location.href = 'loginform.php';
                        });
                    </script>";
                } else {
                    $failmessage = " Registration failed. Please try again.";
                    echo "<script>
                        $(document).ready(function() {
                            alert('$failmessage');
                        });
                    </script>";
                }
            }
        }
        ?>
    </div>

    <div class="card-footer text-center mt-3 mb-3"> 
        Already have an account? <a href="loginform.php">log in</a>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("togglePasswordBtn");
    const passwordInput = document.getElementById("password");
    const icon = document.getElementById("togglePasswordIcon");

    toggleBtn.addEventListener("click", function () {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";
        icon.classList.toggle("bi-eye-fill", !isPassword);
        icon.classList.toggle("bi-eye-slash-fill", isPassword);
    });

//uppercase java
    document.getElementById("username").addEventListener("input", function () {
        this.value = this.value.toUpperCase(); 
    });
});
</script>

<?php 
include "footer.php";
?>
