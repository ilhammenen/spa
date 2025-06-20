<?php
include "header.php";
include "connection.php";
include "container.php";

$current_user_userid = $_SESSION['userid'];


if (isset($_GET['id'])) {

    $assetid = mysqli_real_escape_string($conn, $_GET['id']);// for safety atau sql injection 
} else {
    echo "<script>alert('No asset ID provided.'); window.location.href='your-asset-management-page.php';</script>";
    exit();
}

$sql = "
    SELECT assetid, department, categoryid, value, quantity, purchasedate 
    FROM asset 
    WHERE assetid = '$assetid' AND userid = '$current_user_userid'
";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Asset not found.'); window.location.href='your-asset-management-page.php';</script>";
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department = mysqli_real_escape_string($conn, $_POST["department"]);
    $value = mysqli_real_escape_string($conn, $_POST["value"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    $update_sql = "
        UPDATE asset 
        SET department='$department', value='$value', quantity='$quantity' 
        WHERE assetid='$assetid' AND userid='$current_user_userid'
    ";

    if (mysqli_query($conn, $update_sql)) {
        echo "<script>alert('Asset updated successfully.'); window.location.href='management1.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating asset.');</script>";
    }
}
?>

<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container bg-warning p-4 mx-auto">
        <h2 class="h1-blockquote fw-bold text-center">UPDATE ASSET  <?php echo $row['assetid']; ?></h2>
    </div>
    <br>

    <div class="container rounded text-center">
        <div class="row justify-content-center">
            <div class="col-11 text-start bg-white p-4 shadow">
                <form method="post" action="">
                    <p>Asset ID: <?php echo $row['assetid']; ?></p>

                    <p>Change Department: 
    <span class="fw-bold text-danger">
        Last Department: <?php echo $row['department'].'*'; ?>
    </span>
</p>

                        <select name="department" class="text-start form-select" required>
                            <option value="FTMK" <?php if ($row['department'] == 'FTMK') echo "selected"; ?>>FTMK</option>
                            <option value="FKEKK" <?php if ($row['department'] == 'FKEKK') echo "selected"; ?>>FKEKK</option>
                            <option value="FKM" <?php if ($row['department'] == 'FKM') echo "selected"; ?>>FKM</option>
                            <option value="FTKEE" <?php if ($row['department'] == 'FTKEE') echo "selected"; ?>>FTKEE</option>
                            <option value="FTKMP" <?php if ($row['department'] == 'FTKMP') echo "selected"; ?>>FTKMP</option>
                        </select>
                    </p>

                                    <p>RM: <span class="fw-bold text-danger">
   Last Value: <?php echo 'RM '.$row['value'].'*'; ?>
    </span>
</p>
                        <input type="number" class="form-control-inline" name="value" id="valueInput"
                            min="0.00" max="9999999999.00" step="0.01" placeholder="00.00" required>
                    </p>
                     <p>Quantity: <span class="fw-bold text-danger">
        Last Quantity: <?php echo $row['quantity'].'*'; ?>
    </span>
</p> <input type="number" class="form-control-inline" name="quantity" id="quantityInput"
                        min="0" max="1000" required></p>

                    <input class="btn btn-primary w-100" type="submit" value="Update" />
                    <a class="btn btn-warning w-100 mt-2" href="management1.php">Cancel</a>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
