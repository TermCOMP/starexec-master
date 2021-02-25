<!DOCTYPE html>
<html lang='en'>
<head>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <meta http-equiv="Cache-Control" content="no-cache">
 <link rel="stylesheet" type="text/css" href="master.css">
<?php
	error_reporting( E_ALL ^ E_NOTICE ); 
	include './definitions.php';

	if( !array_key_exists( 'id', $_GET ) ) {
		echo '</head>';
		exit('no job to present');
	}
	$jobid = $_GET['id'];
	$competitionname = $_GET['competitionname'];
	$jobname = $_GET['name'];
	$refresh = $_GET['refresh'];
	$benchFilter = $_GET['benchfilter'];

	function str2lower( $string ) {
		if( $string == 'Omega(1)' ) {
			return 0;
		} else if( preg_match( '/Omega\\(n\\^([0-9]+)\\)/', $string, $matches ) ) {
			return $matches[1];
		} else if( $string == 'NON_POLY' ) {
			return 1000;
		} else {
			return 0;
		}
	}

	function str2upper( $string ) {
		if( $string == 'O(1)' ) {
			return 0;
		} else if( preg_match( '/O\\(n\\^([0-9]+)\\)/', $string, $matches ) ) {
			return $matches[1];
		} else if( $string == 'POLY' ) {
			return 999;
		} else {
			return 1001;
		}
	}

	function bound2str( $bound ) {
		if( $bound == 0 ) {
			return '1';
		} else if( $bound < 999 ) {
			return 'n<sup>'.$bound.'</sup>';
		} else if( $bound == 999 ) {
			return 'n<sup>?</sup>';
		} else if( $bound == 1000 ) {
			return 'NonPoly';
		} else {
			return '&infin;';
		}
	}
	function lower2style( $bound ) {
		if( $bound == 0 ) {
			return 'class=maybe';
		} else if( $bound == 1 ) {
			return 'class=low1';
		} else if( $bound == 2 ) {
			return 'class=low2';
		} else if( $bound < 999 ) {
			return 'class=low3';
		} else if( $bound == 1000 ) {
			return 'class=lowNP';
		} else {
			return 'class=error';
		}	
	}
	function upper2style( $bound ) {
		if( $bound == 0 ) {
			return 'class=up0';
		} else if( $bound == 1 ) {
			return 'class=up1';
		} else if( $bound == 2 ) {
			return 'class=up2';
		} else if( $bound < 999 ) {
			return 'class=up3';
		} else if( $bound == 999 ) {
			return 'class=upP';
		} else if( $bound == 1000 ) {
			return 'class=yes';
		} else {
			return 'class=maybe';
		}
	}
	function str2bounds( $string ) {
		if( preg_match( '/WORST_CASE\\(\\s*(.+)\\s*,\\s*(.+)\\s*\\)/', $string, $matches ) ) {
			return [ str2lower($matches[1]), str2upper($matches[2]) ];
		}
		return [0,1001];
	}
	$benchmarks = [];
	$participants = [];
	$csv = jobid2csv($jobid);
	cachezip(jobid2remote($jobid),$csv,$refresh);
	parse_results($csv,$benchmarks,$participants);

	echo ' <title>' . $competitionname . ': ' . $jobname . '</title>'.PHP_EOL.
	     '</head>'.PHP_EOL.
	     '<body>'.PHP_EOL.
	     '<h1><a href=".">' . $competitionname . '</a>: ' . $jobname .'<a class=starexecid href="' . jobid2url($jobid) . '">'. $jobid . '</a></h1>'.PHP_EOL.
	     '<a href="'. $csv .'">Job info CSV</a>'.PHP_EOL;

	// initializing the list of participants
	$participants = [];
	foreach( $benchmarks[array_key_first($benchmarks)]['participants'] as $configid => $participant ) {
		$participants[$configid] = [
			'solver' => $participant['solver'],
			'solver id' => $participant['solver id'],
			'configuration' => $participant['configuration'],
			'score' => 0,
			'unscored' => 0,
			'scorestogo' => 0,
			'conflicts' => 0,
			'done' => 0,
			'togo' => 0,
			'cpu' => 0,
			'time' => 0,
			'certtime' => 0,
		];
	}
?>
<table id="theTable">
<script>
var filteredTable = FilteredTable(document.getElementById("theTable"));
</script>
<?php

	echo ' <tr class="head">'.PHP_EOL.
	     '<th>'.PHP_EOL;
	foreach( $participants as $participant ) {
		echo '  <th colspan=3><a href="'. solverid2url($participant['solverid']) . '">'.$participant['solver'].'</a>'.PHP_EOL.
		     '   <a class=config href="'. configid2url($participant['configid']) .'">'. $participant['config'].'</a>'.PHP_EOL;
	}
?>
 <tr class="head">
  <th>benchmark
   <input id="filter0" type="text" placeholder="Filter..." onkeyup="filteredTable.refresh()">
   <script>filteredTable.register(0,"filter0");</script>
  <th style="display:none">
   <script>filteredTable.register(1,"resultsFilter");</script>
