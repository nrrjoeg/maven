

    <?php echo "<strong>Number of Maven Orders:</strong> "  . $linecount; ?>

     <table class="table table-bordered table-striped">
         <thead>
            <tr>
                <th style="text-align: center">Order Number</th>
                <th style="text-align: center">Order Date</th>
                <th style="text-align: center">Order Name</th>
                <th style="text-align: center">Order Total</th>
                <th style="text-align: center">Coupon Code</th>
            </tr>
        </thead>
        <tbody>

            <?php while($row = mysqli_fetch_array($search_result)):?>

                <tr>
              
                <td style="text-align: center"><?php echo $row['OrderNumber'];?></td>
                <td style="text-align: center"><?php echo $row['OrderDate'];?></td>
                <td style="text-align: center"><?php echo $row['OrderName'];?></td>
                <td style="text-align: center"><?php echo $row['Total'];?></td>
                <td style="text-align: center"><?php echo $row['CouponCode'];?></td>
            
                </tr>

            <?php endwhile;?>

        </tbody>

    </table>