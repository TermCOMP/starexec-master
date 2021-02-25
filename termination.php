<!DOCTYPE html>
<html lang='en'>
<head>
 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
 <meta http-equiv="Cache-Control" content="no-cache">
 <link rel="stylesheet" type="text/css" href="master.css">

<?php
	error_reporting( E_ALL ^ E_NOTICE ); 
	include './definitions.php';
	
	$jobid = array_key_exists('id', $_GET) ? $_GET['id'] : false;
	$overlay = array_key_exists('overlay', $_GET) ? $_GET['overlay'] : false;
	if( !$jobid && !$overlay ) {
		echo '</head>';
		exit('no job to present');
	}
	$competitionname = $_GET['competitionname'];
	$jobname = $_GET['name'];
	$refresh = $_GET['refresh'];

	$benchmarks = [];
	$participants = [];
	if( $jobid ) {
		$csv = jobid2csv($jobid);
		cachezip(jobid2remote($jobid),$csv,$refresh);
		parse_results($csv,$benchmarks,$participants);
	}
	foreach( $participants as &$participant ) {
		$participant['ranked'] = true;
	}
	if( $overlay ) {
		$overcsv = jobid2csv($overlay);
		cachezip(jobid2remote($overlay),$overcsv,$refresh);
		parse_results($overcsv,$benchmarks,$participants);
	}

	echo ' <title>' . $competitionname . ': ' . $jobname . '</title>'.PHP_EOL.
	     '</head>'.PHP_EOL.
	     '<body>'.PHP_EOL.
	     '<h1><a href=".">' . $competitionname . '</a>: ' . $jobname .PHP_EOL.
	     ' <a class=starexecid href="' . jobid2url($jobid) . '">'. $jobid . '</a>'.PHP_EOL.
	     ' <a class=csv href="'. $csv . '">Job info CSV</a>'.PHP_EOL;
?>
 <span class="headerFollower">Showing
  <select id="resultsFilter" type="text" placeholder="Filter..." oninput="filteredTable.refresh()">
   <option value="">all</option>
   <option value="i">interesting</option>
   <option value="c">conflicting</option>
   <option value="u">unsolved</option>
   <option value="s">solo</option>
  </select> results.
 </span>
</h1>
<table id="theTable">
<script>
var filteredTable = FilteredTable(document.getElementById("theTable"));
</script>
 <tr class="head">
  <th>benchmark
   <input id="filter0" type="text" placeholder="Filter..." onkeyup="filteredTable.refresh()">
   <script>filteredTable.register(0,"filter0");</script>
  <th style="display:none">
   <script>filteredTable.register(1,"resultsFilter");</script>
<?php
	$i = 2;
	foreach( $participants as $configid => &$participant ) {
		echo '  <th><a href="'. solverid2url($participant['solver id']) . '">'.$participant['solver'].'</a>'.PHP_EOL.
		     '   <a class=config href="'. configid2url($configid) .'">'. $participant['configuration'].'</a>'.PHP_EOL.
		     '   <select id="filter'.$i.'" oninput="filteredTable.refresh()">'.PHP_EOL.
		     '    <option value="">--</option>'.PHP_EOL.
		     '    <option value="YES">YES</option>'.PHP_EOL.
		     '    <option value="NO">NO</option>'.PHP_EOL.
		     '    <option value="MAYBE">MAYBE</option>'.PHP_EOL.
		     '    <option value="timeout">timeout</option>'.PHP_EOL.
		     '   </select>'.PHP_EOL.
		     '   <script>filteredTable.register('.$i.',"filter'.$i.'");</script>'.PHP_EOL;
		$i++;
	}
	$bench = [];

	$conflicts = 0;
	foreach( $benchmarks as $benchmark_id => $benchmark ) {
		$bench = [];
		$resultcounter = []; /* collects results for each benchmark */
		$show = false;
		foreach( $benchmark['participants'] as $configid => $record ) {
			$participant =& $participants[$configid];
			$status = $record['status'];
			$show = $show || !status2pending($status);
			if( status2finished($status) ) {
				$cpu = parse_time($record['cpu time']);
				$time = parse_time($record['wallclock time']);
				$participant['done'] += 1;
				$participant['cpu'] += $cpu;
				$participant['time'] += $time;
				$result = status2timeout($status) ? "TIMEOUT" : $record['result'];
				$score = result2score($result);
				$cert = $record['certification result'];
				$certtime = $record['certification time'];
				$participant[$result] += 1;
				if( $score > 0 ) {
					$participant['score'] += $score;
				} else {
					$participant['unscored'] += 1;
				}
				$participant['certtime'] += $certtime;
				$resultcounter[$result] += 1;
			} else {
				$participant['togo'] += 1;
				$participant['scorestogo'] += 1;
				$resultcounter['togo'] += 1;
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
			];
		}
		if( $show ) {
			$d = results2description($resultcounter);
			if( $d['conflicting'] ) {
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
				if( status2complete($status) ) {
					echo '  <td ' . result2style($result) . '>'.PHP_EOL.
					     '   <a href="'. $outurl .'">' . result2str($result) . '</a>'.PHP_EOL.
					     '   <a href="'. $url .'">'.PHP_EOL.
					     '    <span class=time>' . $my['cpu'] . '/' . $my['time'] . '</span>'.PHP_EOL;
					if( $cert && $cert != '-' ) {
						echo ' (' . $cert . '&nbsp;<span class=time>'. $certtime . '</span>)'.PHP_EOL;
					}
					echo '   </a>'.PHP_EOL;
				} else {
					echo '  <td ' . status2style($status) . '>'.PHP_EOL.
					     '   <a href="'. $url . '">' . $status . '</a>'.PHP_EOL.
					     (status2complete($status) ? '   <a href="'. $outurl .'">[out]</a>'.PHP_EOL : '' );
				}
			}
		}
	}
	echo ' <tr><th>'.PHP_EOL;
	$sum = [
		'done' => 0,
		'togo' => 0,
		'cpu' => 0,
		'time' => 0,
	];
	foreach( $participants as &$s ) {
		$s['cpu'] = (int)$s['cpu'];// eliminate round errors
		$s['time'] = (int)$s['time'];// eliminate round errors
		echo '  <th>'.$s['score'];
		if( array_key_exists('ranked',$s) ) {
			$sum['done'] += $s['done'];
			$sum['togo'] += $s['togo'];
			$sum['scorestogo'] += $s['scorestogo'];
			$sum['cpu'] += $s['cpu'];
			$sum['time'] += $s['time'];
		}
	}
	file_put_contents( jobid2sumfile($jobid), json_encode($sum) );
	file_put_contents( jobid2scorefile($jobid), json_encode($participants) );
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