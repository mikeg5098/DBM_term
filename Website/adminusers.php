<?php
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT id, username, fname, lname FROM login;";
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
    <br />
    <body>

			<table id="myTable2" class="table table-hover" style="text-align:center;" >
		  <thead>
			  <tr style="text-align:center;" >
        <th style="text-align:center;" >User_ID</th>
				<th style="text-align:center;" >Username</th>
				<th style="text-align:center;" >FirstName</th>
				<th style="text-align:center;" >LastName</th>
        <th>Administative Tools</th>
			  </tr>
		  </thead>
		  <tbody>
		  <?php
		  foreach($faq as $k=>$v) {
		  ?>
			  <tr>
           <td><?php echo $faq[$k]["id"]; ?></td>
	         <td><?php echo $faq[$k]["username"]; ?></td>
           <td><?php echo $faq[$k]["fname"]; ?></td>
		       <td><?php echo $faq[$k]["lname"]; ?></td>
           <td style="text-align:left; width:450px;"><button onclick="deleteAccount(<?php echo $faq[$k]["id"]; ?>);">Delete Account</button><button onclick="viewUserRatings(<?php echo $faq[$k]["id"]; ?>);">See Ratings</button><button data-toggle="modal" data-target="#modalpassword" onclick="setUserID(<?php echo $faq[$k]["id"]; ?>);">Change Password</button></td>
			  </tr>
		<?php
		}
		?>
		  </tbody>
		</table>
    </body>
</html>
