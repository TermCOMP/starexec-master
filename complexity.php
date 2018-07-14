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
			return 999;
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
		return 1000;
	}

	function parse_bounds( $string ) {
		if( preg_match( '/WORST_CASE\\(\\s*(.+)\\s*,\\s*(.+)\\s*\\)/', $string, $matches ) ) {
			return [ parse_lower($matches[1]), parse_upper($matches[2]) ];
		}
		return [0,1000];
	}

	function parse_benchmark( $string ) {
		preg_match( '|[^/]*/[^/]*/(.*)$|', $string, $matches );
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
			"time" => $record[8] . "/" . $record[9],
		];
		if( $solver == $lastsolver ) {
			foreach( $bench as $p ) {
				echo "  <td>" . $p["result"] . "</td>\n";
				echo "  <td>" . $p["upper"] . "</td>\n";
				echo "  <td>" . $p["lower"] . "</td>\n";
				echo "  <td>" . $p["time"] . "</td>\n";
				$score = 0;
				foreach( $bench as $q ) {
					if( $p["upper"] < $q["upper"] ) {
						$score++;
					}
					if( $p["lower"] > $q["lower"] ) {
						$score++;
					}
				}
				echo "  <td>" . $score . "</td>\n";
				$solvers[$solver]["score"] += $score;
			}
			echo " </tr>\n";
		}
	}
?>
</table>
</body>
</html>


