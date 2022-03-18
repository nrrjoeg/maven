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
                        <h2 class="pull-left">Nature's Rite Maven Dashboard</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Maven</a><br><br>
                        <a href="create-order.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Maven Coupon Usage</a>
                    </div>
                    <?php

                    //Establish number of active mavens
                    require_once "get-maven-coupon-usage.php";

                    //Establish total number of coupons used
                    require_once "get-total-maven-coupons-used.php";

                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    
                    $sql = "SELECT `Mavens`.`CouponCode`,
                        `Mavens`.`FirstName`,
                        `Mavens`.`LastName`,
                        `Mavens`.`ID`,                        
                        `Mavens`.`City`,
                        `Mavens`.`State`,
                        `Mavens`.`Email`,
                        `OrderRollup`.`TotalMavenOrders`,
                        `OrderRollup`.`OrderCount`
                    
                        FROM `Mavens`
                    
                        Left join `OrderRollup` on `OrderRollup`.`CustID` = `Mavens`.`ID`
                    
                        Where 1
                        
                        Order by CouponCode ASC;";


                    if($result = mysqli_query($link, $sql)){

                        $mavencount = mysqli_num_rows($result);

                        echo "<strong>Current Maven count: </strong>" . $mavencount . "<br>";
                        echo "<strong>Individual Mavens whose coupons have been used: </strong>" . $activemavens . "<br>";

                        echo "<strong>Total Maven Coupons Used: </strong>" . $totalmavencouponsused . "<br>";

                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Couponcode</th>";
                                        echo "<th>FirstName</th>";
                                        echo "<th>LastName</th>";
                                        echo "<th>Maven ID</th>";
                                        echo "<th>City</th>";
                                        echo "<th>State</th>";

                                        echo "<th>Order Count</th>";
                                        echo "<th>Order Total</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while($row = mysqli_fetch_array($result)){

                                    $ordercount = $row['OrderCount'];
                                    $id = $row['ID'];
                                    $total = $row['TotalMavenOrders'];
                                    $displayfile = 'display-maven-orders.php?ID=';

                                    echo "<tr>";
                                        echo "<td>" . $row['CouponCode'] . "</td>";
                                        echo "<td>" . $row['FirstName'] . "</td>";
                                        echo "<td>" . $row['LastName'] . "</td>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['City'] . "</td>";
                                        echo "<td>" . $row['State'] . "</td>";
                                     
                                        echo "<td>";
 
                                            echo "<a href='" . $displayfile . $id . "'>" . $ordercount . "</a>";
                                        
                                        echo "</td>";

                                        echo "<td>" . $total . "</td>";
                                        
                                        echo "<td>";

                                            echo '<a href="read.php?ID='. $row['ID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

                                            echo '<a href="update.php?ID='. $row['ID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            
                                            echo '<a href="delete.php?='. $row['ID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';

                                        echo "</td>";
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

                    <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Maven</a>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>