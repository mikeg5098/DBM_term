<!DOCTYPE html>

<?php
include('session.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT * from database_testing";
$faq = $db_handle->runQuery($sql);
$user_id = $_GET["id"];
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
			alert("make: " + advmake + ", operator: " + advoperator2+ ", rating: " + advrating1);
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
								<?php if($id_session == 1 OR $id_session == 2 OR $id_session == 3){
									echo "<li><a href=\"admin.php\">ADMIN</a></li>";
								}
								?>
            </ul>
            <div id="boxnav"></div>
			<div style="float:right; color:white;">Welcome: <?php echo $fname_session; ?> &nbsp;&nbsp; <b id="logout"><a href="logout.php">Log Out</a></b>


        </div>


    </div>

<body>
 <!-- <br /><br /><br /> -->
<div id="container" class="container">
<!--Input section-->
    <br />
	<div style="text-align:center;">


  <!-- <input type="button" name="button" value="Search Car Database" onclick="searchTable()" class="btn btn-primary btn-lg"> -->




</div>

    </div>



<!-- Can't move this into external file. Ajax call and defining. -->
<script>
function displayTable2(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById('databaseout').innerHTML = this.responseText;
  }
  }
  xmlhttp.open("GET","databasetermshow2.php?id="+<?php echo $user_id ?>,true);
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

  function reccomendedCarsShow() {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById('databaseout').innerHTML = this.responseText;
    }
    }
    xmlhttp.open("GET","reccomendcars.php?id="+<?php echo $user_id ?>,true);
    xmlhttp.send();

  }


    displayTable2();
</script>

        </p>

		<div id="testing1"></div>
      <div <div style="text-align:center;">
        <button class="btn btn-primary btn-lg" onclick="reccomendedCarsShow();" style="text-align:center;">Show Reccomended Cars</button>
        <button class="btn btn-primary btn-lg" onclick="displayTable2();" style="text-align:center;">Show Your Rated Cars</button>


      </div>
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
