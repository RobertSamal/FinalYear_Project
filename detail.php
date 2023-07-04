
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign In</title>
<link rel="icon" href="img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="style/style1.css" type="text/css"  />
</head
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

  <?php
  
  // Include database configuration file
  require_once 'connection/dbconfig.php';

  // Get the product ID from the URL
  $pid = $_GET['pid'];


  // Prepare and execute the SQL statement to fetch the product details
  $stmt = $db_con->prepare("SELECT * FROM product WHERE pid = $pid");
  $stmt->execute();
  $row=$stmt->fetch(PDO::FETCH_ASSOC);

  // Extract the product details from the fetched row
  $img = $row['img'];
  $name =  $row['name'];
  $des = $row['des'];
  $pr = $row['pr'];
  $cdate =  $row['cdate'];

  // Display the product details
  echo '
  <div class="item1">

  <span><img width="150px" src="'.$img.'"></span>

  </div>
  ';

  echo '
<div class="item1">
<button class="button2"> '.$pr.' Calories</button><br>
<h2>'.$name.'</h2>
<span><b>Description </b><br>'.$des.'<span><br><br>
<b><b>Publish Date </b>'.$cdate.'</b><br>
<button class="button2"> <a href="add-order.php?pid='.$pid.'" > Start Workout Now</a> </button>

</div>';
  //**********************************************

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
