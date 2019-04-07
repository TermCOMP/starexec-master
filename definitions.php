<link rel="stylesheet" type="text/css" href="master.css">
<?php

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

	function cachezip($remote,$local) {
		if( file_exists($local) && filemtime($local) + 5 > time() ) {
			return;
		}
		$tmpzip=tempnam("./fromStarExec","");
		if( !copy($remote,$tmpzip) ) {
			exit("failed to copy $remote to $tmpzip");
		}
		exec( "unzip -o $tmpzip -d fromStarExec", $out, $ret );
		if( $ret ) {
			exit("failed to unzip job info; exit code: $ret\n".explode($out));
		}
		exec( "./fix-starexec-csv.sh -i '$local'" );
		chmod( $local, 0766 );
	}
	function jobid2csv($jobid) {
		return "fromStarExec/Job$jobid/Job" . $jobid . "_info.csv";
	}
	function jobid2remote($jobid) {
		return "https://www.starexec.org/starexec/secure/download?type=job&id=$jobid&returnids=true&getcompleted=false";
	}
	function jobid2scorefile($jobid) {
		return "caches/Job" . $jobid . "_score.json";
	}
	function pairid2url($pairid) {
		return "https://www.starexec.org/starexec/secure/details/pair.jsp?id=$pairid";
	}
	function pairid2outurl($pairid) {
		return "https://www.starexec.org/starexec/services/jobs/pairs/$pairid/stdout/1?limit=-1";
	}
	function result2style($result) {
		if( $result == -1 ) {
			return "class=no";
		} else if( $result == 0 ) {
			return "class=maybe";
		} else if ( $result == 1 ) {
			return "class=yes";
		} else {
			return "class=error";
		}
	}
	function status2style($status) {
		if( $status == 'complete' ) {
			return 'class=complete';
		} else if( $status == 'incomplete' || $status == 'paused' || $status == 'pending submission' ) {
			return 'class=incomplete';
		} else if( substr($status,0,7) == 'timeout' || $status == 'memout' ) {
			return 'class=timeout';
		} else if( $status == 'run script error' ) {
			return 'class=starexecbug';
		} else if( $status == 'enqueued' ) {
			return 'class=active';
		} else {
			return 'class=error';
		}
	}
	function status2str($status) {
		if( $status == 'run script error' ) {
			return 'StarExec error';
		} else {
			return $status;
		}
	}
	function status2complete($status) {
		if( substr($status,0,7) == 'pending' ) {
			return false;
		} else if( $status == 'enqueued' ) {
			return false;
		} else {
			return true;
		}
	}
	function parse_benchmark( $string ) {
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
	function bmid2url($bmid) {
		return "https://www.starexec.org/starexec/secure/details/benchmark.jsp?id=$bmid";
	}
	function solverid2url($solverid) {
		return "https://www.starexec.org/starexec/secure/details/solver.jsp?id=$solverid";
	}
	function configid2url($configid) {
		return "https://www.starexec.org/starexec/secure/details/configuration.jsp?id=$configid";
	}
?>
