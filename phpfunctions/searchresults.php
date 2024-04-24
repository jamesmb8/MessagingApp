<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}


$dbPath = "../StudentModule.db"; 


$db = new SQLite3($dbPath);

if (!$db) {
    die("Failed to connect to SQLite database.");
}

$userID = $_SESSION['user_id'];
$searchUsername = $_GET['search_username'];


$query = "SELECT ID FROM User WHERE member_username = :searchUsername";
$stmt = $db->prepare($query);
$stmt->bindValue(':searchUsername', $searchUsername, SQLITE3_TEXT);
$result = $stmt->execute();

if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $friendID = $row['ID'];

    $insertQuery = "INSERT INTO Friend (user1_id, user2_id) VALUES (:userID, :friendID), (:friendID, :userID)";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
    $insertStmt->bindValue(':friendID', $friendID, SQLITE3_INTEGER);
    $insertResult = $insertStmt->execute();


    if ($insertResult) {

        $db->close();

        echo "<script>alert('User successfully added as a friend.'); window.location = '../try2.php';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to add user as a friend. Please try again later.');</script>";
    }
} else {
    echo "<script>alert('User not found. Please enter a valid username.');</script>";
}


$db->close();



?>