<?php
$contents = file_get_contents($_GET['url']);

// skip garbage 7 lines
$here = 0;
for($i=0; $i < 7; $i++) {
    $here = strpos($contents,"\n",$here)+1;
}
$contents = substr($contents, $here);

if( substr($contents, 0, 5) == '<?xml' ) {
    header('Content-Type: text/xml');
} else if( substr($contents, 0, 6) == '<?html' ) {
    header('Content-Type: text/html' );
} else {
    header('Content-Type: text/plain' );
}
echo $contents;
?>