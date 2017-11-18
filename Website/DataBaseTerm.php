


<!DOCTYPE html>

<body>
  <br /><br /><br />
<!--Input section-->
<div style="display:inline-block; outline-color:black; border:medium solid">
<form id="add-cars" method="POST" action="DataBaseTerm.php" >
  <p>Add Car</p>
        <input type="text" name="model">Model<br>
        <input type="text" name="make">Make<br>
        <input type="text" name="year">Year<br>
        <input type="submit" name="add_car" value="Add">
</form>
</div>

<div style="display:inline-block; outline-color:black; border:medium solid">
<form id="remove-cars" method="POST" action="DataBaseTerm.php" >
  <p>Delete Car</p>
        <input type="text" name="modelr">Model<br>
        <input type="text" name="maker">Make<br>
        <input type="text" name="yearr">Year<br>
        <input type="submit" name="remove_car" value="Delete">
</form>
</div>
<div style="display:inline-block; outline-color:black; border:medium solid">
  <p>
    Update Cars
  </p>
  <form id="add-grades" method="POST" action="DataBaseTerm.php">
          <input type="text" name="modelu">Model<br>
          <input type="text" name="makeu">Make<br>
          <input type="text" name="yearu">Year<br>
          <select class="myButton" name= "choice" form="add-grades">
            <option value="Model">Model</option>
            <option value="Make">Make</option>
            <option value="year">Year</option>
          </select> =
          Choice<br>
          <input type="text" name="modelUpdate">New Model<br>
          <input type="text" name="makeUpdate">New Make<br>
          <input type="text" name="yearUpdate">New Year<br>
          <input type="submit" name="update_car" value="Update">
  </form>
</div>
<form name="myform" action="" method="GET">
  <input type="text" name="inputbox" value="" />
  <input type="button" name="button" value="Search By Make" onclick="searchTable(this.form)">
</form>
<br />
<button onclick="displayTable()" style="float:none;">Display the table</button>

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
    }
    }
    xmr.open("GET","databasesearch.php?make=" + maketosearch,true);
    xmr.send();
  }
  else{alert("You cannot search by null");}  
  }
  //document.getElementById['test'].innerHTML = "\"" + "databasesearch.php?make=" + maketosearch + "\"";


    //displayTable();
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
        <div id="databaseout">

        </div>
        <div id="test">

        </div>
    </form>
  </body>
</html>
