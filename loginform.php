<?php
//kalau dah masuk lepastu logout
if (isset($_GET['loggedout']) && $_GET['loggedout'] === 'true') {
    echo "<script>alert('You have successfully logged out.');</script>";
}

include "header.php";
include "connection.php";

if (isset($_POST["action"])) {
    $id = $_POST["userid"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE userid='$id' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    if ($rowcount) {
        $_SESSION["userid"] = $id;
        header('Location: menu.php');
        exit;
    } else {
        $login_error = "Wrong User ID or Password";
        echo "<script>
            $(document).ready(function() {
                alert('$login_error');
            });
        </script>";
    }
}

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    echo "<script>alert('You have successfully logged out!');</script>";
}
?>


<div class="col-12 text-start bg-white p-4 shadow ">

    <h1 class="h1 text-primary mb-4 text-center ">Log In</h1>
    <br>
    <div class="col-12 col-md-6 mx-auto bg-light p-4 rounded shadow">

    <form class=""method="POST" action="">
        <input type="hidden" name="action" value="login" />
        
        <div class="mb-3">
            <label for="userid" class="form-label ">User ID</label>
            <input type="text" id="userid" name="userid" class="form-control  " placeholder="enter your user id"
                value="<?php echo htmlspecialchars($_POST['userid'] ?? ''); ?>" required autofocus />
        </div>

      <div class="mb-3">
  <label for="password" class="form-label">Password</label>
  <div class="input-group">
    <input type="password" id="password" name="password" class="form-control" placeholder="enter your password" required />
    <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn">
      <i class="bi bi-eye-fill" id="togglePasswordIcon"></i>
    </button>
  </div>
</div>


        <div class="form-check mb-4">
            <input type="checkbox" class="form-check-input" id="remember" name="remember" />
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
<br><br>
        <input class="btn btn-primary w-100" type="submit" name="Login" value="Sign In" />
        <input class="btn btn-warning w-100 mt-2" type="reset" name="Reset" value="Reset" />
    
  
    <div class="card-footer text-center mt-3">
        Don't have an account? <a href="signup.php">Sign up</a>
    </div>

   <div class="footer-links text-center mt-3">
    <p>By signing in, you agree to our <a href="term.php" target="_blank" class="link-primary">Terms of Service</a> and <a class="link-primary" href="term.php" target="_blank">Privacy Policy</a></p>
</div>

    </form>

<br><br>


<script>// untuk eye fill dan eye slash
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
});
</script>

<?php
include "footer.php";
mysqli_close($conn);
?>
