<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign In</title>
<link rel="icon" href="img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="style/style1.css" type="text/css"  />
</head>
<body>

<div id="main2">

    <div id="header"><img width="130px" src="img/gymlogo.png"></div>

    <div id="manu">
    <ul>
    <li><a href="index.php">HOME</a></li>
    <li><a style="background:#000000; color:#fff;" href="track.php">TRACK WORKOUT</a></li>
    <li><a href="contact.php">CONTACT</a></li>
    <li><a href="login/login.php">SING IN / SIGN UP</a></li>
    </ul>
    </div>


<div id="content">

<center>
  <form method='post'  action="track.php">

   <table >

   <tr>
       <td colspan="2">    <h1>Track Your Order </h1></td>
   </tr>


   <tr>
       <td>Order No</td>
       <td><input type='text' name='search'   placeholder='' required /></td>
   </tr>

   <tr>
      <td></td><td>
    <button type="submit" class="button" >
TRACK
  </button>
        </td>
    </tr>

</table>
</form>

</center>
<br><br>

<?php
require_once 'connection/dbconfig.php';

// Function to calculate the Basal Metabolic Rate (BMR) based on weight, height, and age
function calculateBMR($weight, $height, $age) {
    // BMR calculation formula
    $bmr = 66 + (13.75 * $weight) + (5 * $height) - (6.75 * $age);
    return $bmr;
}

// Function to display the order details
function displayOrder($row, $userRow) {
    $img = $row['img'];
    $name = $row['name'];
    $ordr = $row['ordr'];
    $pr = $row['pr'];
    $cdate = $row['cdate'];
    $sts = $row['sts'];

    $username = $userRow['uid'];
    $weight = $userRow['weight'];
    $height = $userRow['height'];
    $age = $userRow['age'];

    // Calculate the BMR which is also the total number of calories the person has in the body
    $bmr = calculateBMR($weight, $height, $age);

    echo '
    <div class="item1">
        <span><img src="'.$img.'"></span>
    </div>
    ';

    echo '
    <div class="item1">
        <button class="button">  '.$pr.' Calories</button><br>
        <span><b>Order No</b><br>'.$row['myid'].'<span><br>
        <span><b>Name</b><br>'.$name.'<span><br>
        <span><b>Order</b><br>'.$ordr.'<span><br>
        <b><b>Workout Date: </b>'.$cdate.'</b><br>
        <button class="button"> '.$sts.' </button>
        <br>
        <b>Your Total number of calories was:</b> '.$bmr.' calories
    </div>
    ';
}

// Check if the 'myid' parameter is set in the GET request
if (isset($_GET['myid'])) {
    $myid = $_GET['myid'];

    // Prepare and execute a SELECT query to retrieve the order details from the 'ordrs' table
    $stmt = $db_con->prepare("SELECT * FROM ordrs WHERE myid = :myid");
    $stmt->bindParam(':myid', $myid);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Retrieve user data from the database
        $userStmt = $db_con->prepare("SELECT * FROM ordrs WHERE myid = :myid");
        $userStmt->bindParam(':myid', $myid);
        $userStmt->execute();
        $userRow = $userStmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow) {
            // Display the order details
            displayOrder($row, $userRow);
        } else {
            echo 'User not found.';
        }
    } else {
        echo 'Order not found.';
    }
}

// Check if the 'search' parameter is set in the POST request
if (isset($_POST['search'])) {
    $myid = $_POST['search'];

    // Prepare and execute a SELECT query to retrieve the order details from the 'ordrs' table
    $stmt = $db_con->prepare("SELECT * FROM ordrs WHERE myid = :myid");
    $stmt->bindParam(':myid', $myid);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Retrieve user data from the database
        $userStmt = $db_con->prepare("SELECT * FROM ordrs WHERE myid = :myid");
        $userStmt->bindParam(':myid', $myid);
        $userStmt->execute();
        $userRow = $userStmt->fetch(PDO::FETCH_ASSOC);

        if ($userRow) {
            // Display the order details
            displayOrder($row, $userRow);
        } else {
            echo 'User not found.';
        }
    } else {
        echo 'Order not found.';
    }
}

// Check if the 'page_calories' parameter is set in the POST request
if (isset($_POST['page_calories'])) {
    $pageCalories = $_POST['page_calories'];

    // Calculate the BMR based on user data
    $bmr = calculateBMR($userRow['weight'], $userRow['height'], $userRow['age']);

    // Calculate the remaining calories by subtracting page calories from BMR
    $remainingCalories = $bmr - $pageCalories;

    // Display the remaining calories
    echo "<b>Congragulations🎊you now have: </b>".$remainingCalories." calories<br><br>";
}

?>

</div>

</div>

  </div>
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
