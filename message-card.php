<?php

$servername = "mysql.heartfullmessage.com";
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

$hashtag = $_GET["hashtag"];

$query = "SELECT    
                *
            FROM 
                tweets
            WHERE 
                hashtag = '$hashtag'
            ORDER BY 
                time DESC
                ";

$result = $conn->query($query);

if (!$result)
    die($conn->error);

$json_results = array();
$i = 0;

while ($row = $result->fetch_row()) {
//    var_dump($row);
    $row[0];
    $json_results[$i]["screen_name"] = $row[1];
    $json_results[$i]["profile_image_url"] = $row[2];
    $json_results[$i]["user_name"] = $row[3];
    $json_results[$i]["pic_url"] = $row[4];
    $json_results[$i]["status"] = $row[5];
    $json_results[$i]["time"] = $row[6];
    $json_results[$i]["check"] = $row[7];
    $json_results[$i]["original_tweet"]["id"] = $row[8];
    $i++;
}

header('Content-Type: application/json');
die(json_encode($json_results));
