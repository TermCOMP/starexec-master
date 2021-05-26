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
			return 'class=MAYBE';
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
			return 'class=MAYBE';
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
	foreach( $jobids as $jobid ) {
		echo ' <a class=starexecid href="'. jobid2url($jobid) .'">'. $jobid .'</a>'.PHP_EOL.
		     ' <a class=csv href="'. jobid2csv($jobid) .'">Job info CSV</a>'.PHP_EOL;
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
<?php

	echo ' <tr class="head">'.PHP_EOL.
	     '<th>'.PHP_EOL;
	foreach( $participants as $configid => &$p ) {
		echo '  <th colspan=3><a href="'. solverid2url($p['solver id']) . '">'.$p['solver'].'</a>'.PHP_EOL.
		     '   <a class=config href="'. configid2url($configid) .'">'. $p['configuration'].'</a>'.PHP_EOL;
	}
?>
 <tr class="head">
  <th>benchmark
   <input id="filter0" type="text" placeholder="Filter..." onkeyup="filteredTable.refresh()">
   <script>filteredTable.register(0,"filter0");</script>
  <th style="display:none">
   <script>filteredTable.register(1,"resultsFilter");</script>
<?php
	foreach( $participants as &$p ) {
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
			$p =& $participants[$configid];
			$status = $record['status'];
			$show = $show || !status2pending($status);
			if( status2finished($status) ) {
				$cpu = parse_time($record['cpu time']);
				$time = parse_time($record['wallclock time']);
				$p['done'] += 1;
				$p['cpu'] += $cpu;
				$p['time'] += $time;
				if( status2timeout($status) ) {
					$resultcounter['TIMEOUT'] += 1;
					$lower = 0;
					$upper = 1000;
				} else {
					$result = $record['result'];
					$bounds = str2bounds( $result );
					$lower = $bounds[0];
					$upper = $bounds[1];
				}
				$cert = $record['certification-result'];
				if( $cert == '-' ) {
					$cert = false;
				}
				$certtime = $record['certification-time'];
				if( !is_numeric($certtime) ) {
					$certtime = 0;
				}
				$p['certtime'] += $certtime;
				$resultcounter['LOW'][] = $lower;
				$resultcounter['UP'][] = $upper;
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
				'upper' => $upper,
				'lower' => $lower,
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
					$upper = $my['upper'];
					$lower = $my['lower'];
					$upscore = $upper >= 1000 ? 0 :
						count(array_filter($resultcounter['UP'],
							function($your){ global $upper; return $your >= $upper; }
					));
					$lowscore = $lower <= 0 ? 0 :
						count(array_filter($resultcounter['LOW'],
							function($your){ global $lower; return $your <= $lower; }
					));
					$a = '<a href="'. $outurl .'" class=fill>';
					$participants[$me]['UP'] += $upscore;
					$participants[$me]['LOW'] += $lowscore;
					$participants[$me]['score'] += $upscore + $lowscore;
					$participants[$me]['unscored'] += $maxscore - $upscore - $lowscore;
					echo '  <td '. upper2style($upper) .'>'. $a . bound2str($upper) . ' <span class=score>+'. $upscore .'</span></a>'.PHP_EOL.
					     '  <td '. lower2style($lower) .'>'. $a . bound2str($lower) . ' <span class=score>+'. $lowscore .'</span></a>'.PHP_EOL.
					     '  <td class=time>'. $a . $my['cpu'] .'/'. $my['time'] . '</a>'.PHP_EOL;
				} else {
					echo '  <td colspan=3 ' . status2style($status) . '>'.PHP_EOL.
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