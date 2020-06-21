<?php
	include 'definitions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link rel="stylesheet" type="text/css" href="master.css">
</head>
<body>
<?php
$show_config = $_GET['showconfig'];
$competitions = [
2020 => [
	"name" => "Termination Competition 2020",
	"mcats" => [
		"Termination of Rewriting" => [
			[ 'TRS Standard', 'termination', 41179 ],
			[ 'TRS Standard Certified', 'termination',  ],
			[ 'SRS Standard', 'termination', 41180 ],
			[ 'SRS Standard Certified', 'termination',  ],
			[ 'TRS Relative', 'termination', 41174 ],
			[ 'TRS Relative Certified', 'termination',  ],
			[ 'SRS Relative', 'termination', 41181 ],
			[ 'SRS Relative Certified', 'termination',  ],
			[ 'TRS Equational', 'termination', 41182 ],
			[ 'TRS Equational Certified', 'termination',  ],
			[ 'TRS Conditional', 'termination', 41183 ],
			[ 'TRS Context Sensitive', 'termination', 41170 ],
			[ 'TRS Innermost', 'termination', 41184 ],
			[ 'HRS (union beta)', 'termination', 41185 ],
		],
	 	"Termination of Programs" => [
			[ 'C', 'termination', 41176 ],
			[ 'C Integer', 'termination', 41158 ],
			[ 'Logic Programming', 'termination', 41167 ],
			[ 'Integer Transition Systems', 'termination', 41187 ],
			[ 'Integer TRS Innermost', 'termination', 41188 ],
		],
		"Complexity Analysis" => [
			[ 'Complexity: ITS', 'complexity',  ],
			[ 'Complexity: C Integer', 'complexity',  ],
			[ 'Derivational Complexity: TRS', 'complexity', 41159 ],
			[ 'Derivational Complexity: TRS Innermost', 'complexity', 41160 ],
			[ 'Derivational Complexity: TRS Innermost Certified', 'complexity',  ],
			[ 'Runtime Complexity: TRS', 'complexity', 41161 ],
			[ 'Runtime Complexity: TRS Innermost', 'complexity', 41163 ],
			[ 'Runtime Complexity: TRS Innermost Certified', 'complexity',  ],
		],
		"Demonstrations" => [
			[ 'TRS Outermost', 'termination',  ],
			[ 'TRS Outermost Certified', 'termination',  ],
			[ 'TRS Innermost Certified', 'termination',  ],
			[ 'Java Bytecode', 'termination',  ],
			[ 'Haskell', 'termination',  ],
		],
	],
],
2019 => [
	"name" => "Termination Competition 2019",
	"mcats" => [
		"Termination of Rewriting" => [
			[ 'TRS Standard', 'termination', 33457 ],
			[ 'TRS Standard Certified', 'termination', 33116 ],
			[ 'SRS Standard', 'termination', 33458 ],
			[ 'SRS Standard Certified', 'termination', 33117 ],
			[ 'TRS Relative', 'termination', 33012 ],
			[ 'TRS Relative Certified', 'termination', 33126 ],
			[ 'SRS Relative', 'termination', 33461 ],
			[ 'SRS Relative Certified', 'termination', 33127 ],
			[ 'TRS Equational', 'termination', 33020 ],
			[ 'TRS Equational Certified', 'termination', 33128 ],
			[ 'TRS Conditional', 'termination', 33455 ],
			[ 'TRS Context Sensitive', 'termination', 33019 ],
			[ 'TRS Innermost', 'termination', 33453 ],
			[ 'HRS (union beta)', 'termination', 33452 ],
		],
	 	"Termination of Programs" => [
			[ 'C', 'termination', 33437 ],
			[ 'C Integer', 'termination', 33454 ],
			[ 'Logic Programming', 'termination', 33595 ],
			[ 'Integer Transition Systems', 'termination', 33456 ],
			[ 'Integer TRS Innermost', 'termination', 33016 ],
		],
		"Complexity Analysis" => [
			[ 'Complexity: ITS', 'complexity', 33014 ],
			[ 'Complexity: C Integer', 'complexity', 33013 ],
		],
		"Demonstrations" => [
			[ 'TRS Outermost', 'termination', 33568 ],
			[ 'TRS Outermost Certified', 'termination', 33569 ],
			[ 'TRS Innermost Certified', 'termination', 33570 ],
			[ 'Java Bytecode', 'termination', 33571 ],
			[ 'Haskell', 'termination', 33572 ],
			[ 'Runtime Complexity: TRS', 'complexity', 33563 ],
			[ 'Runtime Complexity: TRS Innermost', 'complexity', 33566 ],
			[ 'Runtime Complexity: TRS Innermost Certified', 'complexity', 33567 ],
		],
	],
],
2018 => [
	'name' => 'Termination Competition 2018',
	'mcats' => [
		"Termination of Rewriting" => [
			[ 'TRS Standard', 'termination', 30034 ],
			[ 'TRS Standard Certified', 'termination', 30038 ],
			[ 'SRS Standard', 'termination', 30035 ],
			[ 'SRS Standard Certified', 'termination', 30039 ],
			[ 'TRS Relative', 'termination', 30036 ],
			[ 'TRS Relative Certified', 'termination', 30040 ],
			[ 'SRS Relative', 'termination', 30037 ],
			[ 'SRS Relative Certified', 'termination', 30041 ],
			[ 'TRS Equational', 'termination', 30042 ],
			[ 'TRS Equational Certified', 'termination', 30043 ],
			[ 'TRS Conditional', 'termination', 30044 ],
			[ 'TRS Context Sensitive', 'termination', 30045 ],
			[ 'TRS Innermost', 'termination', 30046 ],
			[ 'HRS (union beta)', 'termination', 30047 ],
		],
	 	"Termination of Programs" => [
			[ 'C', 'termination', 30048 ],
			[ 'C Integer', 'termination', 30049 ],
			[ 'Integer Transition Systems', 'termination', 30050 ],
			[ 'Integer TRS Innermost', 'termination', 30051 ],
		],
		"Complexity Analysis" => [
			['Complexity: ITS', 'complexity', 30054 ],
			['Complexity: C Integer', 'complexity', 30055 ],
			['Runtime Complexity: TRS', 'complexity', 30091 ],
			['Runtime Complexity: TRS Innermost', 'complexity', 30092 ],
			['Runtime Complexity: TRS Innermost Certified', 'complexity', 30094 ],
		],
		"Demonstration" => [
			[ 'TRS Outermost', 'termination', 30096 ],
			[ 'TRS Outermost Certified', 'termination', 30098 ],
			[ 'TRS Innermost Certified', 'termination', 30097 ],
			[ 'HRS', 'termination', 30099 ],
			[ 'Java Bytecode', 'termination', 30100 ],
			[ 'Prolog', 'termination', 30101 ],
			[ 'Haskell', 'termination', 30102 ],
			[ 'Derivational Complexity: TRS', 'complexity', 30103 ],
			[ 'Derivational Complexity: TRS Certified', 'complexity', 30104 ],
			[ 'Runtime Complexity: TRS Certified', 'complexity', 30105 ],
		],
	],
],
2014 => [
	'name' => 'Termination Competition 2014',
	'mcats' => [
		"Termination of Rewriting" => [
			[ 'TRS Standard', 'termination', 5373 ],
			[ 'TRS Standard Certified', 'termination', 5377 ],
			[ 'SRS Standard', 'termination', 5374 ],
			[ 'SRS Standard Certified', 'termination', 5378 ],
			[ 'TRS Relative', 'termination', 5375 ],
		],
	],
],
];
	$competition = $competitions['2020'];
	$mcats = $competition['mcats'];

	echo
