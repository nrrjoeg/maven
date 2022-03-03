<?php

// Include config file to make database connection
require_once 'config.php';

//Check to see if Customer ID comes over from the request

if(isset($_GET['ID']))

{
    $CustomerIDtoSearch = $_GET['ID'];

      $linecount = 0;

      $query = "SELECT * from `Orders`
      
      where `CustID` = $CustomerIDtoSearch";

      $search_result = mysqli_query($link, $query);
      $linecount = mysqli_num_rows($search_result);
}
?>