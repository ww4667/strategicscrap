<?php
if(!isset($_SESSION)){
	session_start();
}

require_once($_SERVER['DOCUMENT_ROOT']."/gir/index.php");
//$auth = new Auth();

//$KILL = FALSE;
//
//while (!$KILL) {

switch($controller_action){

	/* Twitter */
	case 'twitter':
		$cache_file = $_SERVER['DOCUMENT_ROOT']."/cache/twitter-feed.cache";
		$feed_url = "https://www.twitter.com/statuses/user_timeline/156125388.rss";
		$twitter = get_cached_file($cache_file, 30, $feed_url);
		echo $twitter;			
		break;
	}
		//} // END WHILE $KILL
		?>