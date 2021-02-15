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

$mcatname = $_GET['mcatname'];
$catname = $_GET['name'];
$jobid = $_GET['id'];
$type = $_GET['type'];

?>
</head>
<body>
<?php

$scored_keys = [
	'CERTIFIED YES',
	'CERTIFIED NO',
	'YES',
	'NO',
	'UP',
	'LOW',
];

$cat_done = 0;
$cat_togo = 0;
$cat_cpu = 0;
$cat_time = 0;
$togo = 0;
$conflicts = 0;
$best = [ 'score' => 1, 'time' => INF ];
foreach( $scored_keys as $key ) {
	$best[$key] = 1;
}

// checking cached score file and making ranking
$solvers = json_decode(file_get_contents(jobid2scorefile($jobid)),TRUE);
uasort($solvers, function($s,$t) { return $s['score'] < $t['score'] ? 1 : -1; } );
foreach( $solvers as $s ) {
	$togo += $s['togo'];
	$conflicts += $s['conflicts'];
	foreach( $scored_keys as $key ) {
		$best[$key] = max($best[$key], array_key_exists($key,$s) ? $s[$key] : 0);
	}
	$best['time'] = min($best['time'], $s['time']);
}
$jobpath = 'job_'.$jobid.'.html';
echo ' <div class=category>'.PHP_EOL.
     '  <a href="' . $jobpath . '">' . $catname . '</a>'.PHP_EOL.
     '  <a class=starexecid href="' . jobid2url($jobid) . '">' . $jobid . '</a>'.PHP_EOL;
if( $conflicts > 0 ) {
	echo '<a class=conflict href="' . $jobpath . '#conflict">conflict</a>'.PHP_EOL;
} 
echo ' <table class=ranking>'.PHP_EOL;
$prev_score = $best['score'];
$rank = 1;
$count = 0;
foreach( $solvers as $configid => $s ) {
	$name = $s['solver'];
	$id = $s['solver id'];
	$config = $s['configuration'];
	$score = $s['score'];
	$unscored = $s['unscored'];
	$scorestogo = $s['scorestogo'];
	$togo = $s['togo'];
	$done = $s['done'];
	$cpu = $s['cpu'];
	$time = $s['time'];
	$certtime = $s['certtime'];
	$conflicts = $s['conflicts'];
	$url = solverid2url($id);
	$count += 1;
	if( $prev_score > $score ) {
		$rank = $count;
	}
	$prev_score = $score;
	// Making progress bar
	$total = $score + $unscored + $scorestogo;
	echo '   <tr>'.PHP_EOL.
	     '    <td>'.PHP_EOL.
	     '     <table class=bar>'.PHP_EOL.
	     '      <tr style="height:1ex">'.PHP_EOL;
	foreach( $scored_keys as $key ) {
		if( array_key_exists($key,$s) && $s[$key] > 0 ) {
			echo '       <td ' . result2style($key) . ' style="width:'. (100 * $s[$key] / $total) . '%">'.PHP_EOL;
		}
	}
	if( $scorestogo > 0 ) {
		echo '       <td class=incomplete style="width:'. (100 * $scorestogo / $total) . '%">'.PHP_EOL;
	}
	if( $unscored > 0 ) {
		echo '       <td class=maybe style="width:'. (100 * $unscored / $total) . '%">'.PHP_EOL;
	}
	echo '     </table>'.PHP_EOL;
	// Textual display
	echo '     <td>'.PHP_EOL.
	     '      <span class='. ( $rank == 1 ? 'best' : '' ) . 'solver>'.PHP_EOL.
	     '       '. $rank .'. <a href="'. $url . '">'. $name . '</a>'.PHP_EOL.
	     '       <a class=config href="' . configid2url($configid) . '">'. $config . '</a>'.PHP_EOL.
	     '      </span>'. PHP_EOL.
	     '      <span class=score>';
	foreach( $scored_keys as $key ) {
		if( array_key_exists( $key, $s ) ) {
			$subscore = $s[$key];
			echo '<span '. result2style( $key, $subscore == $best[$key] ) . '>'. $key . ':' . $subscore . '</span>, ';
		}
	}
	echo '<span class='.( $time == $best['time'] ? 'besttime' : 'time' ).'>TIME:'.seconds2str($time).'</span>';
	if( $certtime != 0 ) {
		echo ', <span class=time>Certification:'.seconds2str($certtime).'</span>';
	}
	if( $togo > 0 ) {
		echo ','.PHP_EOL.
		     '   <span class=togo>TOGO:' . $togo . '</span>';
	}
	echo '</span>'.PHP_EOL;
	$cat_cpu += $cpu;
	$cat_time += $time;
	$cat_done += $done;
	$cat_togo += $togo;
}
echo '  </table>'.PHP_EOL.
     ' </div>'.PHP_EOL;

?>

</body>
</html>
