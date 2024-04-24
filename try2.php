<?php
// Start session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    // User is not logged in, redirect to login page
    header('Location: login.html');
    exit;
}
require_once "phpfunctions/db_connect.php";



// If logged in, retrieve user information from session variables
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <div class="left-sidebar">
            <div class="imp-links">

                <a href="account.php"><img src="images/User-image.png"> Account</a>
                <a href="friends.php"><img src="images/friends.png"> Friends</a>
            </div>

        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <h2>Your home screen, <?php echo $_SESSION['first_name']; ?></h2>




            <?php
            $userID = $_SESSION['user_id'];
            $dbPath = "StudentModule.db";
            include "phpfunctions/getusersposts.php";
            include "phpfunctions/getfriendsposts.php";
            // Get user's own posts
            $userPosts = getUserPosts($userID, $dbPath);

            // Get user's friends' posts
            $friendsPosts = getFriendsPosts($userID, $dbPath);

            // Combine user's and friends' posts
            $allPosts = array_merge($userPosts, $friendsPosts);

            // Sort posts by date (assuming 'post_date' is in datetime format)
            usort($allPosts, function ($a, $b) {
                return strtotime($b['post_date']) - strtotime($a['post_date']);
            });

            // Display posts on try2.php
            foreach ($allPosts as $post) {
                echo '<div class="post">';
                echo '<p>' . htmlspecialchars($post['post_text']) . '</p>';
                echo '<p>Posted by: ' . htmlspecialchars($post['username']) . '</p>';
                echo '<p>Posted on: ' . htmlspecialchars($post['post_date']) . '</p>';
                echo '</div>';
            }
            ?>

        </div>
    </div>


    <div class="btm-navbar">
        <a href="createpost.php" class="active">Make a new post</a>

    </div>




</body>

</html>