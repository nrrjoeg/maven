<?php
// Include config file to make database connection
require_once "config.php";
 
// Define variables and initialize with empty values
$firstname = $lastname = $couponcode = $email = $city = $state = "";
$firstname_err = $lastname_err = $couponcode_err = $email_err = $city_err = $state_err = "";
 
// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first name
    $input_firstname = trim($_POST["FirstName"]);
    if(empty($input_firstname)){
        $firstname_err = "Please enter a first name.";
    } else{
        $firstname = $input_firstname;
    }

    // Validate last name
    $input_lastname = trim($_POST["LastName"]);
    if(empty($input_lastname)){
        $lastname_err = "Please enter Maven last name.";     
    } else{
        $lastname = $input_lastname;
    }
    
    // Validate Coupon Code
    $input_couponcode = trim($_POST["CouponCode"]);
    if(empty($input_couponcode)){
        $couponcode_err = "Please enter a Coupon Code.";     
    } else{
        $couponcode = $input_couponcode;
    }
    
    // Validate email
    $input_email = trim($_POST["Email"]);
    if(empty($input_email)){
        $email_err = "Please enter Maven Email address.";     
    } else{
        $email = $input_email;
    }
    
    // Validate city
    $input_city = trim($_POST["City"]);
    if(empty($input_city)){
        $city_err = "Please enter Maven City.";     
    } else{
        $city = $input_city;
    }

    // Validate state
    $input_state = trim($_POST["State"]);
    if(empty($input_state)){
        $state_err = "Please enter Maven State.";     
    } else{
        $state = $input_state;
    }

    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($couponcode_err) && empty($email_err) && empty($city_err) && empty($state_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO Mavens (FirstName, LastName, CouponCode, Email, City, State ) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_firstname, $param_lastname, $param_couponcode, $param_email, $param_city, $param_state);
            
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_couponcode = $couponcode;
            $param_email = $email;
            $param_city = $city;
            $param_state = $state;
            
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
    <title>Create New Maven</title>
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
                    <h2 class="mt-5">Create Maven Record</h2>
                    <p>Please fill out this form and submit to add a new Maven to the database.</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group">
                            <label>FirstName</label>
                            <input type="text" name="FirstName" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>LastName</label>
                            <input type="text" name="LastName" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                            <span class="invalid-feedback"><?php echo $lastname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Coupon Code</label>
                            <input type="text" name="CouponCode" class="form-control <?php echo (!empty($couponcode_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $couponcode; ?>">
                            <span class="invalid-feedback"><?php echo $couponcode_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" name="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" name="City" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                            <span class="invalid-feedback"><?php echo $city_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="State" class="form-control <?php echo (!empty($state_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $state; ?>">
                            <span class="invalid-feedback"><?php echo $state_err;?></span>
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