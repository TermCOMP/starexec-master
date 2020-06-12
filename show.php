<?php
$contents = file_get_contents($_GET['url']);

if( substr($contents, 0, 5) == '<?xml' ) {
    header('Content-Type: text/xml');
} else if( substr($contents, 0, 6) == '<?html' ) {
    header('Content-Type: text/html' );
} else {
    header('Content-Type: text/plain' );
}
echo $contents;
?>