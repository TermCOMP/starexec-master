<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
 <meta http-equiv="Cache-Control" content="no-cache, no-store">
 <link rel="stylesheet" href="master.css">

<?php
	error_reporting( E_ALL ^ E_NOTICE ); 
	include './definitions.php';
	
	if( !array_key_exists('id', $_GET) ) {
		echo '</head>';
		exit('no job to present');
	}
	$id = $_GET['id'];
	$jobids = explode( '_', $id );
	$jobidc = count($jobids);
	$competitionname = $_GET['competitionname'];
	$jobname = $_GET['name'];
	$refresh = $_GET['refresh'];
	$tpdbver = $_GET['tpdbver'];

	$benchmarks = [];
	$participants = [];
	$sum = [];
	for( $i = 0; $i < $jobidc; $i++ ) {
		$csv = jobid2csv($jobids[$i]);
		cachezip(jobid2remote($jobids[$i]),$csv,$refresh);
		parse_results($csv,$benchmarks,$participants,$i);
		$sum[$i] = [
			'done' => 0,
			'togo' => 0,
			'cpu' => 0,
			'time' => 0,
		];
	}
	echo ' <title>'. $competitionname .': '. $jobname .'</title>'.PHP_EOL.
	     '</head>'.PHP_EOL.
	     '<body>'.PHP_EOL.
	     '<h1><a href=".">'. $competitionname .'</a>: '. $jobname .PHP_EOL;
	for( $i = 0; $i < $jobidc; $i++ ) {
		echo ' <a class=starexecid href="'. jobid2url($jobids[$i]) .'">'. $jobids[$i] .'</a>'.PHP_EOL.
		     ' <a class=csv href="'. jobid2csv($jobids[$i]) .'">Job info CSV</a>'.PHP_EOL;
	}
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
	foreach( $participants as $configid => &$p ) {
		echo '  <th><a href="'. solverid2url($p['solver id']) . '">'.$p['solver'].'</a>'.PHP_EOL.
		     '   <a class=config href="'. configid2url($configid) .'">'. $p['configuration'].'</a>'.PHP_EOL.
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
			$p =& $participants[$configid];
			$status = $record['status'];
			$show = $show || !status2pending($status);
			if( status2finished($status) ) {
				$cpu = parse_time($record['cpu time']);
				$time = parse_time($record['wallclock time']);
				$p['done'] += 1;
				$p['cpu'] += $cpu;
				$p['time'] += $time;
				$result = status2timeout($status) ? "TIMEOUT" : parse_result($record['result']);
				$cert = $record['certification-result'];
				if( $cert == '-' ) {
					$cert = false;
				}
				$certtime = $record['certification-time'];
				if( !is_numeric($certtime) ) {
					$certtime = 0;
				}
				$p['certtime'] += $certtime;
				$score = result2score($result,$cert);
				$p[$cert ? $result.';'.$cert : $result] += 1;
				if( $score > 0 ) {
					$p['score'] += $score;
				} else {
					$p['unscored'] += 1;
				}
				$resultcounter[$result] += 1;
			} else {
				$p['togo'] += 1;
				$p['scorestogo'] += 1;
				$resultcounter['togo'] += 1;
			}
			$bench[$configid] = [
				'status' => $status,
				'cert' => $cert,
				'time' => $time,
				'cpu' => $cpu,
				'certtime' => $certtime,
				'pair' => $record['pair id'],
				'result' => $result,
				'score' => $score,
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
			$bm_name = $benchmark['benchmark'];
			$bm_url = $tpdbver ? bm2url($bm_name,$tpdbver) : bmid2url($benchmark_id);
			echo '  <td class=benchmark>'.PHP_EOL.
			     '   <a href="'.$bm_url.'">'.format_bm($bm_name).'</a>'.PHP_EOL.
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
					echo '  <td class="' . result2class($result,$cert) . '">'.PHP_EOL.
					     '   <a href="'. $outurl .'">' . result2str($result) . '</a>'.PHP_EOL.
					     '   <a href="'. $url .'">'.PHP_EOL.
					     '    <span class="time">' . $my['cpu'] . '/' . $my['time'] . '</span>'.PHP_EOL;
					if( $cert ) {
						echo '    '.cert2str($cert).'<span class="time">'. $certtime . '</span>'.PHP_EOL;
					}
					echo '   </a>'.PHP_EOL;
				} else {
					echo '  <td class="' . status2class($status) . '">'.PHP_EOL.
					     '   <a href="'. $url . '">' . $status . '</a>'.PHP_EOL.
					     (status2complete($status) ? '   <a href="'. $outurl .'">[out]</a>'.PHP_EOL : '' );
				}
			}
		}
	}
	echo ' <tr><th>'.PHP_EOL;
	foreach( $participants as &$p ) {
		$p['cpu'] = (int)$p['cpu'];// eliminate round errors
		$p['time'] = (int)$p['time'];// eliminate round errors
		echo '  <th>'.$p['score'];
		$summer = &$sum[$p['layer']];
		$summer['done'] += $p['done'];
		$summer['togo'] += $p['togo'];
		$summer['scorestogo'] += $p['scorestogo'];
		$summer['cpu'] += $p['cpu'];
		$summer['time'] += $p['time'];
	}
	file_put_contents( id2sumfile($id), json_encode( ['layers' => $sum, 'participants' => $participants] ) );
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