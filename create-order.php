<?php
// Include config file to make database connection
require_once "config.php";
 
// Define variables and initialize with empty values
$ordername = $orderdate = $couponcode = $ordernumber = $custid = $total = "";
$ordername_err = $orderdate_err = $couponcode_err = $ordernumber_err = $custid_err = $total_err = "";
 
// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate the name on the order
    $input_ordername = trim($_POST["OrderName"]);
    if(empty($input_ordername)){
        $ordername_err = "Please enter the name on the order.";
    } else{
        $ordername = $input_ordername;
    }

    // Validate Order Date
    $input_orderdate = trim($_POST["OrderDate"]);
    if(empty($input_orderdate)){
        $orderdate_err = "Please enter the date of the order.";
    } else{
        $orderdate = $input_orderdate;
    }
    
    // Validate Coupon Code
    $input_couponcode = trim($_POST["CouponCode"]);
    if(empty($input_couponcode)){
        $couponcode_err = "Please enter a Coupon Code.";     
    } else{
        $couponcode = $input_couponcode;
    }
    
    // Validate Order Number
    $input_ordernumber = trim($_POST["OrderNumber"]);
    if(empty($input_ordernumber)){
        $ordernumber_err = "Please enter the order number";     
    } else{
        $ordernumber = $input_ordernumber;
    }
    
    // Validate the Customer ID in the Maven database
    $input_custid = trim($_POST["CustID"]);
    if(empty($input_custid)){
        $city_err = "Please enter the Customer ID";     
    } else{
        $custid = $input_custid;
    }

    //Validate the order dollar amount
    $input_total = trim($_POST["Total"]);
    if(empty($input_total)){
        $total_err = "Please enter the order total dollars";     
    } else{
        $total = $input_total;
    }

    // Check input errors before inserting in database
    if(empty($ordername_err) && empty($orderdate_err) && empty($couponcode_err) && empty($ordernumber_err) && empty($custid_err) && empty($total_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Orders (OrderName, OrderDate, CouponCode, OrderNumber, CustID, Total) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssii", $param_ordername, $param_orderdate, $param_couponcode,$param_ordernumber, $param_custid, $param_total);
            
            // Set parameters
            $param_ordername = $ordername;
            $param_orderdate = $orderdate;
            $param_couponcode = $couponcode;
            $param_ordernumber = $ordernumber;
            $param_custid = $custid;
            $param_total = $total;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>

    <link rel="icon" href="https://i0.wp.com/www.mynaturesrite.com/wp-content/uploads/2017/11/cropped-favi-32x32.png?fit=32%2C32&#038;ssl=1" sizes="32x32" />
     
     <link rel="icon" href="https://i0.wp.com/www.mynaturesrite.com/wp-content/uploads/2017/11/cropped-favi-32x32.png?fit=32%2C32&#038;ssl=1" sizes="192x192" />

</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add a Maven coupon usage</h2> <div class="form-group">
                        </div>
 
                        <p>Please fill out this form and submit to add a new Maven order to the database.</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Name on Order</label>
                            <input type="text" name="OrderName" class="form-control <?php echo (!empty($ordername_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ordername; ?>">
                            <span class="invalid-feedback"><?php echo $ordername_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Order Date</label>
                            <input type="date" name="OrderDate" class="form-control <?php echo (!empty($orderdate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $orderdate; ?>">
                            <span class="invalid-feedback"><?php echo $orderdate_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Coupon Code</label>
                            <input type="text" name="CouponCode" class="form-control <?php echo (!empty($couponcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $couponcode; ?>">
                            <span class="invalid-feedback"><?php echo $couponcode_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Order Number</label>
                            <input type="text" name="OrderNumber" class="form-control <?php echo (!empty($ordernumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ordernumber; ?>">
                            <span class="invalid-feedback"><?php echo $ordernumber_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Maven ID</label>
                            <input type="text" name="CustID" class="form-control <?php echo (!empty($custid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $custid; ?>">
                            <span class="invalid-feedback"><?php echo $custid_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Order Total to the Nearest Dollar</label>
                            <input type="number" name="Total" class="form-control <?php echo (!empty($total_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $total; ?>">
                            <span class="invalid-feedback"><?php echo $total_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>