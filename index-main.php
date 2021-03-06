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
$showconfig = array_key_exists( 'showconfig', $_GET );

?>
 <title><?php echo $title; ?></title>
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
		{ text: "Show configs", assign: { display: "none" } },
		{ text: "Hide configs", assign: { display: "" } },
	],
	<?php echo $showconfig ? '1' : '0'; ?>
);
var scoreToggler = StyleToggler(
	document.getElementById("scoreToggler"), ".score", [
		{ text: "Hide scores", assign: { display: "" } },
		{ text: "Show scores", assign: { display: "none" } },
	]
);
var columnToggler = StyleToggler(
	document.getElementById("columnToggler"), "span.category", [
		{ text: "One column", assign: { display: "inline" } },
		{ text: "Many column", assign: { display: "block" } },
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
	$catindex = 0;
	foreach( $cats as $catname => $cat ) {
		$type = $cat['type'];
		$id = $cat['id'];
		$jobids = explode('-',$id);
		$jobid = $jobids[0];
		$overlay = array_key_exists( 1, $jobids ) ? $jobids[1] : false;
		if( !$id ) {// This means the job is not yet started or linked to starexec-master.
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
		$jobpath = 'job_'.$id.'.html';
		$graphpath = 'graph_'.$id.'.html';
		if( $refresh || $finalize ) {
			$jobargs = [
				'id' => $id,
				'name' => $catname,
				'mcatname' => $mcatname,
				'type' => $type,
				'competitionname' => $shortname,
				'tpdbver' => $tpdbver,
				'refresh' => $refresh,
			];
			$query = http_build_query( $jobargs, '', ' ' );
			system( 'php-cgi -f "'. $type . '.php" '. $query .' > "'. $jobpath . '"');
			system( 'php-cgi -f "graph.php" '. $query .' > "'. $graphpath . '"');
		}
		echo ' <span id="'.$id.'" class=category></span>'.PHP_EOL;
		echo ' <script>'.PHP_EOL.
		     '  function load'.$id.'() {'.PHP_EOL.
		     '   var elm = document.getElementById("'.$id.'");'.PHP_EOL.
		     '   loadURL("'.$graphpath.'", function(xhttp) {'.PHP_EOL.
		     '    elm.innerHTML = xhttp.responseText;'.PHP_EOL.
		     '    scoreToggler.apply(elm);'.PHP_EOL.
		     '    configToggler.apply(elm);'.PHP_EOL.
		     '   });'.PHP_EOL.
		     '   loadURL("'.id2sumfile($id).'", function(xhttp) {'.PHP_EOL.
		     '    progress'.$mcatindex.'['.$catindex.'] = JSON.parse(xhttp.responseText)["all"];'.PHP_EOL.
		     '    updateProgress'.$mcatindex.'();'.PHP_EOL.
		     '   });'.PHP_EOL.
		     '  }'.PHP_EOL.
		     '  load'.$id.'();'.PHP_EOL.
		     '  setInterval(load'.$id.', 10000);'.PHP_EOL.
		     ' </script>'.PHP_EOL;
		$catindex++;
	}
	$mcatindex++;
}

?>

</body>
</html>
