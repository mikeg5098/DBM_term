<?php
error_reporting(E_ERROR);
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$db_handle2 = new DBController();
$user = $_GET["id"];
$query = "SELECT MAX(Make) as maxmake FROM
(SELECT DBM1.Model, DBM1.Make, DBM1.Year, rating
FROM (SELECT Model, Make, Year, database_testing.car_id FROM database_testing join DBM_liked WHERE database_testing.car_id = DBM_liked.car_id AND user_id = '" . $user ."') as DBM1 join DBM_ratings WHERE DBM_ratings.car_id = DBM1.car_id AND user_id = '3') as DBM_maxliked;";

$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
$er = mysqli_select_db($db,"ISP_jsy15");
$result = mysqli_query($db,$query);
$row = mysqli_fetch_array($result);
$values = array_values($row);
$value = htmlspecialchars($values[1]);
if ($value == ""){
  $query = "SELECT MAX(Make) as maxmake FROM
  (SELECT DBM1.Model, DBM1.Make, DBM1.Year, rating
  FROM (SELECT Model, Make, Year, database_testing.car_id, DBM_liked.user_id FROM database_testing join DBM_liked WHERE database_testing.car_id = DBM_liked.car_id AND DBM_liked.user_id = '" . $user ."') as DBM1 join DBM_ratings WHERE DBM_ratings.car_id = DBM1.car_id) as DBM_maxliked;";

  $result = mysqli_query($db,$query);
  $row = mysqli_fetch_array($result);
  $values = array_values($row);
  $value = htmlspecialchars($values[1]);
}
//echo "value: " . $value;
//echo "user is: " . $user;

$sql = "SELECT database_testing.car_id, Model, Make, Year, rating_car
    FROM database_testing join (SELECT car_id, ROUND(AVG(rating), 1) as rating_car FROM DBM_ratings GROUP BY car_id) AS rating_table
    WHERE database_testing.car_id = rating_table.car_id AND make = (SELECT make FROM (SELECT count(*) as counter, make FROM (SELECT make FROM ISP_jsy15.DBM_liked join database_testing WHERE database_testing.car_id = DBM_liked.car_id AND user_id = '" . $user ."') as test1 group by make) as test2 ORDER BY counter DESC LIMIT 1) ORDER BY rating_car desc limit 15 ;";
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
	   <table id="myTable2" class="table table-hover">
		  <thead>
			  <tr>
				<th style="text-align:center;">Model</th>
				<th style="text-align:center;">Make</th>
				<th style="text-align:center;">Year</th>
        <th style="text-align:center;">Car Rating</th>
        <th></th>
        </tr>
		  </thead>
		  <tbody>
		  <?php
      if(!$faq){
        print "<td>You have not rated any cars for us to reccomend you any.</td>";
      }
      else{
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td style="text-align:center;"><?php echo $faq[$k]["Model"]; ?></td>
				<td style="text-align:center;"><?php echo $faq[$k]["Make"]; ?></td>
				<td style="text-align:center;"><?php echo $faq[$k]["Year"]; ?></td>
        <td style="text-align:center;"><?php echo $faq[$k]["rating_car"]; ?></td>
        <td style="text-align:center;"><button onclick="viewComments(<?php echo $faq[$k]["car_id"]; ?>)" >See Comments</button></td>
			  </tr>
      <?php }} ?>
    </body>
</html>
