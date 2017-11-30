<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT * from database_testing ORDER BY Model";
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
				<th>Rating</th>
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
				<td>
					<?php
						// Connect to MySQL
						$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");

						// Select the database
						$er = mysqli_select_db($db,"ISP_jsy15");

						$temp = $faq[$k]["car_id"];
						$query = "CALL getRatingForCar_id('" . $temp . "')"; 

						$result = mysqli_query($db,$query);

						$row = mysqli_fetch_array($result);

						$values = array_values($row);
						$value = htmlspecialchars($values[2 * 3 + 1]);
						if($value == ""){print "0";}
						else{print $value;}
					?>
				</td>
				<td> <button onclick="deleteRecord(<?php echo $faq[$k]["car_id"]; ?>)">Delete</button>  <button onclick="setRatingID(<?php echo $faq[$k]["car_id"]; ?>)" data-toggle="modal" data-target="#ModalRating" >Insert Rating</button></td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
    </body>
</html>