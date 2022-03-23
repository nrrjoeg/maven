<?php

require_once 'config.php';

//maven-fetch.php - database query for maven

$output = '';

if(isset($_POST["query"]))

{
 $search = mysqli_real_escape_string($link, $_POST["query"]);
 
 $query = "SELECT * FROM `Mavens`
   WHERE Lower(`FirstName`) like '%".$search."%'
   or lower(`LastName`) like '%".$search."%'
   or lower(`CouponCode`) like '%".$search."%'
   or lower(`Email`) like '%".$search."%'

   Limit 0,30
 ";
}

else

{
 $query = "SELECT * FROM `Mavens`
  ORDER BY `CouponCode` ASC";
}

$result = mysqli_query($link, $query);

if(mysqli_num_rows($result) > 0)

{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
   <tr>
      <th>CouponCode</th>
      <th>FirstName</th>
      <th>LastName</th>
      <th>Email</th>
      <th>City</th>
      <th>State</th>
      <th>Maven ID</th>
    </tr>';
 
 while($row = mysqli_fetch_array($result))
 {
  $output .= 
  
     '<tr><td>'
     
        .$row["CouponCode"].

     '</a></td>
     
     <td>'
       
       .$row["FirstName"].
       
     '</td><td>'
     
        .$row["LastName"].
         
     '</td><td>'
          
         .$row["Email"].

     '</td><td>'
             
         .$row["City"].
         
     '</td><td>'
     
         .$row["State"].
         
      '</td><td>'

         .$row["ID"].
      
      '</td></tr>';

 }

   echo $output;

}
else
{
 echo 'Data Not Found';
}

?>
