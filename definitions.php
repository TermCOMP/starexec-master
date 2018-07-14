<link rel="stylesheet" type="text/css" href="master.css">
<?php
	function jobid2csv($jobid) {
		return "fromStarExec/Job" . $jobid . "_info.csv";
	}
	function jobid2scorefile($jobid) {
		return "caches/Job" . $jobid . "_score.csv";
	}
	function parse_benchmark( $string ) {
		preg_match( '|[^/]*/[^/]*/(.*)$|', $string, $matches );
		return $matches[1];
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
