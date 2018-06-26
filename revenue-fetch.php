<?php

  /* Check if post is set from android and feed query to
   * function based on position value
   */

  if(isset($_POST['position']))
  {
    $output="";	
    switch($_POST['position'])
    {
	case 0: $query_str="DATE(date_time) = CURDATE()";
	$output = fetch_records($query_str);
	break;
					
	case 1: $query_str="DATE(date_time) = DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) )";
	$output = fetch_records($query_str);
	break;
			
	case 2: $query_str="WEEKOFYEAR(date_time)=WEEKOFYEAR(NOW())";
	$output = fetch_records($query_str);
	break;
			
	case 3: $query_str="MONTH(date_time) = MONTH(NOW()) AND YEAR(date_time) = YEAR(NOW())";
	$output = fetch_records($query_str);
	break;
			
	case 4: $query_str="YEAR(date_time) = YEAR(CURDATE() - INTERVAL 1 MONTH)
	AND MONTH(date_time) = MONTH(CURDATE() - INTERVAL 1 MONTH)";
	$output = fetch_records($query_str);
	break;
			
	case 5: $query_str="YEAR(date_time) = YEAR(NOW())";
	$output = fetch_records($query_str);
	break;
			
	case 6: $query_str="DATE(date_time)";
	$output = fetch_records($query_str);
	break;
		 
    }
		
   header('Content-type: application/json');
   echo json_encode($output);
    
 }

 // Define function to return data from mysql	
 function fetch_records($query_line) { require('config.inc.php'); $sql = 'SELECT COUNT(order_id) as orders,SUM(total_cost) as total,  SUM(discount) as discount,(SUM(total_cost) - SUM(discount)) as net_total   FROM tbl_revenue where ' . $query_line; $stmt = $connection->prepare($sql); $stmt->execute(); $row = $stmt->fetch(PDO::FETCH_ASSOC); if($row['orders']==0) { $output=array('orders' => 0, 'total' => 0, 'discount' => 0, 'net_total' => 0); return $output; }else{ return $row; } } ?> 
