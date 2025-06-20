<!DOCTYPE html>
<?php
if (isset($_GET['loggedout']) && $_GET['loggedout'] === 'true') {
    echo "<script>alert('You have successfully logged out.');</script>";
}
?>

    <?php
    include "header.php";
    include "connection.php";
    include "container.php";
    ?> 

<!--TULIS KOSONGGG -->



    <div class="container p-4 shadow mb-6">
         <h1 class="display-4 text-center fw-bold mb-4">About</h1>

    <div class="text-center mb-5 px-3 ">
        <h4 class="text-secondary">Welcome to Sistem Pemantauan Aset</h4>
        <p class="lead">
            Sistem Pemantauan Aset is a web-based application designed to monitor and manage assets
        </p>
    </div>
        
        <div class="row align-items-center bg-light p-4 shadow mb-4 fade-in">
            <div class="col-md-6 text-center">
                <img src="assets/mission.png" alt="Our Mission" class="img-fluid rounded img-hover-rotate" width="250">
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body bg-white">
                        <h3 class="card-title fw-bold">Our Mission</h3>
                        <p class="card-text">
                            To develop an efficient, transparent, and integrity-driven asset monitoring system to ensure that government asset management
                             is implemented systematically, holistically, and 
                            continuously in support of the strategic goals of the public sector.
                        </p>
                    </div>
                </div>
            </div>
        </div>

      
        <div class="row align-items-center flex-md-row-reverse p-4 shadow mb-4 fade-in">
            <div class="col-md-6 text-center">
                <img src="assets/team.png" alt="Our Team" class="img-fluid rounded img-hover-rotate" width="250">
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Our Team</h3>
                        <p class="card-text">
                            We value honesty, responsibility, teamwork, efficiency, innovation, and data security to ensure the best management of government assets.
                        </p>
                    </div>
                </div>
            </div>
        </div>

      
        <div class="row align-items-center bg-light p-4 shadow mb-4 fade-in">
            <div class="col-md-6 text-center">
                <img src="assets/value.png" alt="Our Values" class="img-fluid rounded img-hover-rotate" width="250">
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Our Values</h3>
                        <p class="card-text">
                            We value integrity, collaboration, and innovation. These principles guide our work and help us build long-term relationships.
                        </p>
                    </div>
                </div>
            </div>
        </div>

         
        <div class="row align-items-center flex-md-row-reverse p-4 shadow mb-4 fade-in">
            <div class="col-md-6 text-center">
                <img src="assets/vision.png" alt="Our Team" class="img-fluid rounded img-hover-rotate" width="250">
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">Our Vision</h3>
                        <p class="card-text">
                           Our vision is to help  agencies manage their assets better 
                           by making the process more transparent, efficient, and reliable. We want 
                           every asset to be easy to track and maintain .we aim to support better service 
                           and stronger accountability in the public sector.
                        </p>
                    </div>
                </div>
            </div>
             <div class="d-flex flex-column align-items-center gap-3">
                 <br>
      <a href="loginform.php" class="btn btn-primary w-50">Login</a>
      <a href="signup.php" class="btn btn-outline-primary w-50">Sign Up</a>
    </div>
        </div>

    </div>

    <?php include "footer.php"; ?>


