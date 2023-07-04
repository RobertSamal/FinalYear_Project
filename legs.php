<?php
// Define the body part for this page (e.g., abs)
$bodyPart = "legs";

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
    <title>LEGS WORKOUT</title>
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
        <img src="img/squats.png" alt="Squats">
        <div class="exercise-details">
            <h2>30 Squats</h2>
            <p>Stand with your feet shoulder-width apart. Lower your body by bending your knees and hips, keeping your back straight. Push through your heels to return to the starting position. Maintain proper form and avoid letting your knees collapse inward.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/lunges.png" alt="Lunges">
        <div class="exercise-details">
            <h2>50 Lunges</h2>
            <p>Stand with your feet hip-width apart. Take a step forward with your right leg, lowering your body until your right knee is at a 90-degree angle. Push back up to the starting position and repeat with the left leg. Keep your upper body straight and core engaged throughout the exercise.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/deadlift.png" alt="Deadlift">
        <div class="exercise-details">
            <h2>15 Deadlift</h2>
            <p>Stand with your feet hip-width apart, toes under the barbell. Bend at your hips and knees, keeping your back straight. Grip the barbell with an overhand or mixed grip. Lift the bar by extending your hips and knees. Lower the bar back down by bending your hips and knees.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/calfraises.png" alt="Calf Raises">
        <div class="exercise-details">
            <h2>50 Calf Raises</h2>
            <p>Stand with your feet shoulder-width apart. Raise your heels off the ground by pushing through the balls of your feet. Pause at the top and then lower your heels back down. You can perform calf raises on the ground or on an elevated surface for added difficulty.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/glutebridge.png" alt="Glute Bridge">
        <div class="exercise-details">
            <h2>30 Glute Bridge</h2>
            <p>Lie on your back with your knees bent and feet flat on the ground. Lift your hips off the ground by squeezing your glutes and pushing through your heels. Hold for a moment at the top and then lower your hips back down. Keep your core engaged throughout the exercise.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/legpress.png" alt="Leg Press">
        <div class="exercise-details">
            <h2>20 Leg Press</h2>
            <p>Sit on a leg press machine with your back pressed against the backrest. Place your feet shoulder-width apart on the footplate. Push the footplate away by extending your legs, keeping your back against the backrest. Lower the footplate back down by bending your knees.</p>
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
