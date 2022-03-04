<?php
// Check existence of id parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM Mavens WHERE ID = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["ID"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $firstname = $row["FirstName"];
                $lastname = $row["LastName"];
                $couponcode = $row["CouponCode"];
                $address1 = $row['Address1'];
                $address2 = $row['Address2'];
                $email = $row["Email"];
                $city = $row["City"];
                $state = $row["State"];
                $postal = $row["PostalCode"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Maven</h1>

                    <div class="form-group">
                        <label>First Name</label>
                        <p><b><?php echo $row["FirstName"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <p><b><?php echo $row["LastName"]; ?></b></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Coupon Code</label>
                        <p><b><?php echo $row["CouponCode"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Address 1</label>
                        <p><b><?php echo $row["Address1"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Address2</label>
                        <p><b><?php echo $row["Address2"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <p><b><?php echo $row["City"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>State</label>
                        <p><b><?php echo $row["State"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Zip-Postal Code</label>
                        <p><b><?php echo $row["PostalCode"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Email or Phone</label>
                        <p><b><?php echo $row["Email"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Maven ID</label>
                        <p><b><?php echo $param_id; ?></b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back to Dashboard</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>