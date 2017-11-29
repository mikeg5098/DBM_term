<!DOCTYPE html>

<?php
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
				document.getElementById("seaarchparam").innerHTML = "";
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
		
	</script>
	
	

<html style="background-color: #e8e8e8">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>




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
            </ul>
            <div id="boxnav"></div>
        
        
        </div>
    
    
    </div>

<body>
 <!-- <br /><br /><br /> -->
<div id="container">
<!--Input section-->
    <br />
	<div style="text-align:center;">
<form name="myform" action="" method="GET" style="display:inline;">
  <input type="text" name="inputbox" id="inputbox" value="" />
  <input type="button" name="button" value="Search Car Database" onclick="searchTable(this.form)" class="btn btn-primary btn-lg">  
</form>  
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm" style="display:inline;">
    Insert Car
</button> 
</div>
 
    </div>    
	

    
<!-- Can't move this into external file. Ajax call and defining. -->
<script>
function displayTable(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById('databaseout').innerHTML = this.responseText;
  }
  }
  xmlhttp.open("GET","databasetermshow.php",true);
  xmlhttp.send();
}
function searchTable(form){
  var maketosearch = form.inputbox.value;
  if(!maketosearch == ""){
    var xmr = new XMLHttpRequest();
    xmr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById('databaseout').innerHTML = this.responseText;
	  document.getElementById("seaarchparam").innerHTML = "Showing results for: " + maketosearch;
	  document.getElementById("inputbox").value = "";
    }
    }
    xmr.open("GET","databasesearch.php?search=" + maketosearch,true);
    xmr.send();
  }
  else{
  document.getElementById("seaarchparam").innerHTML = "";
  document.getElementById("inputbox").value = "";
  displayTable();
  }  
  }
  //document.getElementById['test'].innerHTML = "\"" + "databasesearch.php?make=" + maketosearch + "\"";


    displayTable();
</script>

<?php
//print "<div id = \"databaseshow\" style=\"display:block;\">";
$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
if (!$db) {
     print "Error - Could not connect to MySQL";
     exit;
}

// Select the database
$er = mysqli_select_db($db,"ISP_jsy15");
if (!$er) {
    print "Error - Could not select the database";
    exit;
}

    //Handle input, if any
  if(!empty($_POST)) {
    //Add student
    if(isset($_POST["add_car"])) {
      if(isset($_POST["model"]) && isset($_POST["make"]) && $_POST["year"]){

        $model = $_POST["model"];
        $make = $_POST["make"];
        $year = $_POST["year"];


        //Insert the student's info into the database
        $query = "INSERT INTO Database_test (Model, Make, year)
                            VALUES ('$model', '$make', '$year');";
        if(mysqli_query($db, $query)) {
          print "<p> $model, $make, $year : information was successfully inserted.</p>";
        }
        else {
          print "<p>Error: " . mysqli_error($db) . "</p>";
        }
      }
    }
    //Remove Cars
    if(isset($_POST["remove_car"])) {
      if(isset($_POST["modelr"]) && isset($_POST["maker"]) && $_POST["yearr"]){

        $model = $_POST["modelr"];
        $make = $_POST["maker"];
        $year = $_POST["yearr"];

        //Insert the student's info into the database
        $query = "DELETE FROM Database_test WHERE year='$year' AND model='$model' AND make='$make';";
        if(mysqli_query($db, $query)) {
          print "<p> $model, $make, $year : information was successfully removed.</p>";
        }
        else {
          print "<p>Error: " . mysqli_error($db) . "</p>";
        }
      }
    }
    //Update Cars
    if(isset($_POST["update_car"])) {
      if(isset($_POST["modelu"]) && isset($_POST["makeu"]) && isset($_POST["yearu"]) && isset($_POST["choice"])){

        $model = $_POST["modelu"];
        $make = $_POST["makeu"];
        $year = $_POST["yearu"];
        $modelUpdate = $_POST["modelUpdate"];
        $makeUpdate = $_POST["makeUpdate"];
        $yearUpdate = $_POST["yearUpdate"];
        $choice = $_POST["choice"];
        print "The choice was: $choice";

        //Insert the student's info into the database
        //$query = "UPDATE Database_test SET $choice='TESTINGVALUEHERE' WHERE Model = $model";
        if($choice == "Model")
        $query = "UPDATE Database_test SET Model='$modelUpdate' WHERE Model = '$model' AND Make = '$make' AND year = '$year';";
        elseif ($choice == "Make") {
          $query = "UPDATE Database_test SET Make='$makeUpdate' WHERE Make = '$make' AND Make = '$make' AND year = '$year';";
        }
        else {
          $query = "UPDATE Database_test SET year='$yearUpdate' WHERE year = '$year' AND Make = '$make' AND year = '$year';";
        }
        if(mysqli_query($db, $query)) {
          print "<p> $model, $make, $year : information was successfully updated.</p>";
        }
        else {
          print "<p>Error: " . mysqli_error($db) . "</p>";
        }
      }
    }
  }
?>
        </p>
		
		<div id="testing1"></div>
		
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
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
                    Insert Car Information
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                  <div class="form-group">
                    <label for="inputModel">Model</label>
                      <input type="text" class="form-control"
                      id="inputmodel" placeholder="Enter Model"/>
                  </div>
                  <div class="form-group">
                    <label for="inputMake">Make</label>
                      <input type="text" class="form-control"
                          id="inputmake" placeholder="Enter Make"/>
                  </div>
				  <div class="form-group">
                    <label for="Input">Year</label>
                      <input type="text" class="form-control"
                          id="inputyear" placeholder="Enter Year"/>
                  </div>
				  <button type="submit" class="btn btn-default"
                   data-dismiss="modal" onclick="insertRecord()">
                       <span aria-hidden="true">Submit</span>
                       <span class="sr-only">Submit</span>
                </button>
                
                
            </div>
        </div>
    </div>
</div>

		<div id="seaarchparam" style="color:red; text-align:center; font-size:16px;"></div>
        <div id="databaseout"></div>
       <div id="test">
    </div>
  </body>

</html>
