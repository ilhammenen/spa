<?php
include "header.php";
include "container.php";
include "connection.php";


$current_user_userid = $_SESSION['userid']; 


$sql = "SELECT * FROM asset WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'";
$result = mysqli_query($conn, $sql);


$userSql = "SELECT username FROM user WHERE userid = '" . mysqli_real_escape_string($conn, $current_user_userid) . "'";
$userResult = mysqli_query($conn, $userSql);
$userRow = mysqli_fetch_assoc($userResult);
$username = $userRow['username'] ?? 'User';
?>

</div>
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container bg-warning p-4">
        <div>
            <h2 class="h1-blockquote fw-bold">WELCOME</h2>
            <span class="h5 text-dark"><?php echo $username; ?></span>
        </div>
    </div>

    <!-- Carousel  punya dari bootstrap -->
    <div class="row justify-content-center bg-light">
        <div class="col-md-7 text-start">
            <br> 
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/carousel3.png" class="d-block w-100" alt="gambar">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/carousel1.png" class="d-block w-100" alt="gambar">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/carousel2.png" class="d-block w-100" alt="gambar">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

<!--tulis2 kosong -->
    <div class="container align-start">
        <br>
        <h3>Objective of Sistem Pemantauan Asset</h3>
        <p>
            The objective of this system is to efficiently monitor, manage, and track organizational assets in real-time. It aims to improve 
            asset utilization, reduce losses, and provide accurate reporting for better decision-making. This system centralizes asset information 
            for easy access and management, enables real-time tracking and status updates, and facilitates preventive maintenance scheduling and reminders. 
            Additionally, it generates comprehensive reports for audits and compliance, enhances accountability and transparency in asset handling, 
            and supports informed planning and budgeting for asset procurement and disposal.
        </p>
    </div>
</div>

<?php
include "footer.php";
?>
