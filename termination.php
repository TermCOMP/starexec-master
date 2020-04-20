<!DOCTYPE html>
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	include './definitions.php';
	
	if( $jobid == NULL ) {
		$jobid = $_GET['id'];
	}

	if( $jobid == NULL ) {
		echo '</head>';
		exit('no job to present');
	}
	$csv = jobid2csv($jobid);
	if( $_GET['refresh'] ) {
		cachezip(jobid2remote($jobid),$csv);
	}
	$scorefile = jobid2scorefile($jobid);

	echo " <title>$competitionname: $jobname</title>\n";
	echo "</head>\n";
	echo "<body>\n";
	echo "<h1>$competitionname: $jobname";
	echo "<a class=starexecid href='".jobid2url($jobid). "'>$jobid</a></h1>\n";
	echo "<a href='../$csv'>Job info CSV</a>\n";
	echo "<table>\n";
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
	unset( $records[0] );

	$solvers = [];

	$i = 1;
	$solverid = $records[$i][$solverid_idx];
	$firstsolver = $solverid;
	do {
		$solvers[$solverid] = [
			'name' => $records[$i][$solver_idx],
			'config' => $records[$i][$config_idx],
			'configid' => $records[$i][$configid_idx],
			'score' => 0,
			'conflicts' => 0,
			'done' => 0,
			'togo' => 0,
			'cpu' => 0,
			'time' => 0,
			'YES' => 0,
			'NO' => 0,
			'MAYBE' => 0,
		];
		$lastsolver = $solverid;
		$i++;
		$solverid = $records[$i][$solverid_idx];
	} while( $solverid != $firstsolver );

	echo " <tr>\n";
	echo "  <th>benchmark\n";
	foreach( array_keys($solvers) as $solverid ) {
		echo "  <th><a href='". solverid2url($solverid) . "'>".$solvers[$solverid]['name']."</a>\n";
	}
	echo " <tr><th>\n";
	foreach( $solvers as $s ) {
		echo "  <th class='config'><a href='". configid2url($s['configid']) ."'>". $s['config']."</a>\n";
	}
	echo " <tr>\n";
	$bench = [];

	$conflicts = 0;
	foreach( $records as $record ) {
		$solverid = $record[$solverid_idx];
		$status = $record[$status_idx];
		$cpu = parse_time($record[$cputime_idx]);
		$time = parse_time($record[$wallclocktime_idx]);
		$result = $record[$result_idx];
		$cert = $certificationresult_idx ? $record[$certificationresult_idx] : '';
		if( $solverid == $firstsolver ) {
			$bench = [];
			$benchmark = parse_benchmark( $record[$benchmark_idx] );
			$url = bmid2url($record[$benchmark_id_idx]);
		}
		if( status2complete($status) ) {
			$solvers[$solverid]['done'] += 1;
			$solvers[$solverid]['cpu'] += $cpu;
			$solvers[$solverid]['time'] += $time;
			$solvers[$solverid][$result] += 1;
			$solvers[$solverid]['score'] += result2score($result);
		} else {
			$solvers[$solverid]['togo'] += 1;
		}
		$bench[$solverid] = [
			'status' => $status,
			'result' => $result,
			'cert' => $cert,
			'time' => $time,
			'cpu' => $cpu,
			'pair' => $record[$pairid_idx],
		];
		if( $solverid == $lastsolver ) {
			$resultcounter = [];
			foreach( array_keys($bench) as $me ) {
				$result = $bench[$me]['result'];
				$resultcounter[$result]++;
			}
			$conflict = $resultcounter['YES'] > 0 && $resultcounter['NO'] > 0;
			if( $conflict ) {
				$conflicts += 1;
				echo " <tr class=conflict>\n";
			} else {
				echo " <tr>\n";
			}
			echo "  <td class=benchmark>\n";
			if( $conflict && $conflicts == 1 ) {
				echo "   <a name='conflict'/>\n";
			}
			echo "   <a href='$url'>$benchmark</a></td>\n";
			foreach( array_keys($bench) as $me ) {
				$my = $bench[$me];
				$status = $my['status'];
				$result = $my['result'];
				$cert = $my['cert'];
				$url = pairid2url($my['pair']);
				$outurl = pairid2outurl($my['pair']);
				if( $status == 'complete' ) {
					echo "  <td " . result2style($result,$cert) . ">
   <a href='$outurl'>" . result2str($result,$cert) . "</a>
   <a href='$url'>
    <span class=time>" . $my['cpu'] . "/" . $my['time'] . "</span>
   </a>\n";
				} else {
					echo "  <td " . status2style($status) . ">
   <a href='$url'>" . status2str($status) . "</a>
   <a href='$outurl'>[out]</a>\n";
				}
			}
			echo " </tr>\n";
		}
	}
	echo " <tr><th>\n";
	foreach( $solvers as $s ) {
		echo "  <th>".$s['score']."</th>\n";
	}
	$scorefileD = fopen($scorefile,"w");
	fwrite( $scorefileD, json_encode($solvers) );
	fclose( $scorefileD );
?>
</table>
</body>
</html>


