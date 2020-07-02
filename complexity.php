<!DOCTYPE html>
<html lang='en'>
<head>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <meta http-equiv="Cache-Control" content="no-cache">
 <link rel="stylesheet" type="text/css" href="master.css">
<?php
	include './definitions.php';

	if( !array_key_exists( 'id', $_GET ) ) {
		echo '</head>';
		exit('no job to present');
	}
	$jobid = $_GET['id'];
	$competitionname = $_GET['competitionname'];
	$jobname = $_GET['name'];
	$refresh = $_GET['refresh'];
	$finalize = $_GET['finalize'];

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
	
	$csv = jobid2csv($jobid);
	if( $refresh ) {
		cachezip(jobid2remote($jobid),$csv);
	}
	$scorefile = jobid2scorefile($jobid);

	echo
' <title>' . $competitionname . ': ' . $jobname . '</title>
</head>
<body>
<h1><a href="..">' . $competitionname . '</a>: ' . $jobname .
'<a class=starexecid href="' . jobid2url($jobid) . '">'. $jobid . '</a></h1>
<a href="../'. $csv . '">Job info CSV</a>
<table>
';
	$file = new SplFileObject($csv);
	$file->setFlags( SplFileObject::READ_CSV );
	$records = [];
	foreach( $file as $row ) {
	  if( !is_null($row[0]) ) {
	    $records[] = $row;
	  }
	}
	$pairid_idx = array_search('pair id', $records[0]);
	$benchmark_idx = array_search('benchmark', $records[0]);
	$benchmark_id_idx = array_search('benchmark id', $records[0]);
	$solver_idx = array_search('solver', $records[0]);
	$solverid_idx = array_search('solver id', $records[0]);
	$config_idx = array_search('configuration', $records[0]);
	$configid_idx = array_search('configuration id', $records[0]);
	$status_idx = array_search('status', $records[0]);
	$cputime_idx = array_search('cpu time', $records[0]);
	$wallclocktime_idx = array_search('wallclock time', $records[0]);
	$memoryusage_idx = array_search('memory usage', $records[0]);
	$result_idx = array_search('result', $records[0]);
	$certificationresult_idx = array_search('certification-result', $records[0]);
	$certificationtime_idx = array_search('certification-time', $records[0]);
	unset( $records[0] );

	$participants = [];
	$i = 1;
	$configid = $records[$i][$configid_idx];
	$first = $configid;
	do {
		$participants[$configid] = [
			'solver' => $records[$i][$solver_idx],
			'solverid' => $records[$i][$solverid_idx],
			'config' => $records[$i][$config_idx],
			'configid' => $configid,
			'score' => 0,
			'conflicts' => 0,
			'done' => 0,
			'togo' => 0,
			'cpu' => 0,
			'time' => 0,
			'certtime' => 0,
			'UP' => 0,
			'LOW' => 0,
		];
		$last = $configid;
		$i++;
		$configid = $records[$i][$configid_idx];
	} while( $configid != $first );

	echo
' <tr>
  <th>
';
	foreach( $participants as $participant ) {
		echo
'  <th colspan=3><a href="'. solverid2url($participant['solverid']) . '">'.$participant['solver'].'</a>
   <a class=config href="'. configid2url($participant['configid']) .'">'. $participant['config'].'</a>
';
	}
	echo ' <tr>
  <th>benchmark
';
	foreach( $participants as $participant ) {
		echo
'  <td>UP<td>LOW<td>TIME
';
	}
	$bench = [];

	$conflicts = 0;
	foreach( $records as $record ) {
		$configid = $record[$configid_idx];
		$participant =& $participants[$configid];
		$status = $record[$status_idx];
		$cpu = parse_time($record[$cputime_idx]);
		$time = parse_time($record[$wallclocktime_idx]);
		$result = $record[$result_idx];
		$bounds = str2bounds( $result );
		$lower = $bounds[0];
		$upper = $bounds[1];
		$cert = $certificationresult_idx ? $record[$certificationresult_idx] : '';
		$certtime = $certificationtime_idx ? $record[$certificationtime_idx] : 0;
		if( $configid == $first ) {
			$bench = [];
			$benchmark = parse_benchmark( $record[$benchmark_idx] );
			$benchmark_id = $record[$benchmark_id_idx];
			$benchmark_url = bmid2url($benchmark_id);
			$benchmark_remote = bmid2remote($benchmark_id);
			$show = false;
		}
		if( !status2pending($status) ) {
			$show = true;
		}
		if( status2complete($status) ) {
			$participant['done'] += 1;
			$participant['cpu'] += $cpu;
			$participant['time'] += $time;
			$participant['certtime'] += $certtime;
		} else {
			$participant['togo'] += 1;
		}
		$bench[$configid] = [
			'status' => $status,
			'result' => $result,
			'cert' => $cert,
			'time' => $time,
			'cpu' => $cpu,
			'certtime' => $certtime,
			'pair' => $record[$pairid_idx],
			'lower' => $lower,
			'upper' => $upper,
		];
		if( $configid == $last && $show ) {
			echo
' <tr>
  <td class=benchmark>
   <a href="'. $benchmark_url.'">'.$benchmark.'</a>
   <a class=starexecid href="'.$benchmark_remote.'">'.$benchmark_id.'</a>
';
			foreach( array_keys($bench) as $me ) {
				$my = $bench[$me];
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
				$a = '<a href="'. pairid2url($my['pair']) . '" class=fill>';
				$lower = $my['lower'];
				$upper = $my['upper'];
				$status = $my['status'];
				if( $status == 'complete' ) {
					if( $upscore == 0 && $lowscore == 0 ) {
						$participants[$me]['unscored'] += 1;
					} else {
						$participants[$me]['UP'] += $upscore;
						$participants[$me]['LOW'] += $lowscore;
						$participants[$me]['score'] += $upscore + $lowscore;
					}
					echo
'  <td '. $upperstyle .'>'. $a . bound2str($upper) . ' <span class=score>+'. $upscore .'</span></a>
  <td '. $lowerstyle .'>'. $a . bound2str($lower) . ' <span class=score>+'. $lowscore .'</span></a>
  <td class=time>'. $a . $my['cpu'] .'/'. $my['time'] . '</a>
';
				} else {
					echo
'  <td colspan=3 '. status2style($status) . '>'. $a . status2str($status) . '</a>
';
				}
			}
		}
	}
	echo
' <tr>
';
	foreach( $participants as $s ) {
		$score = $s['score'];
		echo '  <th><th colspan=3>'. $score;
	}
	$scorefileD = fopen($scorefile,'w');
	fwrite( $scorefileD, json_encode($participants) );
	fclose( $scorefileD );
?>
</table>
</body>
</html>


