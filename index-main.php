<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" type="text/css" href="master.css">
<?php
include 'definitions.php';
include 'competition_info.php';

$refresh = in_array( 'refresh', $argv );
$finalize = in_array( 'finalize', $argv );
$show_config = $_GET['showconfig'];

echo ' <title>'.$title.'</title>'.PHP_EOL;
?>
</head>
<body>
 <h1><?php echo $title; ?>
 <span id=scoreToggler class=button></span>
 <span id=columnToggler class=button></span>
</h1>
<script>
var scoreToggler = StyleToggler(
	document.getElementById("scoreToggler"), ".score", [
		{ text: "Hide scores", assign: {display: "inline"} },
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
echo $note.PHP_EOL;
$mcatindex = 0;
foreach( array_keys($mcats) as $mcatname ) {
	$total_done = 0;
	$total_togo = 0;
	$total_cpu = 0;
	$total_time = 0;
	echo '<h2>'.$mcatname.'<span id=stat'.$mcatindex.' class=stats></span></h2>'.PHP_EOL;
	$cats = $mcats[$mcatname];
	$table = [];
	$tools = [];
	foreach( $cats as $catname => $cat ) {
		$type = $cat['type'];
		$jobid = $cat['jobid'];
		if( !$jobid ) {// This means the job is not yet started or linked to starexec-master.
			echo ' <div class=category>'.$catname.'<br/>'.PHP_EOL.
			     '  <div class=ranking>'.PHP_EOL;
			foreach( $cat['parts'] as $partname => $configid ) {
				echo '   '. $partname. '<a class=starexecid href="'. configid2url($configid) .'">'. $configid .'</a>'.PHP_EOL;
			}
			echo '  </div>'.PHP_EOL.
			     ' </div>';
			continue;
		}
		// creating job html
		$jobargs = [
			'competitionname' => $shortname,
			'id' => $jobid,
			'name' => $catname,
		];
		$jobpath = 'job_'.$jobid.'.html';
		$graphpath = 'graph_'.$jobid.'.html';
		if( $refresh || $finalize ) {
			$jobargs['refresh'] = 1;
			if( $finalize ) {
				$jobargs['finalize'] = 1;
			}
			system( 'php-cgi -f "'. $type . '.php" '. http_build_query( $jobargs, '', ' ' ) .' > "'. $jobpath . '"');
			// making graph
			$jobargs = [
				'mcat' => $mcatname,
				'cat' => $catname,
			];
			system( 'php-cgi -f "graph.php" '. http_build_query( $jobargs, '', ' ' ) .' > "'. $graphpath . '"');
		}
		// checking cached score file and making ranking
		$fname = jobid2scorefile($jobid); 
		if( file_exists($fname) ) {
			$solvers = json_decode(file_get_contents($fname),TRUE);
			foreach( $solvers as $s ) {
				$total_togo += $s['togo'];
				$total_done = $s['done'];
				$total_cpu += $s['cpu'];
				$total_time += $s['time'];
			}
		}
		echo ' <span id='.$jobid.' class=category></span>'.PHP_EOL;
		echo ' <script>'.PHP_EOL.
		     '  function load'.$jobid.'() {'.PHP_EOL.
			 '   var elm = document.getElementById("'.$jobid.'");'.PHP_EOL.
			 '   loadURL("'.$graphpath.'", function (xhttp) {'.PHP_EOL.
			 '    elm.innerHTML = xhttp.responseText;'.PHP_EOL.
			 '    scoreToggler.apply(elm);'.PHP_EOL.
			 '   });'.PHP_EOL.
			 '  }'.PHP_EOL.
			 '  load'.$jobid.'();'.PHP_EOL.
			 '  setInterval(load'.$jobid.', 10000);'.PHP_EOL.
			 ' </script>'.PHP_EOL;
	}
	echo '<script>'.PHP_EOL.
	     '	document.getElementById("stat'.$mcatindex.'").innerHTML = "Progress: ' . round(100 * $total_done / ($total_done + $total_togo), 2) .
	     '%, CPU Time: '.seconds2str($total_cpu).', Node Time: '.seconds2str($total_time).'";'.PHP_EOL.
		 '</script>'.PHP_EOL;
	$mcatindex++;
}

?>

</body>
</html>
