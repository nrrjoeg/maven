<?php

// Include config file to make database connection

require_once 'config.php';

//Get the usage of each Maven Coupon

      $linecount = 0;

      $query = "SELECT sum(`CouponUses`) as `TotalCouponUses`

      FROM `Maven`.`MavenCouponUsageCounts`";


      $search_result = mysqli_query($link, $query);
      $linecount = mysqli_num_rows($search_result);

      // Set variable to the number of mavens whose coupons have been used

      while($row = mysqli_fetch_array($search_result)){

        $totalmavencouponsused = $row['TotalCouponUses'];
      }

?>