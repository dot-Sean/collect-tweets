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

$hashtag = $_GET["hashtag"];

$query = "SELECT    
                tweet_id
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

while ($row = $result->fetch_row())
    $max_id = $row[0];

header('Content-Type: application/json');
echo($max_id);
