<link rel="stylesheet" type="text/css" href="master.css">
<?php
	function cachezip($remote,$local) {
		if( file_exists($local) ) {
			return;
		}
		$tmpzip=tempnam(".","");
		copy($remote,$tmpzip);
		exec("cd fromStarExec; unzip $tmpzip; cd ..");
	}
	function jobid2csv($jobid) {
		return "fromStarExec/Job$jobid/Job" . $jobid . "_info.csv";
	}
	function jobid2remote($jobid) {
		return "https://www.starexec.org/starexec/secure/download?type=job&id=$jobid&returnids=true&getcompleted=false";
	}
	function jobid2scorefile($jobid) {
		return "caches/Job" . $jobid . "_score.csv";
	}
	function pairid2remote($pairid) {
		return "https://www.starexec.org/starexec/secure/details/pair.jsp?id=$pairid";
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
	function parse_benchmark( $string ) {
		preg_match( '|[^/]*/[^/]*/(.*)$|', $string, $matches );
		$ret = $matches[1];
		$ret = str_replace( '/', '/<wbr>',$ret );
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
?>
