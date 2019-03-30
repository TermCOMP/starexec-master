<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	include 'definitions.php';
?>
</head>
<body>
<?php
$competitions = [
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
			[ 'Integer Transition Systems', 'termination', 33456 ],
			[ 'Integer TRS Innermost', 'termination', 33016 ],
		],
		"Complexity Analysis" => [
			['Complexity: ITS', 'complexity', 33014 ],
			['Complexity: C Integer', 'complexity', 33013 ],
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
]
];

	$competition = $competitions[2019];
	$mcats = $competition["mcats"];

	echo "<h1>" . $competition['name'] . "</h1>";

	foreach( array_keys($mcats) as $mcatname ) {
	echo "<h2>$mcatname</h2>\n";
	$cats = $mcats[$mcatname];
	$table = [];
	$tools = [];
	echo "<table>\n";
	echo " <tr><th class=category>category<th class=ranking>ranking\n";
	foreach( $cats as $cat ) {
		$catname = $cat[0];
		$type = $cat[1];
		$jobid = $cat[2];

		// if job html exists, use it
		$jobpath = 'caches/'.$type.'_'.$jobid.'.html';
		if( ! file_exists($jobpath) ) {
			// creating job specific php file
			$jobpath = 'caches/'.$type.'_'.$jobid.'.php';
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
			}
		}

		$row = [];
		$init = false;
		$togo = 0;
		$conflicts = 0;

		// checking cached score file and making ranking
		$fname = jobid2scorefile($jobid); 
		if( file_exists($fname) ) {
			$init = true;
			$file = new SplFileObject($fname);
			$file->setFlags( SplFileObject::READ_CSV );
			foreach( $file as $line ) {
				if( !is_null($line[0]) ) {
					$row[$line[0]] = [ 'id' => $line[1], 'score' => $line[2], 'togo' => $line[3], 'conflicts' => $line[4] ];
					$tools[$line[0]] = true;
				}
			}
			uasort($row, function($s,$t) { return $s['score'] < $t['score'] ? 1 : -1; } );
			foreach( $row as $s ) {
				$togo += $s['togo'];
				$conflicts += $s['conflicts'];
			}
		}
		if( !$init || $togo > 0 ) {
			$class = 'incomplete';
			$jobpath .= '?refresh=1';
		} else {
			$class = 'complete';
		}
		echo " <tr class=$class>\n";
		echo "  <td class=category>\n";
		echo "   <a href='$jobpath'>$catname</a>\n";
		echo "   <a class=starexecid href='".jobid2url($jobid)."'>$jobid</a></sub>\n";
		if( $init ) {
			if( $conflicts > 0 ) {
				echo "<a class=conflict href='$jobpath#conflict'>conflict</a>";
			} 
			echo "  <td class=ranking>";
			foreach( array_keys($row) as $solver ) {
				$s = $row[$solver];
				$score = $s['score'];
				$togo = $s['togo'];
				$conflicts = $s['conflicts'];
				$id = $s['id'];
				$url = solverid2url($id);
				echo "   <a class=solver href='$url'>$solver</a>\n";
				echo "   <span class=score>$score</span>";
				if( $togo > 0 ) {
					echo "<span class=togo>,$togo</span>";
				}
				echo ";";
			}
		}
		echo "\n";
	}
	echo "</table>";
	}

?>


</body>
</html>
