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
?>
