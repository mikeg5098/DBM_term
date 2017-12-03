<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

$comment = $_GET["search"];
$sql = "call getComments('" . $comment . "');";
$faq = $db_handle->runQuery($sql);
if(!$faq){
	print "No comments or ratings were found. &nbsp;&nbsp;&nbsp;";
	print "<button class=\"btn btn-primary btn-lg\" onclick=\"displayTable();\">Show All Cars</button>";
	exit();
}
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
				<th>Comments</th>
				<th>Rating</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
				<td>
					<?php if(!$faq[$k]["comment"]){
						echo "No comment was left for this rating";
					}
					else{
						echo $faq[$k]["comment"]; 
						}
						?>
				</td>
				<td>
					<?php echo $faq[$k]["rating"]; ?> 
				</td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
    </body>
</html>