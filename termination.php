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
		];
		$last = $configid;
		$i++;
		$configid = $records[$i][$configid_idx];
	} while( $configid != $first );

	echo
' <tr>
  <th>benchmark
';
	foreach( $participants as $participant ) {
		echo
'  <th><a href="'. solverid2url($participant['solverid']) . '">'.$participant['solver'].'</a>
   <a class=config href="'. configid2url($participant['configid']) .'">'. $participant['config'].'</a>
';	}
	$bench = [];

	$conflicts = 0;
	foreach( $records as $record ) {
		$configid = $record[$configid_idx];
		$participant =& $participants[$configid];
		$status = $record[$status_idx];
		$cpu = parse_time($record[$cputime_idx]);
		$time = parse_time($record[$wallclocktime_idx]);
		$result = $record[$result_idx];
		$score = result2score($result);
		$cert = $certificationresult_idx ? $record[$certificationresult_idx] : '';
		$certtime = $certificationtime_idx ? $record[$certificationtime_idx] : 0;
		if( $configid == $first ) {
			$bench = [];
			$benchmark = parse_benchmark( $record[$benchmark_idx] );
			$benchmark_id = $record[$benchmark_id_idx];
			$benchmark_url = bmid2url($benchmark_id);
			$benchmark_remote = bmid2remote($benchmark_id);
			$resultcounter = []; /* collects results for each benchmark */
			$show = false;
		}
		if( !status2pending($status) ) {
			$show = true;
		}
		if( status2complete($status) ) {
			$participant['done'] += 1;
			$participant['cpu'] += $cpu;
			$participant['time'] += $time;
			$participant[$result] += 1;
			$participant['score'] += $score;
			$participant['certtime'] += $certtime;
			$resultcounter[$result]++;
		} else {
			$participant['togo'] += 1;
		}
		$bench[$configid] = [
			'status' => $status,
			'result' => $result,
			'score' => $score,
			'cert' => $cert,
			'time' => $time,
			'cpu' => $cpu,
			'certtime' => $certtime,
			'pair' => $record[$pairid_idx],
		];
		if( $configid == $last && $show ) {
			$firstconflict = false;
			if( conflicting($resultcounter) ) {
				$firstconflict = $conflicts == 0;
				foreach( array_keys($bench) as $me ) {
					if( $bench[$me]['score'] > 0 ) {
						$participants[$me]['conflicts']++;
					}
				}
				echo
' <tr class=conflict>
';
				$conflicts += 1;
			} else {
				echo
' <tr>
';
			}
			echo
'  <td class=benchmark>
';
			if( $firstconflict ) {
				echo
'   <a name="conflict"/>
';
			}
			echo
'   <a href="'. $benchmark_url.'">'.$benchmark.'</a>
   <a class=starexecid href="'.$benchmark_remote.'">'.$benchmark_id.'</a></td>
';
			foreach( array_keys($bench) as $me ) {
				$my = $bench[$me];
				$status = $my['status'];
				$result = $my['result'];
				$cert = $my['cert'];
				$certtime = $my['certtime'];
				$url = pairid2url($my['pair']);
				$outurl = pairid2outurl($my['pair']);
				if( $status == 'complete' ) {
					echo
'  <td ' . result2style($result) . '>
   <a href="'. $outurl .'">' . result2str($result) . '</a>
   <a href="'. $url .'">
    <span class=time>' . $my['cpu'] . '/' . $my['time'] . '</span>
';
					if( $cert && $cert != '-' ) {
						echo
' (' . $cert . '&nbsp;<span class=time>'. $certtime . '</span>)
';
					}
					echo
'   </a>
';
				} else {
					echo
'  <td ' . status2style($status) . '>
   <a href="'. $url . '">' . $status . '</a>
' . (status2complete($status) ? '   <a href="'. $outurl .'">[out]</a>
' : '' );
				}
			}
		}
	}
	echo
' <tr><th>
';
	foreach( $participants as $s ) {
		echo '  <th>'.$s['score'];
	}
	$scorefileD = fopen($scorefile,'w');
	fwrite( $scorefileD, json_encode($participants) );
	fclose( $scorefileD );
?>
</table>
</body>
</html>