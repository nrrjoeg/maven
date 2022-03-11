<?php

// Include config file to make database connection
require_once 'config.php';

//Get the usage of each Maven Coupon

      $linecount = 0;

      $query = "SELECT `CouponCode`,
      count(*) 
      
        FROM `Maven`.`Orders`

        Group by `CouponCode`";

      $search_result = mysqli_query($link, $query);
      $linecount = mysqli_num_rows($search_result);


?>