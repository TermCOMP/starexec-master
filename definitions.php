<?php

set_time_limit(300);

	function seconds2str($s) {
		$d = floor($s/(24*60*60));
		$s = $s%(24*60*60);
		$h = floor($s/(60*60));
		$s = $s%(60*60);
		$m = floor($s/60);
		$s = $s%60;
		return ($d>0? $d .'d ' : '').sprintf("%'02d:%'02d:%'02d",$h,$m,$s);
	}

	function type2php($type) {
		if( $type == 'termination' ) {
			return 'termination.php';
		} else if( $type == 'complexity' ) {
			return 'complexity.php';
		} else {
			return NULL;
		}
	}

	function str2str($str) {// escape single quotes
		return "'" . str_replace( ['\\', '\''], ['\\\\','\\\''], $str ) . "'";
	}

	function cachezip($remote,$local,$refresh) {
		if( file_exists($local) && ( !$refresh || filemtime($local) + 5 > time() ) ) {
			return;
		}
		$tmpzip=tempnam("./fromStarExec","");
		if( !copy($remote,$tmpzip) ) {
			print_r(error_get_last()["message"]);
			return;
		}
		exec( "unzip -o $tmpzip -d fromStarExec", $out, $ret );
		if( $ret ) {
			exit("failed to unzip job info; exit code: $ret\n".$out);
		}
		unlink($tmpzip);
		exec( "./fix-starexec-csv.sh '$local'" );
		chmod( $local, 0766 );
	}
	function jobid2csv($jobid) {
		return "fromStarExec/Job$jobid/Job" . $jobid . "_info.csv";
	}
	function row2record($header,$row) {
		if( is_null($row[0]) ) {
			return null;
		}
		$record = [];
		foreach( $header as $i => $field ) {
			$record[$field] = $row[$i];
		}
		return $record;
	}
	function parse_results($csv, &$benchmarks, &$participants, $layer) {
		$file = new SplFileObject($csv);
		$file->setFlags( SplFileObject::READ_CSV );
		$header = $file->current();
		$file->next();
		$proc = function($record) {
			global $benchmarks;
			if( $record != null ) {
				$here = &$benchmarks[$record['benchmark id']];
				$here['benchmark'] = $record['benchmark'];
				$here['participants'][$record['configuration id']] = $record;
			}
		};
		// first tool
		$record = row2record($header,$file->current());
		$file->next();
		$proc($record);
		$configid = $record['configuration id'];
		$first = $configid;
		// first loop
		for(;;) {
			$participants[$configid] = [
				'layer' => $layer,
				'solver' => $record['solver'],
				'solver id' => $record['solver id'],
				'configuration' => $record['configuration'],
				'score' => 0.0,
				'unscored' => 0,
				'scorestogo' => 0,
				'conflicts' => 0,
				'done' => 0,
				'togo' => 0,
				'cpu' => 0,
				'time' => 0,
				'certtime' => 0,
				'TIMEOUT' => 0,
			];
			$record = row2record($header,$file->current());
			$file->next();
			$proc($record);
			$configid = $record['configuration id'];
			if( $configid == $first ) {
				break;
			}
		}
		// remaining
		for(; !$file->eof(); $file->next() ) {
			$proc(row2record($header,$file->current()));
		}
	}
	function jobid2remote($jobid) {
		return "https://www.starexec.org/starexec/secure/download?type=job&id=$jobid&returnids=true&getcompleted=false";
	}
	function id2sumfile($id) {
		return "Job" . $id . ".json";
	}
	function pairid2url($pairid) {
		return "https://www.starexec.org/starexec/secure/details/pair.jsp?id=$pairid";
	}
	function pairid2outurl($pairid) {
		return 'https://www.starexec.org/starexec/services/jobs/pairs/'. $pairid .'/stdout/1?limit=-1';
	}
