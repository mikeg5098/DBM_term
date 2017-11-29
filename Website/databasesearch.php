<?php
error_reporting(E_ERROR);
require_once("dbcontroller.php");
$db_handle = new DBController();
$search = $_GET["search"];
$sql = "SELECT * FROM database_testing WHERE model LIKE '%" . $search . "%' OR make LIKE '%" . $search . "%' OR year LIKE '%" . $search . "%';";
$faq = $db_handle->runQuery($sql);
?>
<html>
    <head>
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
	   <table class="table table-hover">
		  <thead>
			  <tr>
				<th>Model</th>
				<th>Make</th>
				<th>Year</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td  contenteditable="true" onBlur="saveToDatabase(this,'Model','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Model"]; ?></td>
				<td contenteditable="true" onBlur="saveToDatabase(this,'Make','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Make"]; ?></td>
				<td contenteditable="true" onBlur="saveToDatabase(this,'Year','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Year"]; ?></td>
				<td> <button onclick="deleteRecord(<?php echo $faq[$k]["car_id"]; ?>)">Delete</button> </td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
    </body>
</html>
