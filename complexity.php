<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	include './definitions.php';
	$jobid = $_GET["id"];
	$csv = jobid2csv($jobid);
	$scorefile = jobid2scorefile($jobid);
?>
</head>
<body>

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
		if( $bound == 0 ) {
			return "1";
		}
		if( $bound < 999 ) {
			return "n<sup>$bound</sup>";
		}
		if( $bound == 999 ) {
			return 'n<sup>?</sup>';
		}
		if( $bound == 1000 ) {
			return 'NonPoly';
		}
		return '&infin;';
	}
	function lower2style( $bound ) {
		if( $bound == 0 ) {
			return "class=maybe";
		} else if( $bound == 1 ) {
			return "class=low1";
		} else if( $bound == 2 ) {
			return "class=low2";
		} else if( $bound < 999 ) {
			return "class=low3";
		} else if( $bound == 1000 ) {
			return "class=lowNP";
		} else {
			return "class=error";
		}	
	}
	function upper2style( $bound ) {
		if( $bound == 0 ) {
			return "class=up0";
		} else if( $bound == 1 ) {
			return "class=up1";
		} else if( $bound == 2 ) {
			return "class=up2";
		} else if( $bound < 999 ) {
			return "class=up3";
		} else if( $bound == 999 ) {
			return "class=upP";
		} else if( $bound == 1000 ) {
			return "class=yes";
		} else {
			return "class=maybe";
		}
	}
	function parse_bounds( $string ) {
		if( preg_match( '/WORST_CASE\\(\\s*(.+)\\s*,\\s*(.+)\\s*\\)/', $string, $matches ) ) {
			return [ parse_lower($matches[1]), parse_upper($matches[2]) ];
		}
		return [0,1001];
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
		echo "  <th colspan=4>$solver</th>\n";
	}
	echo " <tr><th>\n";
	foreach( array_keys($solvers) as $solver ) {
		echo "  <th>score<th>lower<th>upper<th>time\n";
	}
	$bench = [];

	foreach( $records as $record ) {
		$solver = $record[3];
		$solverid = $record[4];
		if( $solver == $firstsolver ) {
			$bench = [];
			$benchmark = parse_benchmark( $record[1] );
			$url = bmid2url( $record[2] );
			echo " <tr>\n";
			echo "  <td class=benchmark><a href='$url'>$benchmark</a></td>\n";
		}
		$result = $record[11];
		$bounds = parse_bounds( $result );
		$bench[$solver] = [
			"result" => $result,
			"lower" => $bounds[0],
			"upper" => $bounds[1],
			"time" => parse_time($record[9]),
			"cpu" => parse_time($record[8]),
		];
		if( $solver == $lastsolver ) {
			foreach( array_keys($bench) as $myname ) {
				$p = $bench[$myname];
				$score = 0;
				foreach( $bench as $q ) {
					if( $p["upper"] < $q["upper"] ) {
						$score++;
					}
					if( $p["lower"] > $q["lower"] ) {
						$score++;
					}
				}
				$solvers[$myname]["score"] += $score;
				echo "  <td>" . $score . "</td>\n";
				echo "  <td " . lower2style($p["lower"]) . ">" . bound_to_string($p["lower"]) . "</td>\n";
				echo "  <td " . upper2style($p["upper"]) . ">" . bound_to_string($p["upper"]) . "</td>\n";
				echo "  <td class=time>" . $p["cpu"] . "/" . $p["time"] . "</td>\n";
			}
			echo " </tr>\n";
		}
	}
	echo " <tr>\n";
	$scorefileD = fopen($scorefile,"w");
	foreach( array_keys($solvers) as $solver ) {
		$score = $solvers[$solver]["score"];
		echo "  <th><th colspan=4>$score</th>\n";
		fwrite( $scorefileD, "$solver,$solverid,$score\n" );
	}
	fclose( $scorefileD );
?>
</table>
</body>
</html>


