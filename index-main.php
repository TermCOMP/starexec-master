<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" type="text/css" href="master.css">
<?php
include 'definitions.php';

$competition = array_key_exists( 'competition', $_GET ) ? $_GET['competition'] : 'Y2020';
include $competition.'_info.php';
$mcats = make_categories($categories);

$refresh = array_key_exists( 'refresh', $_GET );
$finalize = array_key_exists( 'finalize', $_GET );

echo ' <title>'.$title.'</title>'.PHP_EOL;
?>
</head>
<body>
 <h1><?php echo $title; ?>
 <span class="headerFollower">
  <?php echo $note.PHP_EOL; ?>
  <span id=configToggler class=button></span>
  <span id=scoreToggler class=button></span>
  <span id=columnToggler class=button></span>
 </span>
</h1>
<script>
var configToggler = StyleToggler(
	document.getElementById("configToggler"), ".config", [
		{ text: "Show configs", assign: {display: "none"} },
		{ text: "Hide configs", assign: {display: ""} },
	]
);
if( get_args["showconfig"] ) {
	configToggler.toggle();
}
var scoreToggler = StyleToggler(
	document.getElementById("scoreToggler"), ".score", [
		{ text: "Hide scores", assign: {display: ""} },
		{ text: "Show scores", assign: {display: "none"} },
	]
);
var columnToggler = StyleToggler(
	document.getElementById("columnToggler"), "span.category", [
		{ text: "One column", assign: {display: "inline"} },
		{ text: "Many column", assign: {display: "block"} },
	]
);
</script>
<?php
$mcatindex = 0;
foreach( array_keys($mcats) as $mcatname ) {
	$total_done = 0;
	$total_togo = 0;
	$total_cpu = 0;
	$total_time = 0;
	echo '<h2>'.$mcatname.' <span id=stat'.$mcatindex.' class=stats></span></h2>'.PHP_EOL;
	$cats = $mcats[$mcatname];
	$table = [];
	$tools = [];
	echo ' <script>'.PHP_EOL.
	     '  var progress'.$mcatindex.' = [];'.PHP_EOL.
	     '  function updateProgress'.$mcatindex.'() {'.PHP_EOL.
	     '   var sum = progress'.$mcatindex.'.reduce(function(a,b){return {done: a.done + b.done, cpu: a.cpu + b.cpu, time: a.time + b.time, togo: a.togo + b.togo}});'.PHP_EOL.
	     '   document.getElementById("stat'.$mcatindex.'").innerHTML ='.PHP_EOL.
	     '    "Progress: " + Math.floor(1000 * sum.done / (sum.done + sum.togo))/10 +'.PHP_EOL.
	     '    "%, CPU Time: " + seconds2str(sum.cpu) + ", Node Time: "+ seconds2str(sum.time);'.PHP_EOL.
	     '  }'.PHP_EOL.
	      '</script>'.PHP_EOL;
	foreach( $cats as $catname => $cat ) {
		$type = $cat['type'];
		$jobid = $cat['jobid'];
		$overlay = array_key_exists( 'overlay', $cat ) ? $cat['overlay'] : false;
		if( !$jobid ) {// This means the job is not yet started or linked to starexec-master.
			echo ' <div class=category>'.$catname.PHP_EOL.
			     '  <div class=ranking>'.PHP_EOL.
			     '   <ul>'.PHP_EOL;
			foreach( $cat['participants'] as $partname => $configid ) {
				echo '   <li>'. $partname.
				     '<a class=starexecid href="'. configid2url($configid) .'">'. $configid .'</a></li>'.PHP_EOL;
			}
			echo '   </ul>'.PHP_EOL.
			     '  </div>'.PHP_EOL.
			     ' </div>';
			continue;
		}
		// creating job html
		$jobpath = 'job_'.$jobid.'.html';
		$graphpath = 'graph_'.$jobid.'.html';
		if( $refresh || $finalize ) {
			$jobargs = [
				'id' => $jobid,
				'name' => $catname,
				'mcatname' => $mcatname,
				'type' => $type,
				'competitionname' => $shortname,
				'refresh' => $refresh,
			];
			if( $overlay ) {
				$jobargs['overlay'] = $overlay;
			}
			$query = http_build_query( $jobargs, '', ' ' );
			system( 'php-cgi -f "'. $type . '.php" '. $query .' > "'. $jobpath . '"');
			system( 'php-cgi -f "graph.php" '. $query .' > "'. $graphpath . '"');
		}
		echo ' <span id='.$jobid.' class=category></span>'.PHP_EOL;
		echo ' <script>'.PHP_EOL.
		     '  function load'.$jobid.'() {'.PHP_EOL.
		     '   var elm = document.getElementById("'.$jobid.'");'.PHP_EOL.
		     '   loadURL("'.$graphpath.'", function(xhttp) {'.PHP_EOL.
		     '    elm.innerHTML = xhttp.responseText;'.PHP_EOL.
		     '    scoreToggler.apply(elm);'.PHP_EOL.
		     '    configToggler.apply(elm);'.PHP_EOL.
		     '   });'.PHP_EOL.
		     '   loadURL("'.jobid2sumfile($jobid).'", function(xhttp) {'.PHP_EOL.
		     '    progress'.$mcatindex.'['.$jobid.'] = JSON.parse(xhttp.responseText);'.PHP_EOL.
		     '    updateProgress'.$mcatindex.'();'.PHP_EOL.
		     '   });'.PHP_EOL.
		     '  }'.PHP_EOL.
		     '  load'.$jobid.'();'.PHP_EOL.
		     '  setInterval(load'.$jobid.', 10000);'.PHP_EOL.
		     ' </script>'.PHP_EOL;
	}
	$mcatindex++;
}

?>

</body>
</html>
