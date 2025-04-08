<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="max-age=5, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="stylesheet" type="text/css" href="../master.css">
<?php

include 'definitions.php';

$competition = $_GET['competition'];
$mcatname = $_GET['mcatname'];
$name = $_GET['name'];
$id = $_GET['id'];
$ids = explode('_',$id);
$jobid = $ids[0];

?>
</head>
<body>
<?php

$cat_done = 0;
$cat_togo = 0;
#$cat_cpu = 0;
$cat_time = 0;
$togo = 0;

// checking cached score file and making ranking
$sum = json_decode(file_get_contents($competition.'/'.jobname2sumfile($name)),TRUE);
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
$jobpath = jobname2local($name);
echo ' <div class=category>'.PHP_EOL.
     '  <a href="' . $jobpath . '">' . $name . '</a>'.PHP_EOL;
if( $sum['conflicting'] ) {
	echo '<a class="conflict" href="' . $jobpath . '?filter1=c">conflicting</a>'.PHP_EOL;
} 
echo ' <table class=ranking>'.PHP_EOL;
foreach( $solvers as $configid => $s ) {
	$layer = $s['layer'];
	$name = $s['solver'];
	$id = $s['solver'];
	$config = $s['configuration'];
	$score = $s['score'];
	$miss = $s['miss'];
	$scorestogo = $s['scorestogo'];
	$togo = $s['togo'];
	$done = $s['done'];
#	$cpu = $s['cpu'];
	$time = $s['time'];
	$certtime = $s['certtime'];
	$conflicts = $s['conflicts'];
	$news = $s['news'];
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
		if( array_key_exists($key,$s) && $val['bar'] && $s[$key] > 0 ) {
			echo '       <td class="'.$key.'" style="width:'.(100 * $s[$key] / $total).'%">'.PHP_EOL;
		}
	}
	echo '     </table>'.PHP_EOL;
	// Textual display
	echo '     <td>'.PHP_EOL.
	     '      <span class="'.( $rank[$layer] == 1 ? 'best ' : '' ). 'solver">'.PHP_EOL.
	     '       <span class="rank">'.$rank[$layer].'.</span> <span class="tool">'. $name . '</span>'.PHP_EOL.
	     '      </span>'. PHP_EOL;
	foreach( $scored_keys as $key => $val ) {
		if( array_key_exists($key,$s) && $val['text'] != null ) {
			$subscore = $s[$key];
			if( $subscore != 0 ) {
				echo '<span class="'.( $subscore == $best[$layer][$key] ? 'best ' : '' ).$val['class'].'">'.
				     ($val['text'] == '' ? $key : $val['text']).':'.( is_int($subscore) ? $subscore : number_format($subscore,2) ).'</span>';
			}
		}
	}
	echo '<span class="score '.( $time == $best[$layer]['time'] ? 'best ' : '' ).'time">time:'.seconds2str(intdiv($time,1000)).'</span>';
	if( $certtime != 0 ) {
		echo '<span class="score certified time">'.seconds2str($certtime);
	}
	echo '</span>'.PHP_EOL;
#	$cat_cpu += $cpu;
	$cat_time += $time;
	$cat_done += $done;
	$cat_togo += $togo;
}
echo '  </table>'.PHP_EOL.
     ' </div>'.PHP_EOL;

?>

</body>
</html>
