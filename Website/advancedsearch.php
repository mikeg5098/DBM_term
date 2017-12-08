<?php
error_reporting(E_ERROR);
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$make = $_GET["make"];
$operator = $_GET["operator"];
$rating = $_GET["rating"];
//echo $make . "<br />";
if($make != ""){
  $sql = "SELECT database_testing.car_id, rating_car, Make, Model, Year FROM (SELECT car_id, ROUND(AVG(rating),2) as rating_car FROM DBM_ratings WHERE rating !='0' GROUP BY car_id UNION SELECT car_id, AVG(rating) as rating_car FROM DBM_ratings WHERE rating ='0' GROUP BY car_id) as dbm3 join database_testing WHERE dbm3.car_id = database_testing.car_id AND rating_car != '0' AND Make = '" . $make . "' AND rating_car " . $operator . " " . $rating . " ;";
}
else{
  $sql = "SELECT database_testing.car_id, rating_car, Make, Model, Year FROM (SELECT car_id, ROUND(AVG(rating),2) as rating_car FROM DBM_ratings WHERE rating !='0' GROUP BY car_id UNION SELECT car_id, AVG(rating) as rating_car FROM DBM_ratings WHERE rating ='0' GROUP BY car_id) as dbm3 join database_testing WHERE dbm3.car_id = database_testing.car_id AND rating_car != '0' AND " . "rating_car " . $operator . " " . $rating . " ;";

}
//echo $sql;
$faq = $db_handle->runQuery($sql);
?>
<html>
    <head>
	<style>
	th {
    cursor: pointer;
	}
	</style>
		<script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		}

		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&car_id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}
		   });
		}
		</script>
    </head>
    <body>
	  <?php
		if($id_session == 1 or $id_session == 2 or $id_session == 3)
		{
		?>
	   <table id="myTable2" class="table table-hover">
		  <thead>
			  <tr>
				<th onClick="sortTable(0)" style="text-align:center;">Model</th>
				<th onClick="sortTable(1)">Make</th>
				<th onClick="sortTable(2)">Year</th>
				<th onClick="sortTable(3)">Rating</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td  style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'Model','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Model"]; ?></td>
				<td contenteditable="true" onBlur="saveToDatabase(this,'Make','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Make"]; ?></td>
				<td contenteditable="true" onBlur="saveToDatabase(this,'Year','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Year"]; ?></td>
				<td>
					<?php echo $faq[$k]["rating_car"]; ?>
				</td>
				<td> <button onclick="deleteRecord(<?php echo $faq[$k]["car_id"]; ?>)">Delete</button>  <button onclick="setRatingID(<?php echo $faq[$k]["car_id"]; ?>)" data-toggle="modal" data-target="#ModalRating" >Insert Rating</button> <button onclick="viewComments(<?php echo $faq[$k]["car_id"]; ?>)" >See Comments</button></td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
	<?php
		}
		else
		{
			?>
		<table id="myTable2" class="table table-hover">
		  <thead>
			  <tr>
				<th onClick="sortTable(0)" style="text-align:center;">Model</th>
				<th onClick="sortTable(1)">Make</th>
				<th onClick="sortTable(2)">Year</th>
				<th onClick="sortTable(3)">Rating</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td style="text-align:center;"><?php echo $faq[$k]["Model"]; ?></td>
				<td><?php echo $faq[$k]["Make"]; ?></td>
				<td><?php echo $faq[$k]["Year"]; ?></td>
				<td>
					<?php echo $faq[$k]["rating_car"]; ?>
				</td>
				<td> <button onclick="setRatingID(<?php echo $faq[$k]["car_id"]; ?>)" data-toggle="modal" data-target="#ModalRating" >Insert Rating</button> <button onclick="viewComments(<?php echo $faq[$k]["car_id"]; ?>)" >See Comments</button></td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
		<?php
		}
		?>
    </body>
</html>