// For complexity
	function bound2str( $bound ) {
		switch( $bound ) {
			case 0: return '1';
			case 1: return 'n';
			case 999: return 'n<sup>?</sup>';
			case 1000: return 'NonPoly';
			case 1001: return '&omega;';
			default: return 'n<sup>'.$bound.'</sup>';
		}
	}
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
	function parse_result($str) {
		switch($str) {
			case 'YES': case 'NO': case 'MAYBE':
				return $str;
			default:
				if( preg_match( '/WORST_CASE\\(\\s*(.+)\\s*,\\s*(.+)\\s*\\)/', $str, $matches ) ) {
					$low = str2lower($matches[1]);
					$up = str2upper($matches[2]);
					if( $low == 0 && $up == 1001 ) {// no information
						return 'MAYBE';
					}
					if( $low <= $up ) {// valid answer
						return [ 'low' => $low, 'up' => $up ];
					}
				}
				return $str;
		}
	}
	function result2score($result,$cert) {
		if( $cert == 'REJECTED' || $cert == 'UNSUPPORTED' ) {
			return 0;
		}
		if( $result == 'YES' || $result == 'NO' ) {
			return 1;
		}
		if( is_array($result) && array_key_exists('up',$result) ) {
			$up = $result['up'];
			$low = $result['low'];
			if( $low == 1000 ) {
				return 2.0;
			}
			return (1.0 - .5^$low) + ($up >= 999 ? 0.0 : .5^($up-$low));
		}
		return 0.0;
	}
	function result2str($result) {
		switch($result) {
			case 'YES': case 'NO':
			case 'MAYBE': case 'TIMEOUT': return $result;
			default:
				if( is_array($result) && array_key_exists('up',$result) ) {
					$low = $result['low'];
					$up = $result['up'];
					if( $low == 1000 ) {
						return 'NON-POLY';
					}
					if( $low == $up ) {
						return '&Theta;('.bound2str($low).')';
					}
					return ($low > 0 ? '&Omega;('.bound2str($low).')' : '').'―'.($up < 999 ? 'O('.bound2str($up).')' : '');
				}
				return 'ERROR';
		}
	}
	function cert2str($cert) {
		switch($cert) {
			case 'CERTIFIED':	return '✔';
			default: return $cert;
		}
	}
	function result2class($result,$cert) {
		switch($result) {
			case 'YES': case 'NO':
				return ($cert ? $cert.' ' : '').$result;
			case 'MAYBE': return $result;
			case 'TIMEOUT': return 'timeout';
			default:
				if( is_array($result) && array_key_exists('up',$result) ) {
					$low = $result['low'];
					$up = $result['up'];
					return ($cert ? $cert.' ' : '').(
						$low == 1000 ? 'lowNP' : (// some version of PHP demands parentheses here 
							$up >= 999 ? 'low'.($low < 3 ? $low : '3') :
							'up'.($up - $low < 3 ? $up - $low : '3')
						)
					);
				}
				return 'error';
		}
	}
	function status2class($status) {
		if( $status == 'complete' ) {
			return 'complete';
		} else if( $status == 'incomplete' || $status == 'paused' || $status == 'pending submission' ) {
			return 'incomplete';
		} else if( substr($status,0,7) == 'timeout' || $status == 'memout' ) {
			return 'timeout';
		} else if( $status == 'run script error' ) {
			return 'starexecbug';
		} else if( $status == 'enqueued' ) {
			return 'active';
		} else {
			return 'error';
		}
	}
	function status2str($status) {
		if( $status == 'run script error' ) {
			return 'StarExec error';
		} else {
			return $status;
		}
	}
	function status2finished($status) {
		return substr($status,0,7) <> 'pending' && $status <> 'enqueued';
	}
	function status2timeout($status) {
		return substr($status,0,7) == 'timeout';
	}
	function status2complete($status) {
		return status2finished($status) && ! status2timeout($status);
	}
	function status2pending($status) {
		return $status == 'pending submission';
	}
	function format_bm( $string ) {
		preg_match( '|[^/]*/(.*)$|', $string, $matches );
		$ret = $matches[1];
		$ret = str_replace( '/', '/<wbr>',$ret );
		$ret = str_replace( '_', '_<wbr>',$ret );
		return $ret;
	}
	function parse_time( $string ) {
		preg_match( '/([0-9]+\\.[0-9]?[0-9]?).*/', $string, $matches );
		return $matches[1];
	}
	function jobid2url($jobid) {
		return "https://www.starexec.org/starexec/secure/details/job.jsp?id=$jobid";
	}
	function bm2url($bm,$tpdbver) {
		return "https://termcomp.github.io/tpdb.html?ver=".$tpdbver."&path=".urlencode($bm);
	}
	function bmid2url($bmid) {
		return 'https://www.starexec.org/starexec/services/benchmarks/'. $bmid .'/contents?limit=-1';
	}
	function bmid2remote($bmid) {
		return "https://www.starexec.org/starexec/secure/details/benchmark.jsp?id=$bmid";
	}
	function solverid2url($solverid) {
		return "https://www.starexec.org/starexec/secure/details/solver.jsp?id=$solverid";
	}
	function configid2url($configid) {
		return "https://www.starexec.org/starexec/secure/details/configuration.jsp?id=$configid";
	}
	function results2description($results) {
		$YES = array_key_exists('YES', $results) ? $results['YES'] : 0;
		$NO = array_key_exists('NO', $results) ? $results['NO'] : 0;
		if( array_key_exists('UP', $results) ) {
			$UP = $results['UP'];
			$nUP = count(array_filter($UP,function($up){return $up < 1000;}));
			$vUP = count(array_unique($UP));
		} else {
			$UP = [1000];
			$nUP = 0;
			$vUP = 1;
		}
		if( array_key_exists('LOW', $results) ) {
			$LOW = $results['LOW'];
			$nLOW = count(array_filter($LOW,function($low){return $low > 0;}));
			$vLOW = count(array_unique($LOW));
		} else {
			$LOW = [0];
			$nLOW = 0;
			$vLOW = 1;
		}
		$MAYBE = array_key_exists('MAYBE', $results) ? $results['MAYBE'] : 0;
		$TIMEOUT = array_key_exists('TIMEOUT', $results) ? $results['TIMEOUT'] : 0;
		$FAILED = $MAYBE + $TIMEOUT;
		$togo = array_key_exists('togo', $results) && $results['togo'] > 0;
		$conflicting = ($YES > 0 && $NO > 0) || min($UP) < max($LOW);
		$interesting = ($YES + $NO > 0 && $FAILED > 0) || $vUP > 1 || $vLOW > 1;
		$solo = ($YES == 1 || $NO == 1 || $nUP == 1 || $nLOW == 1) && $togo == 0;
		$unsolved = $YES == 0 && $NO == 0 && $nUP == 0 && $nLOW == 0;
		return [
			'conflicting' => $conflicting,
			'interesting' => $interesting,
			'solo' => $solo,
			'unsolved' => $unsolved,
			'key' => ($conflicting ? 'c':'').($interesting ? 'i' : '').($solo ? 's' : '').($unsolved ? 'u' : ''),
		];
	}
	// Making certified and demonstration categories
	function make_categories($raw_mcats,$closed) {
		$demos = [];
		$mcats = [];
		foreach( $raw_mcats as $mcat_name => $raw_cats ) {
			$cats = [];
			foreach( $raw_cats as $cat_name => $cat ) {
				if( $cat['id'] ) {
					$certinfo = $cat['certified'];
					if( $certinfo['id'] ) {
						$cat['id'] .= '_'.$certinfo['id'];
					}
				}
				$cats[$cat_name] = $cat;
				if( $closed ) {
					$cnt = array_key_exists('participants',$cat) ? count($cat['participants']) : 0;
					if( $cnt == 0 && !$cat['id'] > 0 ) {
						unset($cats[$cat_name]);// remove unparticipated category
					} else if( $cnt == 1 ) {
						$demos[$cat_name] = $cat;
						unset($cats[$cat_name]);
					}
				}
			}
			$mcats[$mcat_name] = $cats;
		}
		if( $demos != [] ) {
			$mcats['Demonstrations'] = $demos;
		}
		return $mcats;
	}
?>
<script src="definitions.js"></script>
