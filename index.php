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
	echo
'<meta http-equiv="refresh" content="10">
';
}

echo
'</head>
<body>
';

include 'definitions.php';
include 'Y2020_info.php';

$scored_keys = [
	'CERTIFIED YES',
	'CERTIFIED NO',
	'YES',
	'NO',
	'UP',
	'LOW',
];

$raw_mcats = $competition['mcats'];

// Making certified and demonstration categories
$mcats = [];
foreach( $raw_mcats as $mcat_name => $raw_cats ) {
	$cats = [];
	foreach( $raw_cats as $cat_name => $cat ) {
		$certcat = $cat['certified'];
		unset( $cat['certified'] );
		$certcat = array_replace( $cat, $certcat );
		$cats[$cat_name] = $cat;
		$cats[$cat_name . ' Certified'] = $certcat;
	}
	foreach( $cats as $cat_name => $cat ) {
		switch( count($cat['parts']) ) {
		case 0:
			if( !$cat['jobid'] > 0 ) {
				unset($cats[$cat_name]);// remove unparticipated category
			}
			break;
		case 1:
			$mcats['Demonstrations'][$cat_name] = $cat;
			unset($cats[$cat_name]);
			break;
		}
	}
	$mcats[$mcat_name] = $cats;
}

// Main display
foreach( array_keys($mcats) as $mcatname ) {
	$total_done = 0;
	$total_togo = 0;
	$total_cpu = 0;
	$total_time = 0;
	echo
'<h2>' . $mcatname . '</h2>
';
	$cats = $mcats[$mcatname];
	$table = [];
	$tools = [];
	echo
'<table>
 <tr>
  <th class=category>category
  <th class=ranking>ranking
';
	foreach( $cats as $catname => $cat ) {
		$type = $cat['type'];
		$jobid = $cat['jobid'];
		if( !$jobid ) {// This means the job is not yet started or linked to starexec-master.
			echo
' <tr class=incomplete>
  <td class=category>'.$catname .'
  <td class=ranking>
';
			foreach( $cat['parts'] as $partname => $configid ) {
				echo
'   '. $partname. '<a class=starexecid href="'. configid2url($configid) .'">'. $configid .'</a>
';
			}
			continue;
		}
		$cat_done = 0;
		$cat_togo = 0;
		$cat_cpu = 0;
		$cat_time = 0;
		// creating job specific php file
		$jobphp = $type.'_'.$jobid.'.php';
		$jobpath = 'caches/'.$jobphp;
		if( ! file_exists($jobpath) ) {
			$file = fopen($jobpath,'w');
			fwrite( $file,
'<?php
$competitionname = '. str2str($competition['name']) . ';
$jobname = ' . str2str($catname) . ';
$jobid = ' . $jobid . ';
chdir("..");
include \'' . type2php($type) .'\';
?>'
			); 
			fclose($file);
		}
		if( $refresh ) {
			system( 'cd caches; php -f "'. $jobphp . '"; cd ..');
		}
		if( $finalize ) {
			$jobhtml = $type.'_'.$jobid.'.html';
			system( 'cd caches; php -f "'. $jobphp . '" > "'. $jobhtml .'" ; cd ..');
			$jobpath = 'caches/'. $jobhtml;
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
		if( !$init || $togo > 0 ) {
			$class = 'incomplete';
		} else {
			$class = 'complete';
		}
		echo
' <tr class=' . $class . '>
  <td class=category>
   <a href="' . $jobpath . '">' . $catname . '</a>
   <a class=starexecid href="' . jobid2url($jobid) . '">' . $jobid . '</a>
';
		if( $init ) {
			if( $conflicts > 0 ) {
				echo
'<a class=conflict href="' . $jobpath . '#conflict">conflict</a>
';
			} 
			echo
'  <td class=ranking>
';
			$prev_score = $best['score'];
			$rank = 1;
			$count = 0;
			foreach( $solvers as $s ) {
				$score = $s['score'];
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
				echo
'   <span class='. ( $rank == 1 ? 'best' : '' ) . 'solver>
    ' . $rank . '. <a href="'. $url . '">'. $name . '</a>';
				if( $show_config ) {
					echo '
     <a class=config href="' . configid2url($configid) . '">'. $config . '</a>';
				}
				echo '
    <span class=score>';
				foreach( $scored_keys as $key ) {
					if( array_key_exists( $key, $s ) ) {
						$subscore = $s[$key];
						echo '<span '. result2style( $key, $subscore == $best[$key] ) . '>'. $key . ':' . $subscore . '</span>, ';
					}
				}
				echo
'<span class='.( $time == $best['time'] ? 'besttime' : 'time' ).'>TIME:'.seconds2str($time).'</span>';
				if( $certtime != 0 ) {
					echo
', <span class=time>Certification:'.seconds2str($certtime).'</span>';
				}
				echo
'</span>
';
				if( $togo > 0 ) {
					echo
'   <span class=togo>, ' . $togo . ' to go</span>';
				}
				echo
'   </span><br/>
';
				$cat_cpu += $cpu;
				$cat_time += $time;
				$cat_done += $done;
				$cat_togo += $togo;
				$total_cpu += $cpu;
				$total_time += $time;
				$total_done += $done;
				$total_togo += $togo;
			}
		}
	}
	echo
'</table>
<p>Progress: ' . $total_done . ($total_done + $total_togo) .
', CPU Time: ' . seconds2str($total_cpu).
', Node Time: ' . seconds2str($total_time) . '</p>
';
}

?>

</body>
</html>
