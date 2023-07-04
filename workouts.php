<?php
require_once("session.php");
require_once("class.user.php");
$auth_user = new USER();

$user_id = $_SESSION['user_session'];

// Prepare and execute a SELECT query to retrieve user data from the 'users' table
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

// Fetch the user data from the result set
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$uid = $userRow['user_id'];

// Store myid value in a session variable
$_SESSION['myid'] = $uid;
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    /* Navbar styles */
    .navbar {
      background-color: black;
      color: white;
      padding: 20px;
    }

    /* Content styles */
    .content {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    .content .image-container {
      position: relative;
      margin-bottom: 20px;
    }

    .content img {
      width: 430px;
      transition: filter 0.3s;
    }

    .content .image-container:hover img {
      filter: brightness(30%);
    }

    .content .image-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 100px;
      font-weight: bold;
      opacity: 0;
      transition: opacity 0.3s;
      font-family: stencil;
    }

    .content .image-container:hover .image-text {
      opacity: 1;
    }

    /* Footer styles */
    .footer {
      background-color: black;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .footer a {
      color: white;
      margin: 0 10px;
    }
  </style>
  <title>WORK OUTS</title>
   <link rel="icon" href="img/gymlogo.png" type="image/png">
</head>
<body>
  <nav class="navbar">
    <img width="130px" src="img/gymlogo.png" alt="Logo">
  </nav>
  

  
    
    <div class="content">

    <div class="image-container">
        <div class="content">
    <a href="abs.php?myid=<?php echo $_GET['myid']; ?>">
    <img src="./img/image1.jpg" alt="ABS">
    <span class="image-text">ABS</span>
    </a>
    </div>
    </div>

    <div class="image-container">
        <div class="content">
    <a href="arms.php?myid=<?php echo $_GET['myid']; ?>">
    <img src="./img/image2.jpg" alt="arms">
    <span class="image-text">ARMS</span>
    </a>
    </div>
    </div>

    <div class="image-container">
        <div class="content">
    <a href="back.php?myid=<?php echo $_GET['myid']; ?>">
    <img src="./img/image3.jpg" alt="back">
    <span class="image-text">BACK</span>
    </a>
    </div>
    </div>

    <div class="image-container">
        <div class="content">
    <a href="chest.php?myid=<?php echo $_GET['myid']; ?>">
    <img src="./img/image4.jpg" alt="chest">
    <span class="image-text">CHEST</span>
    </a>
    </div>
    </div>

    <div class="image-container">
        <div class="content">
    <a href="fullbody.php?myid=<?php echo $_GET['myid']; ?>">
    <img src="./img/image5.jpg" alt="fullbody">
    <span class="image-text">FULL BODY</span>
    </a>
    </div>
    </div>

    <div class="image-container">
        <div class="content">
    <a href="legs.php?myid=<?php echo $_GET['myid']; ?>">
    <img src="./img/image6.jpg" alt="legs">
    <span class="image-text">LEGS</span>
    </a>
    </div>
    </div>


    
  </div>

  <footer class="footer">
    <p>Home . Product . Contact Us . Services </p>
    <a  href="https://www.instagram.com/samal_robert/" target="_blank"><img width=100px src="img/ig.png"></a>

    <a  href="https://github.com/RobertSamal" target="_blank"><img width=100px src="img/github.png"></a>

    <a  href="https://www.linkedin.com/in/robert-samal-0a9995210/" target="_blank"><img width=100px src="img/linkedin.png"></a>
    <br>
    <br>
    <b>  Copyrights © 2023 Final Year Project. Design by Robert Samal</b>
  </footer>
</body>
</html>
