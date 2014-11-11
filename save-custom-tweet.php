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

$user_name = $_GET["username"];
$status = $_GET["status"];
$hashtag = $_GET["hashtag"];

$query = "SELECT    
                tweet_id, time
            FROM 
                tweets
            WHERE 
                hashtag = '$hashtag'
            ORDER BY 
                time DESC
            LIMIT 
                1  ";

$result = $conn->query($query);

if (!$result)
    die($conn->error);

$max_id = -1;
$time = date("Y-n-j H:i");

while ($row = $result->fetch_row()) {
    $time = $row[1];
}

$query = "INSERT INTO
                 $db.tweets  (id,    user_name,  status, 
                            time,   `check`,    hashtag,
                            tweet_id,   favorites_count,    retweets_count)
            VALUES
                            (NULL, '$user_name',   '$status',
                             '$time',  '0',    '$hashtag',
                            '0', '0', '0') ";

if(!$conn->query($query))
    die($conn->error);

header('Content-Type: application/json');

$json_results = array();
$json_results[0]["screen_name"] = "";
$json_results[0]["profile_image_url"] = "";
$json_results[0]["user_name"] = $user_name;
$json_results[0]["pic_url"] = "";
$json_results[0]["status"] = $status;
$json_results[0]["time"] = $time;
$json_results[0]["check"] = 0;
$json_results[0]["original_tweet"]["id"] = 0;
$json_results[0]["favorites_count"] = 0;
$json_results[0]["retweets_count"] = 0;

header('Content-Type: application/json');
die(json_encode($json_results));
