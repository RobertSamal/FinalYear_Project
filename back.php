<?php
// Define the body part for this page (e.g., abs)
$bodyPart = "back";

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
$caloriesRow = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the data into an associative array
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
    <title>BACK WORKOUTS</title>
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
        <img src="img/deadlift.png" alt="Deadlift">
        <div class="exercise-details">
            <h2>10 Deadlift</h2>
            <p>Stand with your feet shoulder-width apart, keeping the barbell close to your body. Bend at your hips and knees, lowering the barbell to mid-shin level. Push through your heels and extend your hips to lift the barbell, keeping your back straight. Lower the barbell back down and repeat.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/pullups.png" alt="Pull-ups">
        <div class="exercise-details">
            <h2>10 Pull-ups</h2>
            <p>Hang from a bar with your hands slightly wider than shoulder-width apart, palms facing away from you. Pull yourself up by squeezing your shoulder blades and bending your elbows, bringing your chin above the bar. Lower yourself back down and repeat.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/bentoverrow.png" alt="Bent Over Row">
        <div class="exercise-details">
            <h2>15 Bent Over Row</h2>
            <p>Hold a dumbbell in each hand with your palms facing your body. Bend forward at your hips while keeping your back straight. Pull the dumbbells up towards your chest by squeezing your shoulder blades together. Lower the dumbbells back down and repeat.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/latpulldown.png" alt="Lat Pulldown">
        <div class="exercise-details">
            <h2>10 Lat Pulldown</h2>
            <p>Sit at a lat pulldown machine with your knees secured under the pads. Grasp the bar with a wide overhand grip, hands wider than shoulder-width apart. Pull the bar down towards your chest by squeezing your shoulder blades together. Return the bar to the starting position and repeat.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/rows.png" alt="Rows">
        <div class="exercise-details">
            <h2>15 Rows per hand</h2>
            <p>Place one knee and hand on a bench, keeping your back parallel to the ground. Hold a dumbbell in your other hand with your arm extended. Pull the dumbbell up towards your chest by squeezing your shoulder blade. Lower the dumbbell back down and repeat. Switch sides and repeat the exercise.</p>
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
