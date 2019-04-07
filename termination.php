<!DOCTYPE html>
<html lang='en'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	include './definitions.php';
	
	function str2result($str) {
		if( $str == 'YES' ) {
			return 1;
		} else if( $str == 'NO' ) {
			return -1;
		} else {
			return 0;
		}
	}
	function result2str($result) {
		if( $result == -1 ) {
			return 'NO';
		} else if( $result == 1 ) {
			return 'YES';
		} else {
			return 'MAYBE';
		}
	}
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
	unset( $records[0] );

	$solvers = [];
	$solvername = $records[1][3];
	$solver = $records[1][4];
	$config = $records[1][5];
	$configid = $records[1][6];
	$firstsolver = $solver;
	$i = 1;
	do {
		$solvers[$solver] = [
			'name' => $solvername,
			'config' => $config,
			'configid' => $configid,
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
		$lastsolver = $solver;
		$i++;
		$solvername = $records[$i][3];
		$solver = $records[$i][4];
		$config = $records[$i][5];
		$configid = $records[$i][6];
	} while( $solver != $firstsolver );

	echo " <tr>\n";
	echo "  <th>benchmark\n";
	foreach( array_keys($solvers) as $id ) {
		echo "  <th><a href='". solverid2url($id) . "'>".$solvers[$id]['name']."</a>\n";
	}
	echo " <tr><th>\n";
	foreach( $solvers as $s ) {
		echo "  <th class='config'><a href='". configid2url($s['configid']) ."'>". $s['config']."</a>\n";
	}
	echo " <tr>\n";
	$bench = [];

	$conflicts = 0;
	foreach( $records as $record ) {
		$solver = $record[4];
		$status = $record[7];
		$cpu = parse_time($record[8]);
		$time = parse_time($record[9]); 
		$result = str2result($record[11]);
		if( $solver == $firstsolver ) {
			$bench = [];
			$benchmark = parse_benchmark( $record[1] );
			$url = bmid2url($record[2]);
		}
		if( status2complete($status) ) {
			$solvers[$solver]['done'] += 1;
			$solvers[$solver]['cpu'] += $cpu;
			$solvers[$solver]['time'] += $time;
			$solvers[$solver][result2str($result)] += 1;
		} else {
			$solvers[$solver]['togo'] += 1;
		}
		$bench[$solver] = [
			'status' => $status,
			'result' => $result,
			'time' => $time,
			'cpu' => $cpu,
			'pair' => $record[0],
		];
		if( $solver == $lastsolver ) {
			$conflict = false;
			foreach( array_keys($bench) as $me ) {
				$my = $bench[$me];
				$score = abs($my['result']);
				$solvers[$me]['score'] += $score;
				foreach( $bench as $your ) {
					if( $my['result'] * $your['result'] < 0 ) {
						$conflict = true;
					}
				}
				if( $conflict ) {
					$solvers[$me]['conflicts'] += 1;
				}
			}
			if( $conflict ) {
				echo " <tr class=conflict>\n";
				$conflicts += 1;
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
				$url = pairid2url($my['pair']);
				$outurl = pairid2outurl($my['pair']);
				if( $status == 'complete' ) {
					echo "  <td " . result2style($result) . ">
   <a href='$outurl'>" . result2str($result) . "</a>
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


