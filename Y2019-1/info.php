<?php
$title = 'Termination Competition 2019';
$shortname = 'TermCOMP 2019';
$note = '';
$showconfig = true;
$showscore = true;
$closed = true;
$db = 'TPDB 11.0';
$previous = 'Y2018-1';

$teams = [];

$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'id' => 33457,
			'certified' => [
				'id' => 33116,
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'id' => 33458,
			'certified' => [
				'id' => 33117,
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'id' => 33012,
			'certified' => [
				'id' => 33126,
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'id' => 33461,
			'certified' => [
				'id' => 33127,
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'id' => 33020,
			'certified' => [
				'id' => 33128,
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'id' => 33455,
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'dir' => 'TRS_Contextsensitive',
			'id' => 33019,
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Innermost',
			'id' => 33453,
			'certified' => [
				'id' => 33570,
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'id' => 33452,
		],
	],
	"Termination of Programs" => [
		'C' => [
			'type' => 'termination',
			'dir' => 'C',
			'id' => 33437,
		],
		'C Integer' => [
			'type' => 'termination',
			'dir' => 'C_Integer',
			'id' => 33454,
		],
		'Logic Programming' => [
			'type' => 'termination',
			'dir' => 'Logic_Programming',
			'previous' => null,
			'id' => 33595,
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'dir' => 'Integer_Transition_Systems',
			'id' => 33456,
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'Integer_TRS_Innermost',
			'id' => 33016,
		],
	],
	"Complexity Analysis" => [
		'Complexity: ITS' => [
			'type' => 'complexity',
			'dir' => 'Complexity_ITS',
			'id' => 33014,
		],
		'Complexity: C Integer' => [
			'type' => 'complexity',
			'dir' => 'Complexity_C_Integer',
			'id' => 33013,
		],
	],
	"Demonstrations" => [
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'id' => 33568,
			'certified' => [
				'id' => 33569,
			],
		],
		'Java Bytecode' => [
			'type' => 'termination',
			'dir' => 'Java_Bytecode',
			'id' => 33571,
		],
		'Haskell' => [
			'type' => 'termination',
			'dir' => 'Haskell',
			'id' => 33572,
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'id' => 33563,
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'id' => 33566,
			'certified' => [
				'id' => 33567,
			],
		],
	],
];
?>
