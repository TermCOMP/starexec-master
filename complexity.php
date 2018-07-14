<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>
<?php
	$csv = "Job30091_info.csv";
?>

<table>
<?php
	function parse_lower( $string ) {
		if( preg_match( '/Omega\\(n\\^([0-9]+)\\)/', $string, $matches ) ) {
			return $matches[1];
		}
		if( $string == 'NON_POLY' ) {
			return 1000;
		}
		return 0;
	}

	function parse_upper( $string ) {
		if( preg_match( '/O\\(n\\^([0-9]+)\\)/', $string, $matches ) ) {
			return $matches[1];
		}
		if( $string == 'POLY' ) {
			return 999;
		}
		return 1001;
	}

	function bound_to_string( $bound ) {
		if( $bound < 999 ) {
			return $bound;
		}
		if( $bound == 999 ) {
			return 'Poly';
		}
		if( $bound == 1000 ) {
			return 'NonPoly';
		}
		return 'Inf';
	}
	function parse_bounds( $string ) {
		if( preg_match( '/WORST_CASE\\(\\s*(.+)\\s*,\\s*(.+)\\s*\\)/', $string, $matches ) ) {
			return [ parse_lower($matches[1]), parse_upper($matches[2]) ];
		}
		return [0,1001];
	}

	function parse_benchmark( $string ) {
		preg_match( '|[^/]*/[^/]*/(.*)$|', $string, $matches );
		return $matches[1];
	}

	function parse_time( $string ) {
		preg_match( '/([0-9]+\\.[0-9]?[0-9]?).*/', $string, $matches );
		return $matches[1];
	}

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
	$solver = $records[1][3];
	$firstsolver = $solver;
	$i = 1;
	do {
		$solvers[$solver] = [ "score" => 0 ];
		$lastsolver = $solver;
		$i++;
		$solver = $records[$i][3];
	} while( $solver != $firstsolver );

	echo " <tr>\n";
	echo "  <th>benchmark</th>\n";
	foreach( array_keys($solvers) as $solver ) {
		echo "  <th colspan=5>$solver</th>\n";
	}
	echo " <tr><th>\n";
	foreach( array_keys($solvers) as $solver ) {
		echo "  <th>score<th>upper<th>lower<th>cpu<th>time\n";
	}
	$bench = [];

	foreach( $records as $record ) {
		$solver = $record[3];
		if( $solver == $firstsolver ) {
			$bench = [];
			$benchmark = parse_benchmark( $record[1] );
			echo " <tr>\n";
			echo "  <td>" . $benchmark . "</td>\n";
		}
		$result = $record[11];
		$bounds = parse_bounds( $result );
		$bench[$solver] = [
			"result" => $result,
			"lower" => $bounds[0],
			"upper" => $bounds[1],
			"time" => parse_time($record[9]);
			"cpu" => parse_time($record[8]),
		];
		if( $solver == $lastsolver ) {
			foreach( $bench as $p ) {
//				echo "  <td>" . $p["result"] . "</td>\n";
				$score = 0;
				foreach( $bench as $q ) {
					if( $p["upper"] < $q["upper"] ) {
						$score++;
					}
					if( $p["lower"] > $q["lower"] ) {
						$score++;
					}
				}
				$solvers[$solver]["score"] += $score;
				echo "  <td>" . $score . "</td>\n";
				echo "  <td>" . bound_to_string($p["lower"]) . "</td>\n";
				echo "  <td>" . bound_to_string($p["upper"]) . "</td>\n";
				echo "  <td>" . $p["cpu"] . "</td>\n";
				echo "  <td>" . $p["time"] . "</td>\n";
			}
			echo " </tr>\n";
		}
	}
	echo " <tr>\n";
	foreach( $solvers as $solver ) {
		echo "  <th colspan=5>" . $solver["score"] . "</th>\n";
	}
?>
</table>
</body>
</html>


