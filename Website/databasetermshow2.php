<?php
error_reporting(E_ERROR);
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$db_handle2 = new DBController();
$user = $_GET["id"];
//echo "<br /> User is: " . $user . "<br />";
$sql = "SELECT DBM1.Model, DBM1.Make, DBM1.Year, rating FROM (SELECT Model, Make, Year, database_testing.car_id FROM database_testing join DBM_liked WHERE database_testing.car_id = DBM_liked.car_id AND user_id = '" . $user . "') as DBM1 join DBM_ratings WHERE DBM_ratings.car_id = DBM1.car_id AND user_id = '" . $user . "';";
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
      <div style="text-align:center; font-size: 30px;"><b><u>Your rated cars</u></b></div>
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
      if(!$faq){
        print "<td>You have not rated any cars. </td>";
      }
      else{
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td style="text-align:center;"><?php echo $faq[$k]["Model"]; ?></td>
				<td style="text-align:center;"><?php echo $faq[$k]["Make"]; ?></td>
				<td style="text-align:center;"><?php echo $faq[$k]["Year"]; ?></td>
        <td style="text-align:center;"><?php echo $faq[$k]["rating"]; ?></td>
			  </tr>
      <?php }} ?>
    </body>
</html>
