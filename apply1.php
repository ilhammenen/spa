<?php
include "connection.php";
include "header.php";


$userid = $_SESSION['userid']; 

// untuk send dekat google form nanti
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assetid = $_POST["assetid"];
    $department = $_POST["department"];
    $categoryid = $_POST["categoryid"];
    $value = $_POST["value"];
    $quantity = $_POST["quantity"];
    $purchasedate = $_POST["purchasedate"];

    
    $check = "SELECT * FROM asset WHERE assetid='$assetid'";
    $sql = mysqli_query($conn, $check);
// error handling
    if (mysqli_num_rows($sql) > 0) {
        $terlebihmessage = "Asset ID already exists!";
        echo "<script> $(document).ready(function() {alert('$terlebihmessage');}); </script>";
    } elseif (empty($assetid) || empty($department) || empty($categoryid) || empty($value) || empty($quantity) || empty($purchasedate)) {
        $fillmessage = "All fields are required.";
        echo "<script>$(document).ready(function() { alert('$fillmessage'); });</script>";
    } else {

        $category_check = "SELECT * FROM category WHERE categoryid='$categoryid'";
        $category_result = mysqli_query($conn, $category_check);

        if (mysqli_num_rows($category_result) == 0) {
         
            $category_error = "Category ID does not exist in the category table!";
            echo "<script> $(document).ready(function() {alert('$category_error');}); </script>";
        } else {
           //insert dalam query = result
            $query = "INSERT INTO asset (assetid, userid, department, categoryid, value, quantity, purchasedate) 
                     VALUES ('$assetid', '$userid', '$department', '$categoryid', '$value', '$quantity', '$purchasedate')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $successamessage = "Registration Assets successful!";
                echo "<script>
                    $(document).ready(function() {
                        alert('$successamessage');
                    });
                </script>";
            } else {
                $failamessage = "Registration failed. Please try again.";
                echo "<script>
                    $(document).ready(function() {
                        alert('$failamessage');
                    });
                </script>";
            }
        }
    }
}
?>
<!-- form biasa -->
<div class="col-12 col-md-9 mx-auto bg-light p-4 rounded shadow">
    <div class="container bg-warning p-4 mx-auto">
        <h2 class="h1-blockquote fw-bold text-center">APPLY</h2>
    </div>
    <br>

    <div class="container rounded text-center">
        <div class="row justify-content-center">
            <div class="col-11 text-start bg-white p-4 shadow">
                <h3 class="display-6 text-start fw-bold">Insert Your Asset Here</h3>

                <form name="myForm" class="size-" method="post" action="">
                    <p class="text-start h4">User ID: <?php echo $userid; ?></p>
  <p>Asset ID:
    <input class="form-control" type="text" name="assetid" size="50"
           pattern="[A-Za-z]{1}[0-9]{7}" placeholder="L1234567"
           title="Asset ID must be 1 letter followed by 7 digits (example: A1234567)"
           required>
</p>

                    <p>Department Location:
                        <select name="department" class="text-start form-select" required>
                            <option value="FTMK">FTMK</option>
                            <option value="FKEKK">FKEKK</option>
                            <option value="FKM">FKM</option>
                            <option value="FTKEE">FTKEE</option>
                            <option value="FTKMP">FTKMP</option>
                        </select>
                    </p>

                    <p>Category:
                        <select name="categoryid" class="text-start form-select" required>
                            <option value="electronics">Electronic Equipment</option>
                            <option value="books">Books & Library Materials</option>
                            <option value="furniture">Furniture & Fixtures</option>
                            <option value="vehicles">Vehicles</option>
                            <option value="lab-equipment">Laboratory Equipment</option>
                            <option value="software">Software & Licenses</option>
                            <option value="building">Buildings & Infrastructure</option>
                            <option value="other">Other</option>
                        </select>
                    </p>

                    <p>Value: RM
                        <input type="number" class="form-control-inline" name="value" id="valueInput"
                            min="0.00" max="9999999999.00" step="0.01" placeholder="00.00" required>
                    </p>

                    <p>Quantity: <input type="number" class="form-control-inline" name="quantity" id="quantityInput"
                        min="0" max="1000" required></p>

                    <p>Purchase Date: <input class="form-control-inline" type="date" name="purchasedate" required></p>

                    <p class="h5 text-danger">Total: RM <span id="demo">0.00</span></p>

                    <input class="btn btn-primary w-100" type="submit" name="update" value="Update" />
                    <input class="btn btn-warning w-100 mt-2" type="reset" name="Reset" value="Reset" />
                </form>

                <script>//untuk keluarkan total
                    const valueInput = document.getElementById("valueInput");
                    const quantityInput = document.getElementById("quantityInput");
                    const totalDisplay = document.getElementById("demo");

                    function updateTotal() {
                        const value = parseFloat(valueInput.value) || 0;
                        const quantity = parseInt(quantityInput.value) || 0;
                        const total = value * quantity;
                        totalDisplay.innerText = total.toFixed(2);
                    }

                    valueInput.addEventListener("input", updateTotal);
                    quantityInput.addEventListener("input", updateTotal);
                </script>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
