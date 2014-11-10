<?php
$servername = "mysql.heartfulmessage.com";
$username = "collecttweets";
$password = "collecttweets123";
$db = "collecttweets";
if (get_current_user() === "vagrant") {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "collecttweets";
}
// Create connection
$conn = new mysqli($servername, $username, $password, $db);
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
$hashtag = $_GET["hashtag"];
$favorites_count = $_GET["favorites_count"];
$retweets_count = $_GET["retweets_count"];

$query = "INSERT INTO "
        . "     $db.tweets  (id ,screen_name,profile_img_url,
                        user_name, pic_url, status, time,
                        `check`,tweet_id,hashtag,
                        favorites_count,retweets_count) "
        . "VALUES"
        . "( NULL, '$screen_name', '$profile_img_url',"
        . "'$user_name','$pic_url', '$status', '$time',"
        . "'$check','$id','$hashtag',"
        . "'$favorites_count', '$retweets_count') ";

if (!$conn->query($query))
    echo $conn->error;
else
    echo TRUE;