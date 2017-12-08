<?php
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$db_handle2 = new DBController();
$user = $_GET["id"];
//echo "<br /> User is: " . $user . "<br />";
$sql = "SELECT database_testing.car_id, ROUND(rating_car, 0) as rating_car, Make, Model, Year FROM (SELECT car_id, AVG(rating) as rating_car FROM DBM_ratings WHERE rating !='0' GROUP BY car_id UNION SELECT car_id, AVG(rating) as rating_car FROM DBM_ratings WHERE rating ='0' AND DBM_ratings.car_id not in (SELECT car_id FROM DBM_ratings WHERE rating !='0') GROUP BY car_id) as dbm3 join database_testing WHERE dbm3.car_id = database_testing.car_id AND Make = 'Volvo' AND database_testing.car_id not in (SELECT DBM1.car_id FROM (SELECT Model, Make, Year, database_testing.car_id FROM database_testing join DBM_liked WHERE database_testing.car_id = DBM_liked.car_id AND user_id = '" . $user ."') as DBM1 join DBM_ratings WHERE DBM_ratings.car_id = DBM1.car_id AND user_id = '" . $user . "') ORDER BY rating_car DESC LIMIT 0,10;";
//echo $sql;
$faq = $db_handle->runQuery($sql);
//echo $sql;

?>
<html>
    <head>
	<style>
	th {
    cursor: pointer;
	}
	</style>
    </head>
    <body>
    <div style="text-align:center; font-size: 30px;"><b><u>Your Reccomended Cars</u></b></div>
    Yo
	   <table id="myTable2" class="table table-hover">
		  <thead>
			  <tr>
				<th style="text-align:center;">Model</th>
				<th style="text-align:center;">Make</th>
				<th style="text-align:center;">Year</th>
        <th style="text-align:center;">Your Ratings</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td style="text-align:center;"><?php echo $faq[$k]["Model"]; ?></td>
				<td style="text-align:center;"><?php echo $faq[$k]["Make"]; ?></td>
				<td style="text-align:center;"><?php echo $faq[$k]["Year"]; ?></td>
        <td style="text-align:center;"><?php echo $faq[$k]["rating_car"]; ?></td>
			  </tr>
      <?php } ?>
    </body>
</html>
