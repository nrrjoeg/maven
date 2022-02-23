<?php

require_once 'config.php';

//maven-fetch.php - database query for maven

$connect = mysqli_connect("127.0.0.1:3336", "joeg", "936xRJyEA7iLSx", "Mavens");

$output = '';

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 
 $query = "
   SELECT * FROM `Mavens`
   WHERE Lower(`FirstName`) like '%".$search."%'
   or lower(`LastName`) like '%".$search."%'
   or lower(`CouponCode`) like '%".$search."%'
   or lower(`Email`) like '%".$search."%'

   Limit 0,30
 ";
}

else

{
 $query = "
  SELECT * FROM `Mavens` 
  ORDER BY `ID` ASC
 ";
}

$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
    <th>FirstName</th>
     <th>LastName</th>
     <th>CouponCode</th>
     <th>Email</th>
     <th>City</th>
     <th>State</th>
    </tr>
 ';
 
 while($row = mysqli_fetch_array($result))
 {
  $output .= 
  
     '<tr><td><a href="'
    
        .$viewsdir.'/customer-details-view.php?CustomerNumber='
     
        .$row["PARTY_ID"].

        '&accountnumbersearch=">'

        .$row["PARTY_ID"].
       
     '</a></td>
     
     <td>'
       
       .$row["FirstName"].
       
     '</td><td>'
     
        .$row["LastName"].
         
     '</td><td>'
          
         .$row["CouponCode"].
     '</td><td>'
             
         .$row["Email"].
         
     '</td><td>'
     
         .$row["City"].
         
      '</td><td>'
      
        .$row["State"].
        
       '</td></tr>';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>
