<?php
session_start();
$userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--mobile punya bagi elok-->
  <title>Sistem Pemantauan Aset</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="main.js"></script>
</head>

<body>


<div class="spinner-wrapper">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>


<div id="header" class="text-left text-white p-3"
     style="background: linear-gradient(90deg, rgb(11, 15, 28) -50%, rgb(2, 15, 131) 100%);">
  <a class="navbar-brand" href="<?= $userid ? 'menu.php' : 'about.php' ?>">
    <img src="assets/SPA-01.png" alt="spa" width="120" height="60" class="d-inline-block align-text-top">
  </a>
  <span class="h5 text-white">Sistem Pemantauan Aset</span>
  <div class="d-flex justify-content-between align-items-center mt-2">
    <span class="h5 text-light"><?= htmlspecialchars($userid) ?></span>
  </div>
</div>


<nav class="navbar navbar-expand-lg navbar-light bg-light shadow rounded">
  <div class="container-fluid">
    <a class="navbar-brand d-lg-none" href="<?= $userid ? 'menu.php' : 'about.php' ?>">
    <img src="assets/SPA-01.png" alt="Logo" width="80" height="40">
    </a>

    <button class="navbar-toggler" type="button" 
    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" 
            aria-label="Toggle navigation">


      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if ($userid): ?>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-warning mx-1" href="menu.php">
              <i class="bi bi-house-door-fill"></i>
            </a>
          </li>
          <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="management1.php">Management</a></li>
          <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="apply1.php">Apply</a></li>
          <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="status.php">Status</a></li>
          <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="report.php">Report</a></li>

          <?php if ($userid === "admin"): ?>
            <li class="nav-item dropdown">
              <a class="nav-link btn btn-outline-warning" href="#" role="button" data-bs-toggle="dropdown">
                Editor
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item btn btn-outline-warning" href="edituser.php">User</a></li>
                <li><a class="dropdown-item btn btn-outline-warning" href="editasset.php">Assets</a></li>
                <li><a class="dropdown-item btn btn-outline-warning" href="help.php">Help For Dev</a></li>
              </ul>
            </li>
          <?php endif; ?>


          <li class="nav-item">
            <a class="nav-link text-primary mx-1" href="usersetting.php">
              <i class="bi bi-person-fill"></i> User Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger mx-1" href="logout.php">
              <i class="bi bi-door-open-fill"></i> Logout
            </a>
          </li>

        <?php else: ?>
      <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="loginform.php">Login</a></li>
        <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="signup.php">Register</a></li>
      <li class="nav-item"><a class="nav-link btn btn-outline-warning mx-1" href="contact.php">Contact</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll("#navbarSupportedContent .nav-link");
    const currentPage = window.location.pathname.split("/").pop();
    links.forEach(link => {
      const linkPage = link.getAttribute("href").split("/").pop();
      if (linkPage === currentPage) {
        link.classList.add("active-orange");
      } else {
        link.classList.remove("active-orange");
      }
      link.addEventListener("click", () => {
        links.forEach(l => l.classList.remove("active-orange"));
        link.classList.add("active-orange");
      });
    });
  });
</script>

</body>

</html>
