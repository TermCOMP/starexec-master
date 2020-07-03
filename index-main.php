<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" type="text/css" href="master.css">
<?php
$refresh = in_array( 'refresh', $argv );
$finalize = in_array( 'finalize', $argv );

$show_config = $_GET['showconfig'];

if( !$finalize ) {
	echo '<meta http-equiv="refresh" content="10">'.PHP_EOL;
}

echo '</head>'.PHP_EOL.
	 '<body>'.PHP_EOL;

include 'definitions.php';
include 'competition_info.php';

$scored_keys = [
	'CERTIFIED YES',
	'CERTIFIED NO',
	'YES',
	'NO',
	'UP',
	'LOW',
];

// Main display
foreach( array_keys($mcats) as $mcatname ) {
	$total_done = 0;
	$total_togo = 0;
	$total_cpu = 0;
	$total_time = 0;
	echo '<h2>'. $mcatname .'</h2>'.PHP_EOL;
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
		$cat_done = 0;
		$cat_togo = 0;
		$cat_cpu = 0;
		$cat_time = 0;
		// creating job html
		$jobargs = [
			'competitionname' => $competitionname,
			'id' => $jobid,
			'name' => $catname,
		];
		$jobpath = 'job_'.$jobid.'.html';
		if( $refresh || $finalize ) {
			$jobargs['refresh'] = 1;
			if( $finalize ) {
				$jobargs['finalize'] = 1;
			}
			$tmp = tempnam();
			system( 'php-cgi -f "'. $type . '.php" '. http_build_query( $jobargs, '', ' ' ) .' > "'. $tmp . '"');
			rename($tmp,$jobpath);
		}
		$init = false;
		$togo = 0;
		$conflicts = 0;
		$best = [ 'score' => 1, 'time' => INF ];
		foreach( $scored_keys as $key ) {
			$best[$key] = 1;
		}

		// checking cached score file and making ranking
		$fname = jobid2scorefile($jobid); 
		if( file_exists($fname) ) {
			$init = true;
			$solvers = json_decode(file_get_contents($fname),TRUE);
			uasort($solvers, function($s,$t) { return $s['score'] < $t['score'] ? 1 : -1; } );
			foreach( $solvers as $s ) {
				$togo += $s['togo'];
				$conflicts += $s['conflicts'];
				foreach( $scored_keys as $key ) {
					$best[$key] = max($best[$key], $s[$key]);
				}
				$best['time'] = min($best['time'], $s['time']);
			}
		}
		echo ' <div class=category>'.PHP_EOL.
			 '  <a href="' . $jobpath . '">' . $catname . '</a>'.PHP_EOL.
			 '  <a class=starexecid href="' . jobid2url($jobid) . '">' . $jobid . '</a>'.PHP_EOL;
		if( $init ) {
			if( $conflicts > 0 ) {
				echo '<a class=conflict href="' . $jobpath . '#conflict">conflict</a>'.PHP_EOL;
			} 
			echo '  <table class=ranking>'.PHP_EOL;
			$prev_score = $best['score'];
			$rank = 1;
			$count = 0;
			foreach( $solvers as $s ) {
				$score = $s['score'];
				$unscored = $s['unscored'];
				$togo = $s['togo'];
				$done = $s['done'];
				$cpu = $s['cpu'];
				$time = $s['time'];
				$certtime = $s['certtime'];
				$conflicts = $s['conflicts'];
				$name = $s['solver'];
				$id = $s['solverid'];
				$config = $s['config'];
				$configid = $s['configid'];
				$url = solverid2url($id);
				$count += 1;
				if( $prev_score > $score ) {
					$rank = $count;
				}
				$prev_score = $score;
				// Making progress bar
				$total = $score + $unscored + $togo;
				echo '   <tr>'.PHP_EOL.
					 '    <td>'.PHP_EOL.
					 '     <table class=bar>'.PHP_EOL.
					 '      <tr style="height:1ex">'.PHP_EOL;
				foreach( $scored_keys as $key ) {
					if( array_key_exists( $key, $s ) ) {
						echo '       <td ' . result2style($key) . ' style="width:'. (100 * $s[$key] / $total) . '%">'.PHP_EOL;
					}
				}
				if( $togo > 0 ) {
					echo '       <td class=incomplete style="width:'. (100 * $togo / $total) . '%">'.PHP_EOL;
			    }
				if( $unscored > 0 ) {
				   echo '       <td class=maybe style="width:'. (100 * $unscored / $total) . '%">'.PHP_EOL;
				}
				echo '     </table>'.PHP_EOL;
				// Textual display
				echo '     <td>'.PHP_EOL.
					 '      <span class='. ( $rank == 1 ? 'best' : '' ) . 'solver>'.PHP_EOL.
					 '       '. $rank .'. <a href="'. $url . '">'. $name . '</a>';
				if( $show_config ) {
					echo PHP_EOL.
						'       <a class=config href="' . configid2url($configid) . '">'. $config . '</a>';
				}
				echo '      </span>'. PHP_EOL.
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
						 '   <span class=togo> ' . $togo . ' to go</span>';
				}
				echo '</span>'.PHP_EOL;
				$cat_cpu += $cpu;
				$cat_time += $time;
				$cat_done += $done;
				$cat_togo += $togo;
				$total_cpu += $cpu;
				$total_time += $time;
				$total_done += $done;
				$total_togo += $togo;
			}
			echo '  </table>'.PHP_EOL;
		}
		echo ' </div>'.PHP_EOL;
	}
	echo
'<p>Progress: ' . $total_done . ($total_done + $total_togo) .
', CPU Time: ' . seconds2str($total_cpu).
', Node Time: ' . seconds2str($total_time) . '</p>
';
}

?>

</body>
</html>
