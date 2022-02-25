<?php
// Check existence of id parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM `Orders` WHERE ID = ?";
    
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
                $custid = $row["CustID"];
                $ordernumber = $row["OrderNumber"];
                $couponcode = $row["CouponCode"];
                $orderdate = $row["OrderDate"];
                $ordername = $row["OrderName"];
                $total = $row["Total"];

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
    <title>Maven Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="icon" href="https://i0.wp.com/www.mynaturesrite.com/wp-content/uploads/2017/11/cropped-favi-32x32.png?fit=32%2C32&#038;ssl=1" sizes="32x32" />
     
     <link rel="icon" href="https://i0.wp.com/www.mynaturesrite.com/wp-content/uploads/2017/11/cropped-favi-32x32.png?fit=32%2C32&#038;ssl=1" sizes="192x192" />

    <style>
        .wrapper{
            width: 900px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 50px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Order list for Maven's coupon code</h2>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    
                    $sql = "SELECT * from `Orders` where `CustID` = '51';";

                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Couponcode</th>";
                                        echo "<th>Order Number</th>";
                                        echo "<th>Order Name</th>";
                                        echo "<th>Order Date</th>";
                                        echo "<th>Order Total</th>";

                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['CouponCode'] . "</td>";
                                        echo "<td>" . $row['OrderNumber'] . "</td>";
                                        echo "<td>" . $row['OrderName'] . "</td>";
                                        echo "<td>" . $row['OrderDate'] . "</td>";
                                        echo "<td>" . $row['Total'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>

<a href="index.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Back to Dashboard</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>