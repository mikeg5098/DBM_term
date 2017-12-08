<?php
error_reporting(E_ERROR);
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$search = $_GET["search"];
$sql = "SELECT rating, comment, make, model, year FROM DBM_ratings join database_testing WHERE database_testing.car_id = DBM_ratings.car_id AND DBM_ratings.user_id = '" . $_GET["user_id"] ."';";
$faq = $db_handle->runQuery($sql);
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
      <br />
      <a href="admin.php">Return</a>
		<table id="myTable2" class="table table-hover">
		  <thead>
			  <tr>
				<th>Model</th>
				<th>Make</th>
				<th>Year</th>
				<th>Rating</th>
        <th>Comment</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td><?php echo $faq[$k]["Model"]; ?></td>
				<td><?php echo $faq[$k]["Make"]; ?></td>
				<td><?php echo $faq[$k]["Year"]; ?></td>
				<td><?php echo $faq[$k]["rating"]; ?></td>
        <td><?php echo $faq[$k]["comment"]; ?></td>
      </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
    </body>
</html>
