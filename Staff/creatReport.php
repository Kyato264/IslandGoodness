<?php 
include("../dbConn.php");

session_start();

$currentDate = date("Y-m-d H:i:s");

                        // Calculate the start and end date of the current month
                        $startDate = date("Y-m-01", strtotime($currentDate));
                        $endDate = date("Y-m-t", strtotime($currentDate));
                        
                        // Query to get the orders and order items for the current month
                        $sql = "SELECT 
                                    orders.OrderID,
                                    orders.TimeStamp,
                                    orders.Status,
                                    fooditem.Name,
                                    orderitems.Quantity,
                                    fooditem.Price
                                FROM 
                                    orders
                                INNER JOIN 
                                    orderitems ON orderitems.OrderID = orders.OrderID
                                INNER JOIN 
                                    fooditem ON fooditem.ItemID = orderitems.ItemID
                                WHERE 
                                    orders.TimeStamp BETWEEN '$startDate' AND '$endDate'";
                        
                        $result = $conn->query($sql);
                        
                        // Initialize variables for total orders and gross profit
                        $totalOrders = 0;
                        $totalProfit = 0;
                        
                        // Output the report
                        $reportContent =  "<h2>Report for $startDate to $endDate</h2>";
                        $reportContent .=  "<table>";
                        $reportContent .= "<tr id=tableHead><th>Order ID</th><th>Timestamp</th><th>Status</th><th>Item</th><th>Quantity</th><th>Cost</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            $reportContent .=  "<tr>";
                            $reportContent .=  "<td>" . $row['OrderID'] . "</td>";
                            $reportContent .=  "<td>" . $row['TimeStamp'] . "</td>";
                            $reportContent .=  "<td>" . $row['Status'] . "</td>";
                            $reportContent .=  "<td>" . $row['Name'] . "</td>";
                            $reportContent .=  "<td>" . $row['Quantity'] . "</td>";
                            $reportContent .=  "<td>BBD$" . $row['Price'] . "</td>";
                            $reportContent .=  "</tr>";
                            // Update total orders and profit
                            $totalProfit += $row['Quantity'] * $row['Price'];
                        }

                        $query = "SELECT COUNT(DISTINCT OrderID) AS totalOrders FROM orders";
                        $results = $conn->query($query);
                        $row = $results->fetch_assoc();
                        $totalOrders = $row['totalOrders'];

                        $reportContent .=  "</table>";
                        $reportContent .=  "<h2>Total Orders: $totalOrders</h2>";
                        $reportContent .=  "<h2>Total Gross Profit: BBD$$totalProfit</h2>";

                        $insertSql = "INSERT INTO monthly_reports (start_date, end_date, total_orders, total_profit, report_content)
              VALUES ('$startDate', '$endDate', $totalOrders, $totalProfit, '$reportContent')";

if ($conn->query($insertSql) === TRUE) {
    echo "Report saved successfully";
} else {
    echo "Error: " . $conn->error;
}
                        