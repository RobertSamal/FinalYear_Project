
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- XML is often used for storing and exchanging data between different systems and platforms. It allows users to define their own customized tags, making it flexible and adaptable to various data structures -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- UTF helps support a wide range of characters -->
<title>Home</title>
<link rel="icon" href="img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="./style/style1.css" type="text/css"  />

<!-- Below is the stlying for the pagination -->
<style>
ul.pagination {
    text-align:center;
    color:#000000;
}
ul.pagination li {
    display:inline;
    padding:0 3px;
}
ul.pagination a {
    color:#000000;
    display:inline-block;
    padding:5px 10px;
    border:1px solid #000000;
    text-decoration:none;
}
ul.pagination a:hover,
ul.pagination a.current {
    background:#000000;
    color:#fff;
}



</style>

</head>
<body>

<div id="main2">

    <div id="header"><img width="130px" src="img/gymlogo.png"></div>

<div id="manu">
<ul>
<li><a style="background:#000000; color:#fff;" href="index.php">HOME</a></li>
<li><a href="track.php">TRACK WORKOUT</a></li>
<li><a href="contact.php">CONTACT</a></li>
<li><a href="login/login.php">SING IN / SIGN UP</a></li>
</ul>
</div>


<div id="content">

<!-- Search for the food you lastly took -->
<div id="search-bar">
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Search food">
        <input  type="submit" value="Search">
    </form>
</div>


  <?php
  require_once 'connection/dbconfig.php';

  include_once('connection/connectionz.php');
  include_once('function/functionz.php');

  $page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);//checks it page parameter is set in the url using the GET. If not set it assigns the value of 1 indicating the default page to display

    if ($page <= 0) $page = 1; //makes the page number to be always a positive integer. Even if it is O

    $per_page = 6; // Set how many records do you want to display per page.

    // Calculate the starting point for retrieving records
    $startpoint = ($page * $per_page) - $per_page;

    $statement = "`product` ORDER BY `pid` ASC"; //retrieves the records from the products in asc based on the PID and this is how it will be displayed

    // Check if the search term is submitted
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $statement = "`product` WHERE `name` LIKE '%$search%' ORDER BY `pid` ASC"; //if a search is sumbitted then it is assigned the variable search where there will be a comparison of the data in the database and it will be displayed using PID in ASC
}



//**********************************************
// Prepare and execute a database query to retrieve records based on the provided statement, startpoint, and per_page values
$stmt = $db_con->prepare("SELECT * FROM $statement LIMIT {$startpoint}, {$per_page}");
$stmt->execute();

// Loop through the fetched records
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    // Extract relevant data from the fetched row
  $img = $row['img'];
  $pid = $row['pid'];
  $pr = $row['pr'];

  // Output HTML code to display the fetched data
  echo '
  <div class="item">
  <button class="button"> '.$pr.' Calories </button><br>
  <span><img width = "150px" src="'.$img.'"><span><br>
    <span class="more"><a href="detail.php?pid='.$pid.'" >More Detail</a></span>
     <span class="order"><a href="add-order.php?pid='.$pid.'" >Start Workout</a></span>
</div>';

} // While loop End
//**********************************************
?>

<br>
<br>

    </div>

    <!-- Pagination section -->
<div id="nav">
    <br>
    <center>
    <?php

            // displaying paginaiton.
            echo pagination($statement,$per_page,$page,$url='?');
            ?>
    </center>
    <br>

</div>


    <!-- Footer section -->
    <div id="footer">
<center>
      <p>Home . Product . Contact Us . Services </p>

      <p>
        <a  href="https://www.instagram.com/samal_robert/" target="_blank"><img src="img/ig.png"></a>
        <a  href="https://github.com/RobertSamal" target="_blank"><img src="img/github.png"></a>
        <a  href="https://www.linkedin.com/in/robert-samal-0a9995210/" target="_blank"><img src="img/linkedin.png"></a>
      </p>
</center>
    <b>  Copyrights © 2023 Final Year Project. Design by Robert Samal</b>

    </div>

</div>

</body>
</html>
