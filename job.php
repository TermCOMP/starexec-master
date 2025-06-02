<!DOCTYPE html>
<html lang='en'>
<head>
 <meta charset="utf-8">
 <meta http-equiv="Cache-Control" content="no-cache, no-store">

<?php
	include './definitions.php';
	error_reporting( E_ALL ^ E_NOTICE ); 
	
	if( !array_key_exists('id', $_GET) ) {
		echo '</head>';
		exit('no job to present');
	}
	$id = $_GET['id'];
	$jobids = explode( '_', $id );
	$jobidc = count($jobids);
	$refresh = $_GET['refresh'];
	$bm_db = $_GET['db'];
	$bm_prefix = array_key_exists('dir',$_GET) ? $_GET['dir'].'/' : '';
	$type = $_GET['type'];
	$penalized_pairs = array_key_exists('penalty',$_GET) ?
		json_decode(file_get_contents($_GET['penalty'])) : [];
	if( array_key_exists('competition',$_GET) ) {// This means it is generating an HTML in the competition directory.
		$competition = $_GET['competition'];
		$competitionname = $_GET['competitionname'];
		$jobname = $_GET['name'];
		$out_path = preg_replace('~[:/]~','_',$competition).'/';
		$root = '../';
		$note = array_key_exists('note',$_GET) ? $_GET['note'] : null;
	} else {// just displaying a job.
		$competition = 'Job_'.$id;
		$competitionname = 'Job '.$id;
		$jobname = $id;
		$root = '';
	}
	echo ' <script src="'.$root.'definitions.js"></script>'.PHP_EOL.
	     ' <link rel="stylesheet" href="'.$root.'master.css">'.PHP_EOL;


	$max_score = $type == 'complexity' ? 2.0 : 1;

	$results = [];
	$participants = [];
	$sum = [];
	for( $i = 0; $i < $jobidc; $i++ ) {
        $files = glob("./jobs/job_" . $jobids[$i] . "/results/*");
        foreach ($files as $file) {
            parse_results($file,$bm_prefix,$results,$participants,$i);
            $sum[$i] = new_scores();
        }
	}
	// virtual best solver
	$vbs = new_scores();
	$vbs_results = [];

	if( array_key_exists('previous-competition',$_GET) ) {
		$past_competition = $_GET['previous-competition'];
		$past_claims = (array)json_decode(
			file_get_contents(
				array_key_exists('previous-category',$_GET) ?
				$_GET['previous-category'] :
				$past_competition.'/'.jobname2vbsfile($jobname)
			)
		);
	} else {
		$past_claims = null;
	}

	echo ' <title>'. $competitionname .': '. $jobname .'</title>'.PHP_EOL.
	     '</head>'.PHP_EOL.
	     '<body>'.PHP_EOL.
	     '<h1><a href=".">'. $competitionname .'</a>: '. $jobname .PHP_EOL;
?>
 <span class="headerFollower">Showing
  <select id="filter1" type="text" placeholder="Filter..." oninput="filteredTable.refresh()">
   <option value="">all</option>
   <option value="i">interesting</option>
   <option value="c">conflicting</option>
   <option value="u">unsolved</option>
   <option value="n">new result</option>
   <option value="b">new benchmark</option>
   <option value="f">finished</option>
  </select> results.
 </span>
</h1>
<?php
	if( isset($note) ) {
		echo '<p>'.$note.'</p>';
	}
?>
<table id="theTable">
<script>
var filteredTable = FilteredTable(document.getElementById("theTable"));
</script>
 <tr class="head">
  <th>benchmark
   <input id="filter0" type="text" placeholder="Filter..." onkeyup="filteredTable.refresh()">
   <script>filteredTable.register(0,"filter0");</script>
  <th style="display:none">
   <script>filteredTable.register(1,"filter1");</script>
