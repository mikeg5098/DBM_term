<?php
print "<div id = \"databaseshow\" style=\"display:block;\">";
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

/*
$url = https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Honda/modelyear/2018?format=xml;
$xml = simplexml_load_file($url) or die("feed not loading");
  $makemodel = $xml->Results->MakeModels[0];
  $x = $makemodel->Make_Name;
  $y = $makemodel->Model_Name;
  echo "Make: " . $x . " , Model: " . $y . "<br />";
  $query = "INSERT INTO database_testing (model, make, year) VALUES('$y','$x','2015');";
*/

$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Volvo/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Honda/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Toyota/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Jeep/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Nissan/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Tesla/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Audi/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	$url = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/Porsche/modelyear/2018?format=xml';
$xml = simplexml_load_file($url) or die("feed not loading");
foreach($xml->Results->MakeModels as $temp){
//$makemodel = $xml->Results->MakeModels[$temp];
  //$x = $makemodel->Make_Name;
  //$y = $makemodel->Model_Name;
  echo "Make: " . $temp->Model_Name . " , Model: " . $temp->Make_Name;



$query = "INSERT INTO database_testing (model, make, year) VALUES ('" . $temp->Model_Name . "' , '" . $temp->Make_Name . "' , '2018')";
echo "The query to send is: " . $query . "<br/>";
  $result = mysqli_query($db,$query);
  if (!$result) {
      print "Error - the query could not be executed";
      $error = mysqli_error();
      print "<p>" . $error . "</p>";
      exit;
    }
    }
	
	
?>