'<h1>' . $competition['name'] . '</h1>
';
	

$scored_keys = [
	'CERTIFIED YES',
	'CERTIFIED NO',
	'YES',
	'NO',
	'UP',
	'LOW',
];

foreach( array_keys($mcats) as $mcatname ) {
	$total_done = 0;
	$total_togo = 0;
	$total_cpu = 0;
	$total_time = 0;
	echo
'<h2>' . $mcatname . '</h2>
';
	$cats = $mcats[$mcatname];
	$table = [];
	$tools = [];
	echo
'<table>
 <tr>
  <th class=category>category
  <th class=ranking>ranking
';
	foreach( $cats as $cat ) {
		$catname = $cat[0];
		$type = $cat[1];
		$jobid = $cat[2];
		if( !$jobid ) {
			echo
' <tr class=' . $class . '>
  <td class=category>'.$catname;
			continue;
		}
		$cat_done = 0;
		$cat_togo = 0;
		$cat_cpu = 0;
		$cat_time = 0;
		// if job html exists, use it
		$jobpath = 'caches/'.$type.'_'.$jobid.'.html';
		if( ! file_exists($jobpath) ) {
			// creating job specific php file
			$jobfile = $type.'_'.$jobid.'.php';
			$jobpath = 'caches/'.$jobfile;
			if( ! file_exists($jobpath) ) {
				$file = fopen($jobpath,'w');
				fwrite( $file,
'<?php
	$competitionname = '. str2str($competition['name']) . ';
	$jobname = ' . str2str($catname) . ';
	$jobid = ' . $jobid . ';
	chdir("..");
	include \'' . type2php($type) .'\';
?>'
				); 
				fclose($file);
				$ret = system( 'cd caches; php -f "'. $jobfile . '"; cd ..');
			}
		}

		$init = false;
		$togo = 0;
		$conflicts = 0;
		$best = [ 'score' => 1, 'time' => INF ];
		foreach( $scored_keys as $key ) {
			$best[$key] = 1;
		}

		// checking cached score file and making ranking
		$fname = jobid2scorefile($jobid); 
		if( file_exists($fname) ) {
			$init = true;
			$solvers = json_decode(file_get_contents($fname),TRUE);
			uasort($solvers, function($s,$t) { return $s['score'] < $t['score'] ? 1 : -1; } );
			foreach( $solvers as $s ) {
				$togo += $s['togo'];
				$conflicts += $s['conflicts'];
				foreach( $scored_keys as $key ) {
					$best[$key] = max($best[$key], $s[$key]);
				}
				$best['time'] = min($best['time'], $s['time']);
			}
		}
		if( !$init || $togo > 0 ) {
			$class = 'incomplete';
		} else {
			$class = 'complete';
			$jobpath .= '?complete=1';
		}
		echo
' <tr class=' . $class . '>
  <td class=category>
   <a href="' . $jobpath . '">' . $catname . '</a>
   <a class=starexecid href="' . jobid2url($jobid) . '">' . $jobid . '</a>
';
		if( $init ) {
			if( $conflicts > 0 ) {
				echo
'<a class=conflict href="' . $jobpath . '#conflict">conflict</a>
';
			} 
			echo
'  <td class=ranking>
';
			$prev_score = $best['score'];
			$rank = 1;
			$count = 0;
			foreach( $solvers as $s ) {
				$score = $s['score'];
				$togo = $s['togo'];
				$done = $s['done'];
				$cpu = $s['cpu'];
				$time = $s['time'];
				$certtime = $s['certtime'];
				$conflicts = $s['conflicts'];
				$name = $s['solver'];
				$id = $s['solverid'];
				$config = $s['config'];
				$configid = $s['configid'];
				$url = solverid2url($id);
				$count += 1;
				if( $prev_score > $score ) {
					$rank = $count;
				}
				$prev_score = $score;
				echo
'   <span class='. ( $rank == 1 ? 'best' : '' ) . 'solver>
    ' . $rank . '. <a href="'. $url . '">'. $name . '</a>';
				if( $show_config ) {
					echo '
     <a class=config href="' . configid2url($configid) . '">'. $config . '</a>';
				}
				echo '
    <span class=score>';
				foreach( $scored_keys as $key ) {
					if( array_key_exists( $key, $s ) ) {
						$subscore = $s[$key];
						echo '<span '. result2style( $key, $subscore == $best[$key] ) . '>'. $key . ':' . $subscore . '</span>, ';
					}
				}
				echo
'<span class='.( $time == $best['time'] ? 'besttime' : 'time' ).'>TIME:'.seconds2str($time).'</span>';
				if( $certtime != 0 ) {
					echo
', <span class=time>Certification:'.seconds2str($certtime).'</span>';
				}
				echo
'</span>
';
				if( $togo > 0 ) {
					echo
'   <span class=togo>,' . $togo . '</span>';
				}
				echo
'   </span><br/>
';
				$cat_cpu += $cpu;
				$cat_time += $time;
				$cat_done += $done;
				$cat_togo += $togo;
				$total_cpu += $cpu;
				$total_time += $time;
				$total_done += $done;
				$total_togo += $togo;
			}
		}
		if( $cat_togo > 0 ) {
			echo
' <td>' . $cat_done . '/' . ($cat_done + $cat_togo) . '
';
		}
	}
	echo
'</table>
<p>Progress: ' . $total_done . ($total_done + $total_togo) .
', CPU Time: ' . seconds2str($total_cpu).
', Node Time: ' . seconds2str($total_time) . '</p>
';
}

?>

</body>
</html>
