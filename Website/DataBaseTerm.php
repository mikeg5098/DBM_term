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
                <li><a href="login_index.php">LOGIN</a></li>
            </ul>
            <div id="boxnav"></div>
			<div style="float:right; color:white;">Welcome: <a href="recommendedcars.php?id=<?php echo $id_session; ?>"><?php echo $fname_session; ?></a> &nbsp;&nbsp; <b id="logout"><a href="logout.php">Log Out</a></b>


        </div>


    </div>

<body>
 <!-- <br /><br /><br /> -->
<div id="container" class="container">
<!--Input section-->
    <br />
	<div style="text-align:center;">


  <!-- <input type="button" name="button" value="Search Car Database" onclick="searchTable()" class="btn btn-primary btn-lg"> -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm" style="display:inline;">
    Insert Car
</button>
<button class="btn btn-primary btn-lg" onclick="displayTable();">Show All Cars</button>
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalsearch" style="display:inline;">Advanced Search</button>

<br/></br>

<div class="input-group" id="searchbox">
		<span class="input-group-addon" style="text-align:center;">Search:</span>
			<input onkeyup="searchTable()" type="text" name="inputbox" id="inputbox" value="" class="form-control"/>
	</div>



</div>

    </div>



<!-- Can't move this into external file. Ajax call and defining. -->
<script>
function displayTable(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById('databaseout').innerHTML = this.responseText;
	document.getElementById("inputbox").value = "";
  }
  }
  xmlhttp.open("GET","databasetermshow.php",true);
  xmlhttp.send();
}

function seeComments(car_id){
	alert("hello");
}

function searchTable(form){
  var maketosearch = document.getElementById('inputbox').value;
  if(!maketosearch == ""){
    var xmr = new XMLHttpRequest();
    xmr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById('databaseout').innerHTML = this.responseText;
	  //document.getElementById("seaarchparam").innerHTML = "Showing results for: " + maketosearch;
	  //document.getElementById("inputbox").value = "";
    }
    }
    xmr.open("GET","databasesearch.php?search=" + maketosearch,true);
    xmr.send();
  }
  else{
  //document.getElementById("seaarchparam").innerHTML = "";
  //document.getElementById("inputbox").value = "";
  displayTable();
  }
  }

  function viewComments(id) {
		//alert("The id is: " + id);
			var xmlhttp = new XMLHttpRequest();
			  xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				document.getElementById('databaseout').innerHTML = this.responseText;
				//document.getElementById("seaarchparam").innerHTML = "";
			  }
			  }
			  xmlhttp.open("GET","commentsshow.php?search="+id,true);
			  xmlhttp.send();
  //document.getElementById['test'].innerHTML = "\"" + "databasesearch.php?make=" + maketosearch + "\"";
  }


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
    //Add car
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

<div class="modal fade" id="ModalRating" tabindex="-1" role="dialog"
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
                    <label for="inputModel">Would you reccomend this car?</label>
                      <input type="radio" id="inputrating" name="rating" value="1"/> 1 Star
					  					<input type="radio" id="inputrating" name="rating" value="2"/> 2 Stars
											<input type="radio" id="inputrating" name="rating" value="3"/> 3 Stars
											<input type="radio" id="inputrating" name="rating" value="4"/> 4 Stars
											<input type="radio" id="inputrating" name="rating" value="5"/> 5 Stars

					  <br>
					  <textarea rows="4" cols="50" id="rating_comment" placeholder="Place any comments here"></textarea>
					  <input type="text" style="display:none;" id="rating_car_id">
                  </div>
				  <button type="submit" class="btn btn-default"
                   data-dismiss="modal" onclick="insertRating()">
                       <span aria-hidden="true">Submit</span>
                       <span class="sr-only">Submit</span>
                </button>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalsearch" tabindex="-1" role="dialog"
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
										<h5>Enter a rating and a operator to search by. You do not have to enter a make.</h2>
                    <input type="text" placeholder="Enter Make" id="searchmake" class="form-control"/>
										Where rating:
										<select id="advsearch">
											<option>
												=
											</option>
											<option>
												<
											</option>
											<option>
												>
											</option>
											<option>
												<=
											</option>
											<option>
												>=
											</option>
										</select>
										<input type="text" maxlength="4" id="advrating" style="width:40px; height:20px;"/>

					  <br>
                  </div>
				  <button type="submit" class="btn btn-default"
                   data-dismiss="modal" onclick="advancedSearch()">
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

 	<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

</html>
