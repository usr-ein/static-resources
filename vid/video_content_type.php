<?php
/*
 * Little script to:
 *  1) Change the content type from application/octet-stream to video/mp4 so that 
 *     the browser will play and not download the video
 *  2) Download the requested video from Github
 *  3) Serve it to the client in the response
 *
 *  This is to circumvent the Github limitation of serving videos as application/octet-stream
 *  meaning our unit tests can't use them for testing.
 *
 *  Just host this script anywhere and call
 *
 *  https://anywhere.com/video_content_type.php?filename=VIDEO_FILENAME_HERE.mp4
 *
 *  THIS SCRIPT IS NOT SUPER SECURE, YOU SHOULD SANITIZE $_GET BEFORE USING IT !!!
 *  Or you could also no publicly advertise that url... Your call
 */

header("Content-Type: video/mp4");
// to understand why we need the false use_include_path=false
// see https://stackoverflow.com/a/1336419/5989906
$content = file_get_contents(
	"https://github.com/sam1902/static-resources/raw/master/vid/".$_GET["filename"],
	false);
// Don't forget the Content-Length
// strlen counts the number of bytes in the str, funnily enough
// whilst mb_strlen counts the number of chars
header("Content-Length: " . strlen($content));
echo($content);
