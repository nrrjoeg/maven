Use `Maven`;

SELECT `Mavens`.`ID`,
`Mavens`.`FirstName`,
`Mavens`.`LastName`,
`Mavens`.`CouponCode`,
`Mavens`.`City`,
`Mavens`.`State`,
`Mavens`.`Email`,
`OrderRollup`.`TotalMavenOrders`,
`OrderRollup`.`OrderCount`

FROM `Mavens`

Left join `OrderRollup` on `OrderRollup`.`CustID` = `Mavens`.`ID`

Where 1;