<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "collecttweets";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
                    
$screen_name = $_GET["screen_name"];
$profile_img_url = $_GET["profile_img_url"];
$user_name = $_GET["user_name"];
$pic_url = $_GET["pic_url"];
$status = $_GET["status"];
$time = $_GET["time"];
$check = $_GET["check"];
$id = $_GET["id"];

$query = "INSERT INTO "
        . "     $db.tweets  (id ,screen_name,profile_img_url,
                        user_name, pic_url, status, time,
                        `check`,tweet_id) "
        . "VALUES"
        . "( NULL, '$screen_name', '$profile_img_url',"
        . "'$user_name','$pic_url', '$status', '$time',"
        . "'$check','$id') ";

if(!$conn->query($query))
    echo $conn->error;