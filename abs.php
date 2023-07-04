<?php
// Define the body part for this page (e.g., abs)
$bodyPart = "abs";

require_once("session.php");
require_once("class.user.php");
$auth_user = new USER();

$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$uid = $userRow['user_id'];

$myid = $_GET['myid']; // Retrieve myid parameter from URL

// Retrieve the calorie value for the specified body part from the database
$stmt = $auth_user->runQuery("SELECT burnt_calories FROM exercise_calories WHERE body_part=:body_part");
$stmt->execute(array(":body_part"=>$bodyPart));
$caloriesRow = $stmt->fetch(PDO::FETCH_ASSOC);
$pageCalories = $caloriesRow['burnt_calories'];
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
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 20px;
        }

        .content img {
            width: 330px;
            transition: filter 0.3s;
        }

        .content .exercise-details {
            margin-left: 20px;
        }

        /* Footer styles */
        .footer {
            background-color: black;
            color: white;
            padding: 20px;
            text-align: center;
        }

        h2 {
            font-family: Kristen ITC;
        }

        p {
            font-family: cherry swash;
        }

        button {
            background-color: yellow;
            color: black;
            font-family: metropolis;
        }

        .footer a {
            color: white;
            margin: 0 10px;
        }
    </style>
    <title>ABS WORKOUTS</title>
    <link rel="icon" href="img/gymlogo.png" type="image/png">
</head>
<body>
<nav class="navbar">
    <img width="130px" src="img/gymlogo.png" alt="Logo">
</nav>

<div class="content">
    <div class="user-data">
        <h2>User Data</h2>
        <p>Name: <?php echo $userRow['user_name']; ?></p>
        <p>Email: <?php echo $userRow['user_email']; ?></p>
    </div>

    <div class="image-container">
        <img src="img/crunches.png" alt="Crunches">
        <div class="exercise-details">
            <h2>30 Crunches</h2>
            <p>Lie on your back with your knees bent and feet flat on the floor. Place your hands behind your head or crossed over your chest. Lift your upper body off the floor using your abdominal muscles while keeping your lower back pressed into the floor. Lower back down and repeat.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/planks.png" alt="Workout 2">
        <div class="exercise-details">
            <h2>60 sec Planks</h2>
            <p>Start in a push-up position with your hands directly under your shoulders and your body in a straight line. Engage your core muscles and hold this position, making sure to keep your hips in line with your shoulders and heels. Hold for the desired duration.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/russiantwist.png" alt="Workout 3">
        <div class="exercise-details">
            <h2>20 Russian Twists</h2>
            <p>Sit on the floor with your knees bent and feet flat on the ground. Lean back slightly and lift your feet a few inches off the ground. Hold your hands together in front of your chest. Twist your torso to one side, bringing your hands to touch the ground beside your hip. Twist to the other side and repeat.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/mountainclimb.png" alt="Workout 4">
        <div class="exercise-details">
            <h2>40 Mountain Climbers</h2>
            <p>Start in a push-up position with your hands directly under your shoulders and your body in a straight line. Drive one knee toward your chest, then quickly switch and drive the other knee toward your chest. Continue alternating legs as if you're running in place.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/legraises.png" alt="Workout 5">
        <div class="exercise-details">
            <h2>15 Leg Raises</h2>
            <p>Lie on your back with your legs straight and together. Place your hands by your sides or under your lower back for support. Lift your legs off the ground using your lower abdominal muscles until they are perpendicular to the floor. Slowly lower your legs back down and repeat.</p>
        </div>
    </div>
    
    <!-- * When the button is clicked, the submitWorkout() JavaScript function is called. 
 * It dynamically sets the action attribute of the form to include the myid parameter in the URL. 
 * This ensures that when the form is submitted, it redirects to track.php with the myid parameter included. -->

    <button id="submit_workout" onclick="submitWorkout();">Finish Workout</button>

<form id="finish_workout_form" method="post">
    <!-- Your form fields go here -->
    <input type="hidden" name="myid" value="<?php echo $myid; ?>">
    <!-- Add hidden input field to store the calorie value for this page -->
    <input type="hidden" name="page_calories" value="<?php echo $pageCalories; ?>">
</form>


<script>
    function submitWorkout() {
    // Prompt a confirmation message
    var confirmation = confirm("Have you really finished the workout?");

    if (confirmation) {
        // If confirmed, submit the form
        document.getElementById('finish_workout_form').action = "track.php?myid=<?php echo $myid; ?>";
        document.getElementById('finish_workout_form').submit();
    }
}


</script>




</div>

<footer class="footer">
    <p>Home . Product . Contact Us . Services </p>
    <a href="https://www.instagram.com/samal_robert/" target="_blank"><img width="100px" src="img/ig.png"></a>
    <a href="https://github.com/RobertSamal" target="_blank"><img width="100px" src="img/github.png"></a>
    <a href="https://www.linkedin.com/in/robert-samal-0a9995210/" target="_blank"><img width="100px" src="img/linkedin.png"></a>
    <br>
    <br>
    <b>© 2023 Final Year Project. Design by Robert Samal</b>
</footer>

</body>
</html>
