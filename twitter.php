<?php
$accept_header = $_SERVER["HTTP_ACCEPT"];

if (!isset($_GET["tag"]) or $_GET["tag"] === "")
    die("{}");

$tag = $_GET["tag"];

include 'twitter-php-3.4/src/twitter.class.php';

$consumerKey = 'EFj8HPWWEGQFLZqIB8xXQpbsO';
$consumerSecret = 'zpUJj55311KCkBXuUd38pz1ubFPm6HwAkXicdygNKAEa3MLmq7';
$accessToken = '14299097-wo0nlrSLNqqjPm8YI5mXnuWj3VVQIdB848cXkv0qZ';
$accessTokenSecret = 'EMWsKb8vi9I7GswKQ04Rndii8yd6vEDW3cY5A4CscqksU';

// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

#$results = $twitter->search("#" . $tag);
if (!isset($_GET["max_id"]) or $_GET["max_id"] === "")
    $results = $twitter->search(array('q' => '#'.$tag, 'count' => '100'));
else
    $results = $twitter->search(array('q' => '#'.$tag, 'count' => '100','max_id' => $_GET["max_id"]));

if (strpos($accept_header, "json") !== FALSE) {
    header('Content-Type: application/json');
    $json_results = array();
    $i = 0;
    foreach ($results as $status) {
        $json_results[$i]["screen_name"] = $status->user->screen_name;
        $json_results[$i]["profile_image_url"] = htmlspecialchars($status->user->profile_image_url);
        $json_results[$i]["user_name"] = htmlspecialchars($status->user->name);
        $json_results[$i]["status"] = Twitter::clickable($status);
        $json_results[$i]["time"] = date("j.n.Y H:i", strtotime($status->created_at));
        $json_results[$i]["original_tweet"] = $status;
        $i++;
    }
    die(json_encode($json_results));
    //die(json_encode($results));
}
?>
<ul>
    <?php foreach ($results as $status): 
    ?>
        <li>
            <a href="http://twitter.com/<?php echo $status->user->screen_name ?>">
                <img src="<?php echo htmlspecialchars($status->user->profile_image_url) ?>">
                <?php echo htmlspecialchars($status->user->name) ?>
            </a>:
            <?php echo Twitter::clickable($status) ?>
            <small>at <?php echo date("j.n.Y H:i", strtotime($status->created_at)) ?></small>
        </li>
    <?php endforeach ?>
</ul>
