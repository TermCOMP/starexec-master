<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	include './definitions.php';
	$jobid = $_GET["id"];
	$csv = jobid2csv($jobid);
	cachezip(jobid2remote($jobid),$csv);
	$scorefile = jobid2scorefile($jobid);
?>
</head>
<body>

<table>
<?php
	function str2lower( $string ) {
		if( preg_match( '/Omega\\(n\\^([0-9]+)\\)/', $string, $matches ) ) {
			return $matches[1];
		}
		if( $string == 'NON_POLY' ) {
			return 1000;
		}
		return 0;
	}

	function str2upper( $string ) {
		if( preg_match( '/O\\(n\\^([0-9]+)\\)/', $string, $matches ) ) {
			return $matches[1];
		}
		if( $string == 'POLY' ) {
			return 999;
		}
		return 1001;
	}

	function bound2str( $bound ) {
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
	function str2bounds( $string ) {
		if( preg_match( '/WORST_CASE\\(\\s*(.+)\\s*,\\s*(.+)\\s*\\)/', $string, $matches ) ) {
			return [ str2lower($matches[1]), str2upper($matches[2]) ];
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
		echo "  <th>score<th>lower<th>upper<th class=time>time\n";
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
		$bounds = str2bounds( $result );
		$bench[$solver] = [
			'id' => $record[0],
			'status' => $record[7],
			'result' => $result,
			'lower' => $bounds[0],
			'upper' => $bounds[1],
			'time' => parse_time($record[9]),
			'cpu' => parse_time($record[8]),
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
				$a = filllink( pairid2remote($p['id']) );
				$lower = $p['lower'];
				$upper = $p['upper'];
				$status = $p['status']; 
				if( $status == 'complete' ) {
					$solvers[$myname]['score'] += $score;
					echo "  <td>" . $score . "\n";
					echo "  <td " . lower2style($lower) . ">$a" . bound2str($lower) . "</a>\n";
					echo "  <td " . upper2style($upper) . ">$a" . bound2str($upper) . "</a>\n";
					echo "  <td class=time>$a" . $p["cpu"] . "/" . $p['time'] . "</a>\n";
				} else {
					echo "  <td colspan=4 ". status2style($status) . ">$a" .
						status2str($status) . "</a>\n";
				}
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


