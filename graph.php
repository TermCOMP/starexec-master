<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="max-age=5, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" type="text/css" href="master.css">
<?php

include 'definitions.php';

$mcatname = $_GET['mcatname'];
$catname = $_GET['name'];
$id = $_GET['id'];
$ids = explode('_',$id);
$jobid = $ids[0];

?>
</head>
<body>
<?php

$cat_done = 0;
$cat_togo = 0;
$cat_cpu = 0;
$cat_time = 0;
$togo = 0;
$conflicts = 0;

// checking cached score file and making ranking
$sum = json_decode(file_get_contents(id2sumfile($id)),TRUE);
$solvers = $sum['participants'];
$layers = $sum['layers'];
uasort($solvers, function($s,$t) { return $s['score'] < $t['score'] ? 1 : -1; } );
$best = [];
for( $i = 0; $i < count($layers); $i++ ) {
	$best[$i] = [ 'score' => 1, 'time' => INF ];
	foreach( $scored_keys as $key => $val ) {
		$best[$i][$key] = 1;
	}
}
foreach( $solvers as $s ) {
	$layer = $s['layer'];
	foreach( $scored_keys as $key => $val ) {
		$best[$layer][$key] = max($best[$layer][$key], array_key_exists($key,$s) ? $s[$key] : 0);
	}
	$best[$layer]['time'] = min($best[$layer]['time'], $s['time']);
}

$rank = [];
$count = [];
$prev_score = [];
for( $i = 0; $i < count($layers); $i++ ) {
	$rank[$i] = 1;
	$count[$i] = 0;
	$prev_score[$i] = 1;
}
$jobpath = 'job_'.$id.'.html';
echo ' <div class=category>'.PHP_EOL.
     '  <a href="' . $jobpath . '">' . $catname . '</a>'.PHP_EOL;
foreach( $ids as $i ) {
	echo '  <a class=starexecid href="' . jobid2url($i) . '">' . $i . '</a>'.PHP_EOL;
}
if( $conflicts > 0 ) {
	echo '<a class=conflict href="' . $jobpath . '#conflict">conflict</a>'.PHP_EOL;
} 
echo ' <table class=ranking>'.PHP_EOL;
foreach( $solvers as $configid => $s ) {
	$layer = $s['layer'];
	$name = $s['solver'];
	$id = $s['solver id'];
	$config = $s['configuration'];
	$score = $s['score'];
	$miss = $s['miss'];
	$scorestogo = $s['scorestogo'];
	$togo = $s['togo'];
	$done = $s['done'];
	$cpu = $s['cpu'];
	$time = $s['time'];
	$certtime = $s['certtime'];
	$conflicts = $s['conflicts'];
	$timeout = $s['TIMEOUT'];
	$url = solverid2url($id);
	$count[$layer] += 1;
	if( $prev_score[$layer] != $score ) {
		$rank[$layer] = $count[$layer];
		$prev_score[$layer] = $score;
	}
	// Making progress bar
	$total = $score + $miss + $scorestogo;
	$cert = $certtime ? 'CERTIFIED' : false;
	echo '   <tr class="layer'.$layer.($cert ? ' '.$cert : '').'">'.PHP_EOL.
	     '    <td>'.PHP_EOL.
	     '     <table class="bar">'.PHP_EOL.
	     '      <tr style="height:1ex">'.PHP_EOL;
	foreach( $scored_keys as $key => $val ) {
		if( array_key_exists($key,$s) && $s[$key] > 0 ) {
			echo '       <td class="'.$key.'" style="width:'.(100 * $s[$key] / $total).'%">'.PHP_EOL;
		}
	}
	if( $scorestogo > 0 ) {
		echo '       <td class=incomplete style="width:'. (100 * $scorestogo / $total) . '%">'.PHP_EOL;
	}
		if( $miss > 0 ) {
		echo '       <td class=MAYBE style="width:'. (100 * $miss / $total) . '%">'.PHP_EOL;
	}
	echo '     </table>'.PHP_EOL;
	// Textual display
	echo '     <td>'.PHP_EOL.
	     '      <span class="'.( $rank[$layer] == 1 ? 'best ' : '' ). 'solver">'.PHP_EOL.
	     '       <span class="rank">'.$rank[$layer].'.</span> <a class="tool" href="'. $url . '">'. $name . '</a>'.PHP_EOL.
	     '       <a class="config" href="' . configid2url($configid) . '">'. $config . '</a>'.PHP_EOL.
	     '      </span>'. PHP_EOL.
	     '      <span class="score">';
	foreach( $scored_keys as $key => $val ) {
		if( array_key_exists( $key, $s ) ) {
			$subscore = $s[$key];
			if( $subscore > 0 ) {
				echo '<span class="'.( $subscore == $best[$layer][$key] ? 'best ' : '' ).$key.'">'.
				     $val['result'].':'.( is_int($subscore) ? $subscore : number_format($subscore,2) ).'</span>,'.PHP_EOL;
			}
		}
	}
	echo '<span class="'.( $time == $best[$layer]['time'] ? 'best ' : '' ).'time">TIME:'.seconds2str($time).'</span>';
//	     ',<span class="time">OUT: '.$timeout.'</span>';
	if( $certtime != 0 ) {
		echo '<span class="certified time">'.seconds2str($certtime).'</span>';
	}
	if( $togo > 0 ) {
		echo ','.PHP_EOL.'<span class="togo">TOGO:' . $togo . '</span>';
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
