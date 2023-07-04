<?php
// Define the body part for this page (e.g., abs)
$bodyPart = "arms";

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
        <img src="img/bicepcurls.png" alt="Crunches">
        <div class="exercise-details">
            <h2>15 Bicep Curls per arm</h2>
            <p>Stand with a dumbbell in each hand, palms facing forward. Keep your elbows close to your torso and exhale as you curl the weights up to your shoulders. Inhale and slowly lower the weights back down to the starting position.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/tricepdips.png" alt="Workout 2">
        <div class="exercise-details">
            <h2>15 Tricep Dips</h2>
            <p>Sit on the edge of a bench or chair with your hands gripping the edge beside your hips. Walk your feet forward and slide your hips off the bench. Lower your body by bending your elbows until your upper arms are parallel to the floor. Push yourself back up to the starting position by straightening your arms.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/pushups.png" alt="Workout 3">
        <div class="exercise-details">
            <h2>10 Push-ups</h2>
            <p>Start in a high plank position with your hands slightly wider than shoulder-width apart. Lower your body by bending your elbows, keeping your back straight. Push yourself back up to the starting position by straightening your arms. Modify by performing push-ups on your knees or against a wall if needed.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/hammercurls.png" alt="Workout 4">
        <div class="exercise-details">
            <h2>15 Hammer Curls</h2>
            <p> Stand with a dumbbell in each hand, palms facing your body. Keep your elbows close to your torso and exhale as you curl the weights up, keeping your palms facing each other. Inhale and slowly lower the weights back down to the starting position</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/tricepkickbacks.png" alt="Workout 5">
        <div class="exercise-details">
            <h2> 10 Tricep Kickbacks per arm</h2>
            <p>Hold a dumbbell in your right hand and place your left knee and hand on a bench for support. Keeping your back straight, extend your right arm fully behind you while squeezing your triceps. Slowly lower the weight back to the starting position. Repeat on the other side.</p>
        </div>
    </div>

    <div class="image-container">
        <img src="img/diamondpushups.png" alt="Workout 5">
        <div class="exercise-details">
            <h2>5 Diamond Push-ups</h2>
            <p>Get into a high plank position, but place your hands close together directly under your chest, forming a diamond shape with your thumbs and index fingers. Lower your body by bending your elbows, keeping your back straight. Push yourself back up to the starting position by straightening your arms.</p>
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
