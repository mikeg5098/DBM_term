<!DOCTYPE html>

<?php
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT * from database_testing";
$faq = $db_handle->runQuery($sql);
?>

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

		function deleteRecord(id) {
			$.ajax({
				url: "deleterecord.php",
				type: "POST",
				data:'car_id='+id,
				success: function(data){
				displayTable();
				//document.getElementById("seaarchparam").innerHTML = "";
				document.getElementById("inputbox").value = "";
				}
		   });
		}




		function insertRecord(){
		var make = document.getElementById("inputmake").value;
		var model = document.getElementById("inputmodel").value;
		var year = document.getElementById("inputyear").value;
		clearinput();
		if(make != "" && model != "" && year !=""){

		$.ajax({
				url: "insertrecord.php",
				type: "POST",
				data:'model='+model+'&make='+make+'&year='+year,
				success: function(data){
				displayTable();
				}
		   });

		   }
		   else{
				alert("All Fields must be filled out.");
		   }
		}

		function clearinput(){
			document.getElementById("inputmodel").value = "";
			document.getElementById("inputyear").value = "";
			document.getElementById("inputmake").value = "";
		}

		function insertRating(){
			var test1 = document.querySelector('input[name="rating"]:checked').value;
			var car_id = document.getElementById("rating_car_id").value;
			var rating_comment = document.getElementById("rating_comment").value;
			//alert("hellO: " + rating_comment);
			document.getElementById("rating_comment").value = "";

			//alert("Test:" + test1 + ", " + car_id);

			$.ajax({
				url: "insertrating.php",
				type: "POST",
				data:'car_id='+car_id+'&rating='+test1+'&comment='+rating_comment,
				success: function(data){
				displayTable();
				var ele = document.getElementsByName("rating");
				for(var i=0;i<ele.length;i++)
					ele[i].checked = false;
				displayTable();
				}
		   });


		}

		function setRatingID(car_id){
			//alert("Test1: " + car_id);
			document.getElementById("rating_car_id").value = car_id;
		}

		function advancedSearch(){
			var advmake = document.getElementById('searchmake').value;
			//alert("test3");
			var advoperator1 = document.getElementById("advsearch");
			//alert("test4");
			var advoperator2 = advoperator1.options[advoperator1.selectedIndex].text;
			//alert("test5");
			var advrating1 = document.getElementById("advrating").value;
			//alert("make: " + advmake + ", operator: " + advoperator2+ ", rating: " + advrating1);
			if(advrating1 != ""){
				var xmr = new XMLHttpRequest();
				xmr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					document.getElementById('databaseout').innerHTML = this.responseText;
				//document.getElementById("seaarchparam").innerHTML = "Showing results for: " + maketosearch;
				//document.getElementById("inputbox").value = "";
				}
				}
				xmr.open("GET","advancedsearch.php?make=" + advmake + "&operator=" + advoperator2 + "&rating=" + advrating1,true);
				xmr.send();
			}
			else{
				alert("You cannot search with no rating");
				displayTable();
			}



			//Reset Modal Fields
			document.getElementById('searchmake').value = "";
			document.getElementById("advrating").value = "";
			advoperator1.selectedIndex = 0;
		}

	</script>



<html style="background-color: #e8e8e8">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- Five star input css -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<script>
  function getUsers(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById('databaseoutput').innerHTML = this.responseText;
    }
    }
    xmlhttp.open("GET","adminusers.php",true);
    xmlhttp.send();
  }

  function deleteAccount(id){
    if(confirm("Do you want to delete this account?")){
    $.ajax({
      url: "deleteaccount.php",
      type: "POST",
      data:'user_id='+id,
      success: function(data){
      getUsers();
      }
     });
   }
  }
  function setUserID(id){
    document.getElementById("user_id").value = id;
  }
  function changePassword(){
    var pass1 = document.getElementById('password1').value;
    var pass2 = document.getElementById('password2').value;
    var user_id = document.getElementById('user_id').value;
    if(pass1 == pass2){
      document.getElementById('password1').value = "";
      document.getElementById('password2').value = "";
    $.ajax({
      url: "changepassword.php",
      type: "POST",
      data:'password='+pass1+'&user_id='+user_id,
      success: function(data){
        alert("The password for user_id: " + user_id + " has been updated!");
      }
     });
   }
   else{
     alert("Password must match!");
   }
   document.getElementById('password1').value = "";
   document.getElementById('password2').value = "";
  }

  function viewUserRatings(id){
      var xmr = new XMLHttpRequest();
      xmr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById('databaseoutput').innerHTML = this.responseText;
      }
      }
      xmr.open("GET","userrating.php?user_id=" + id,true);
      xmr.send();
    }

  

  getUsers();
</script>

<div class="modal fade" id="modalpassword" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                   data-dismiss="modal" onclick="clearinput()">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Changing User Password
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                  <div class="form-group">
                    New Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" id="password1" /><br />
                    Confirm Password:<input type="password" id="password2" /><br />
                    <input type="text"  id="user_id">
                  </div>
				  <button type="submit" class="btn btn-default"
                   data-dismiss="modal" onclick="changePassword()">
                       <span aria-hidden="true">Submit</span>
                       <span class="sr-only">Submit</span>
                </button>


            </div>
        </div>
    </div>
</div>




    <head>
        <title>DriverSide</title>
        <link rel="stylesheet" href="style.css" type="text/css" />
    </head>


    <div id="header">
        <div class="container">
            <ul id="header-nav">
                <li><a href="index.html">HOME</a></li>
                <li><a href="DataBaseTerm.php">DATABASE</a></li>
                <li><a href="team.html">TEAM</a></li>
                <li><a href="profile.php">LOGIN</a></li>
								<?php if($id_session == 1 OR $id_session == 2 OR $id_session == 3){
									echo "<li><a href=\"admin.php\">ADMIN</a></li>";
								}
								?>
            </ul>
            <div id="boxnav"></div>
			<div style="float:right; color:white;">Welcome: <a href="recommendedcars.php?id=<?php echo $id_session; ?>"><?php echo $fname_session; ?></a> &nbsp;&nbsp; <b id="logout"><a href="logout.php">Log Out</a></b></div>
</div>

<body>
    <div id="container" class="container">
      <div id="databaseoutput">

      </div>
    </div>
</body>



</html>
