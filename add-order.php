<?php
// Include necessary files
require_once("session.php");
require_once("class.user.php");

// Create instance of USER class for user authentication
$auth_user = new USER();

// Retrieve user ID from session
$user_id = $_SESSION['user_session'];

// Execute database query to fetch user details based on user ID
$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id" => $user_id));

// Fetch the user details into an associative array
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$uid = $userRow['user_id'];

// Check if user session is not set, and redirect to login page if true
if (!$_SESSION['user_session']) {
    header("location: login/denied.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add workout</title>
    <link rel="icon" href="img/gymlogo.png" type="image/png">
    <link rel="stylesheet" href="style/style.css" type="text/css"  />
</head>
<body>

<?php
// Include database configuration file
require_once 'connection/dbconfig.php';

// Retrieve the product ID from the URL query string
$pid = $_GET['pid'];

// Execute database query to fetch product details based on product ID
$stmt = $db_con->prepare("SELECT * FROM product WHERE pid = $pid");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Retrieve product details into variables
$pr = $row['pr'];
$name = $row['name'];
$img = $row['img'];

// Retrieve user's first order details
$stmt = $db_con->prepare("SELECT * FROM ordrs WHERE uid = $uid LIMIT 1");
$stmt->execute();
$userOrder = $stmt->fetch(PDO::FETCH_ASSOC);

// Set default values for the fields if no orders are found
$mobile = '';
$weight = '';
$height = '';
$age = '';
$address = '';

// Check if the user has previous orders
if ($userOrder) {
    $mobile = $userOrder['mobile'];
    $weight = $userOrder['weight'];
    $height = $userOrder['height'];
    $age = $userOrder['age'];
    $address = $userOrder['addr'];
}
?>

<div id="main2">
    <form method='post' action="admin/order-alert.php">

        <table class='table table-bordered'>

            <tr>
                <td colspan="2">
                    <h1>Enter your details</h1></td>
            </tr>

            <tr>
                <td>Calories</td>
                <td>
                    <input type='text' name='pr' value="<?php echo $pr ?>" />
                    <input type='hidden' name='img' value="<?php echo $img ?>" />
                    <input type='hidden' name='uid' value="<?php echo $uid ?>" />
                </td>
            </tr>

            <tr>
                <td>Order</td>
                <td><input type='text' name='ordr' value="<?php echo $name ?>" placeholder='' required /></td>
            </tr>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' value="<?php echo $userRow['user_name']; ?>" placeholder='' required /></td>
            </tr>

            <input type='hidden' name='cdate' value="<?php echo date('Y-m-d'); ?>" class='form-control' placeholder=''>
            <input type='hidden' name='img' value="<?php echo $img ?>" class='form-control' placeholder=''>

            <tr>
                <td>Mobile</td>
                <td><input type='text' name='mobile' value="<?php echo $mobile ?>" placeholder='Add Mobile' ></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type='text' name='email' value="<?php echo $userRow['user_email']; ?>" class='form-control' placeholder='Add Email'></td>
            </tr>
            <tr>
                <td>Weight</td>
                <td><input type='text' name='weight' value="<?php echo $weight ?>" placeholder='Enter Weight in KGs'></td>
            </tr>
            <tr>
                <td>Height</td>
                <td><input type='text' name='height' value="<?php echo $height ?>" placeholder='Enter Height in cm'></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type='text' name='age' value="<?php echo $age ?>" placeholder='Enter your Age'></td>
            </tr>

            <tr>
                <td>Address</td>
                <td><textarea type='text' name='addr' placeholder='Add Address'><?php echo $address ?></textarea></td>
            </tr>

            <tr>
                <td>Question:
                    <?php
                    $a = rand(0, 9);
                    $b = rand(0, 9);
                    ?>
                    &nbsp;<span class="red"><?php echo "$a + $b"; ?> =</span><br>
                    <input value="<?php echo $a ?>"  name="a" type="hidden">
                    <input value=" <?php echo $b ?>" name="b"  type="hidden">
                </td>
                <td><input type="text"  placeholder='answer here' name="ans" /></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="button">WORKOUT NOW</button>
                </td>
            </tr>

        </table>
    </form>
</div>

</body>
</html>