<?php

	function makeFilterField($i) {
		echo '   <select id="filter'.$i.'" oninput="filteredTable.refresh()">'.PHP_EOL.
		     '    <option value="">--</option>'.PHP_EOL.
		     '    <option value="YES">YES</option>'.PHP_EOL.
		     '    <option value="NO">NO</option>'.PHP_EOL.
		     '    <option value="MAYBE">MAYBE</option>'.PHP_EOL.
		     '    <option value="timeout">timeout</option>'.PHP_EOL.
		     '    <option value="memout">memout</option>'.PHP_EOL.
		     '    <option value="REJECTED">REJECTED</option>'.PHP_EOL.
		     '    <option value="ERROR">ERROR</option>'.PHP_EOL.
		     '   </select>'.PHP_EOL.
		     '   <script>filteredTable.register('.$i.',"filter'.$i.'");</script>'.PHP_EOL;
	}

	// 2nd column is for the virtual best solver
	echo '  <th>VBS'.PHP_EOL;
	makeFilterField(2);
	$i = 3;
	foreach( $participants as $configid => &$p ) {
		echo '  <th>'.$p['solver'].PHP_EOL;
		makeFilterField($i);
		$i++;
	}
	// the last column is for past results
	if( $past_claims != null ) {
		echo '  <th>~'.$past_competition.PHP_EOL;
		makeFilterField($i);
	}

	$conflicts = 0;
	foreach( $results as $bm_name => $records ) {
		$bench = [];
		init_claim_set($claims); /* collects results for each benchmark */
        $path_info = pathinfo($bm_name);
        if (str_ends_with($bm_name, '.ari')) {
            $past_bm_name = $path_info['dirname'].'/'.basename($bm_name, '.ari').'.xml';
        } else {
            $past_bm_name = $bm_name;
        }
		if( $past_claims != null && array_key_exists($past_bm_name,$past_claims) ) {
			$past_claim = (array)$past_claims[$past_bm_name];
			add_claim($claims,$past_claim);
		} else {
			$past_claim = null;
		}
		foreach( $records['participants'] as $configid => $record ) {
			$p =& $participants[$configid];
			$status = $record['status'];
			$jobid = $record['job id'];
			$benchidx = $record['benchmark idx'];
			$solveridx = $record['solver idx'];
			$pair = array($benchidx, $solveridx);
			if( status2finished($status) ) {
#				$cpu = parse_time($record['cpu time']);
				$time = $record['wallclock time'];
				$p['done'] += 1;
#				$p['cpu'] += $cpu;
				$p['time'] += $time;
				if( array_key_exists('certification-result',$record) ) {
					$cert = $record['certification-result'];
					if( $cert == '-' ) {
						$cert = false;
					}
					$certtime = $record['certification-time'];
					if( !is_numeric($certtime) ) {
						$certtime = 0;
					}
				} else {
					$cert = false;
					$certtime = 0;
				}
				$p['certtime'] += $certtime;
				$claim =
					status2error($status) ? error_claim() :
					(status2timeout($status) ? timeout_claim() :
					(status2memout($status) ? memout_claim() : str2claim($record['result'])));
				if( in_array($pair,$penalized_pairs) ) {
					$scores = [ 'score' => -10, 'wrong' => 10, 'miss' => 20 ];
				} else {
					add_claim($claims,$claim);
					$scores = claim2scores($claim,$cert,$max_score,$past_claim);
				}
				foreach( $scores as $key => $val ) {
					$p[$key] += $val;
				}
			} else {
				$p['togo'] += 1;
				$p['scorestogo'] += $max_score;
				add_claim_togo($claims);
#				$cpu = 0;
				$time = 0;
			}
			$bench[$configid] = [
				'status' => $status,
				'cert' => $cert,
				'time' => $time,
#				'cpu' => $cpu,
				'certtime' => $certtime,
				'job id' => $jobid,
				'benchmark idx' => $benchidx,
				'solver idx' => $solveridx,
				'claim' => $claim,
			];
		}
		$d = claims2description( $claims, $past_claim );
		$conflicting = $d['conflicting'];
		if( $conflicting ) {
			echo ' <tr class="conflict">'.PHP_EOL;
			$conflicts += 1;
		} else {
			echo ' <tr>'.PHP_EOL;
		}

		$bm_url = bm2url($bm_name,$bm_name,$bm_db,$bm_prefix);
		echo '  <td class=benchmark>'.PHP_EOL.
		     '   <a href="'.$bm_url.'">'.format_bm($bm_name).'</a></td>'.PHP_EOL.
		     '  <td style="display:none">'.$d['key'];
		// virtual best solver
		if( $conflicting ) {
			echo '  <td>';
		} else {
			$claim = $d['vbs'];
			$vbs_results[$bm_name] = $claim;
			echo '  <td class="'.claim2class($claim,'').'">'.claim2str($claim).PHP_EOL;
			$scores = claim2scores($claim,'',$max_score,$past_claim);
			foreach( $scores as $key => $val ) {
                if (!array_key_exists($key,$vbs)) {
                    $vbs[$key] = $val;
                } else {
                    $vbs[$key] += $val;
                }
			}
		}
		// solvers
		foreach( $bench as $me => $my ) {
			$status = $my['status'];
			$claim = $my['claim'];
			$cert = $my['cert'];
			$certtime = $my['certtime'];
			$jobid = $my['job id'];
			$benchidx = $my['benchmark idx'];
			$solveridx = $my['solver idx'];
			$outurl = mkouturl($jobid, $benchidx, $solveridx);
			$errurl = mkerrurl($jobid, $benchidx, $solveridx);
			if( status2complete($status) ) {
				echo '  <td class="' . claim2class($claim,$cert) . '">'.PHP_EOL.
				     '   <a href="'. "../". $outurl .'">' . claim2str($claim) . '</a>'.PHP_EOL.
                     ( 0 == filesize( $errurl )  ? '' : '   <a href="'. "../". $errurl .'">[err]</a>'.PHP_EOL).
				     '    <span class="time">' .
                                     # $my['cpu'] . '/' .
                                     intdiv($my['time'],1000) . '.' . ($my['time']%1000) . '</span>'.PHP_EOL;
				if( $cert ) {
					echo '    '.cert2str($cert).'<span class="time">'. $certtime . '</span>'.PHP_EOL;
				}
            } else if ( status2error($status) ) {
                echo '  <td class="' . status2class($status) . '"><a href="'. "../". $errurl .'">error</a></td>' . PHP_EOL;
			} else {
				echo '  <td class="' . status2class($status) . '">' . $status . PHP_EOL;
			}
		}
		// past result
		if( $past_claim != null ) {
			echo '  <td class="'.claim2class($past_claim,'').'">'.claim2str($past_claim).PHP_EOL;
		}
	}
	echo ' <tr><th>'.PHP_EOL;

	// last row is scores
	// the highest score
	$max_score = max(array_map(function($p){return $p['score'];},$participants));
	// vbs
	$vbs_score = $vbs['score'];
	echo '  <th>'.number_format($vbs_score,2);
	foreach( $participants as &$p ) {
#		$p['cpu'] = (int)$p['cpu'];// eliminate round errors
		$p['time'] = (int)$p['time'];// eliminate round errors
		$score = $p['score'];
        if (empty($vbs_score)) {
            $p['normalized'] = 0;
        } else {
            $p['normalized'] = $score / $vbs_score;
        }
		echo '  <th>'.number_format($score,2);
		$summer = &$sum[$p['layer']];
		$summer['done'] += $p['done'];
		$summer['togo'] += $p['togo'];
		$summer['scorestogo'] += $p['scorestogo'];
#		$summer['cpu'] += $p['cpu'];
		$summer['time'] += $p['time'];
	}
	if( isset($out_path) ) {
		file_put_contents( $out_path.jobname2sumfile($jobname), json_encode(
				[ 'layers' => $sum, 'participants' => $participants, 'conflicting' => $conflicts > 0 ],
				JSON_PRETTY_PRINT
		) );
		file_put_contents( $out_path.jobname2vbsfile($jobname), json_encode($vbs_results,JSON_PRETTY_PRINT) );
	}
?>
</table>
<script>
	for( var key in get_args ) {
		if( key.substring(0,6) == "filter" ) {
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