<?php
	foreach( $participants as $participant ) {
		echo '  <th class="subhead">UP<th class="subhead">LOW<th class="subhead">TIME'.PHP_EOL;
	}
	$bench = [];
	// Max score for each benchmark, for up and low
	$maxscore = count($participants) * 2;

	$conflicts = 0;
	foreach( $benchmarks as $benchmark_id => $benchmark ) {
		$bench = [];
		$resultcounter = []; /* collects results for each benchmark */
		$show = false;
		foreach( $benchmark['participants'] as $configid => $record ) {
			$participant =& $participants[$configid];
			$status = $record['status'];
			$cpu = parse_time($record['cpu time']);
			$time = parse_time($record['wallclock time']);
			$result = $record['result'];
			$cert = $record['certification result'];
			$certtime = $record['certification time'];
			$bounds = str2bounds( $result );
			$lower = $bounds[0];
			$upper = $bounds[1];
			$show = $show || !status2pending($status);
			if( status2finished($status) ) {
				$participant['done'] += 1;
				$participant['cpu'] += $cpu;
				$participant['time'] += $time;
				$participant[$result] += 1;
				if( $score > 0 ) {
					$participant['score'] += $score;
				} else {
					$participant['unscored'] += 1;
				}
				$participant['certtime'] += $certtime;
				$resultcounter[$result]++;
			} else {
				$participant['togo'] += 1;
				$participant['scorestogo'] += 1;
			}
			$bench[$configid] = [
				'status' => $status,
				'result' => $result,
				'score' => $score,
				'cert' => $cert,
				'time' => $time,
				'cpu' => $cpu,
				'certtime' => $certtime,
				'pair' => $record['pair id'],
				'upper' => $upper,
				'lower' => $lower,
			];
		}
		if( $show ) {
			$d = results2description($resultcounter);
			if( $d['conflicting'] ) {
				$firstconflict = $conflicts == 0;
				foreach( array_keys($bench) as $me ) {
					if( $bench[$me]['score'] > 0 ) {
						$participants[$me]['conflicts']++;
					}
				}
				echo ' <tr class=conflict>'.PHP_EOL;
				if( $conflicts == 0 ) {
					echo '  <a name="conflict"/>'.PHP_EOL;
				}
				$conflicts += 1;
			} else {
				echo ' <tr>'.PHP_EOL;
			}
			echo '  <td class=benchmark>'.PHP_EOL.
			     '   <a href="'.bmid2url($benchmark_id).'">'.parse_benchmark( $benchmark['benchmark'] ).'</a>'.PHP_EOL.
			     '   <a class=starexecid href="'.bmid2remote($benchmark_id).'">'.$benchmark_id.'</a></td>'.PHP_EOL.
			     '  <td style="display:none">'.$d['key'];
			foreach( $bench as $me => $my ) {
				$status = $my['status'];
				$result = $my['result'];
				$cert = $my['cert'];
				$certtime = $my['certtime'];
				$url = pairid2url($my['pair']);
				$outurl = pairid2outurl($my['pair']);
				$upper = $my['upper'];
				$lower = $my['lower'];
				$upscore = 0;
				$lowscore = 0;
				foreach( $bench as $your ) {
					if( $upper < 1000 && $upper <= $your['upper'] ) {
						$upscore++;
					}
					if( $lower > 0 && $lower >= $your['lower'] ) {
						$lowscore++;
					}
					if( $lower > $your['upper'] ) {
						$conflicts++;
						$my['conflicts']++;
						$lowerstyle = 'class=conflict';
					} else {
						$lowerstyle = lower2style($lower);
					}
					if( $upper < $your['lower'] ) {
						$conflicts++;
						$my['conflicts']++;
						$upperstyle = 'class=conflict';
					} else {
						$upperstyle = upper2style($upper);
					}
				}
				$a = '<a href="'. $outurl .'" class=fill>';
				$lower = $my['lower'];
				$upper = $my['upper'];
				if( status2complete($status) ) {
					$participants[$me]['UP'] += $upscore;
					$participants[$me]['LOW'] += $lowscore;
					$participants[$me]['score'] += $upscore + $lowscore;
					$participants[$me]['unscored'] += $maxscore - $upscore - $lowscore;
					echo '  <td '. $upperstyle .'>'. $a . bound2str($upper) . ' <span class=score>+'. $upscore .'</span></a>'.PHP_EOL.
					     '  <td '. $lowerstyle .'>'. $a . bound2str($lower) . ' <span class=score>+'. $lowscore .'</span></a>'.PHP_EOL.
					     '  <td class=time>'. $a . $my['cpu'] .'/'. $my['time'] . '</a>'.PHP_EOL;
				} else {
					echo '  <td colspan=3 ' . status2style($status) . '>'.PHP_EOL.
					     '   <a href="'. $url . '">' . $status . '</a>'.PHP_EOL.
					     (status2complete($status) ? '   <a href="'. $outurl .'">[out]</a>'.PHP_EOL : '' );
				}
			}
		}
	}
	echo ' <tr>'.PHP_EOL;
	$sum = [
		'done' => 0,
		'togo' => 0,
		'cpu' => 0,
		'time' => 0,
	];
	foreach( $participants as $s ) {
		echo '  <th><th colspan=3>'.$s['score'];
		$sum['done'] += $s['done'];
		$sum['togo'] += $s['togo'];
		$sum['scorestogo'] += $s['scorestogo'];
		$s['cpu'] = (int)$s['cpu'];// eliminate round errors
		$sum['cpu'] += $s['cpu'];
		$s['time'] = (int)$s['time'];// eliminate round errors
		$sum['time'] += $s['time'];
	}
	file_put_contents( jobid2sumfile($jobid), json_encode($sum), LOCK_EX );
	file_put_contents( jobid2scorefile($jobid), json_encode($participants), LOCK_EX );
?>
</table>
<script>
	for( var key in get_args ) {
		if( key.substr(0,6) == "filter" ) {
			var e = document.getElementById(key);
			if( e != null ) {
				e.value = get_args[key];
			}
		}
	}
	window.onpageshow = function (event) {
		filteredTable.refresh();
	}
</script>
</body>
</html>


