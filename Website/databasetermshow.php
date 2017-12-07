<?php
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "call getAll();";
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
	<?php 
		if($id_session == 1 or $id_session == 2 or $id_session == 3)
		{ 
	?>
	   <table class="table table-hover">
		  <thead>
			  <tr>
				<th style="text-align:center;">Model</th>
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
				<td style="text-align:center;" contenteditable="true" onBlur="saveToDatabase(this,'Model','<?php echo $faq[$k]["car_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["Model"]; ?></td>
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
			<table class="table table-hover">
		  <thead>
			  <tr>
				<th style="text-align:center;">Model</th>
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
				<td style="text-align:center;" ><?php echo $faq[$k]["Model"]; ?></td>
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