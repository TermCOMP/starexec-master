<?php
$title = 'Termination Competition 2019';
$shortname = 'TermCOMP 2019';
$note = '';
$showconfig = false;
$closed = true;
$db = 'TPDB 11.0';

$teams = [];

$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'id' => 33457,
			'certified' => [
				'id' => 33116,
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'id' => 33458,
			'certified' => [
				'id' => 33117,
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'id' => 33012,
			'certified' => [
				'id' => 33126,
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'id' => 33461,
			'certified' => [
				'id' => 33127,
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'id' => 33020,
			'certified' => [
				'id' => 33128,
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'id' => 33455,
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'id' => 33019,
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'id' => 33453,
			'certified' => [
				'id' => 33570,
			],
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'id' => 33452,
		],
	],
	"Termination of Programs" => [
		'C' => [
			'type' => 'termination',
			'id' => 33437,
		],
		'C Integer' => [
			'type' => 'termination',
			'id' => 33454,
		],
		'Logic Programming' => [
			'type' => 'termination',
			'id' => 33595,
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'id' => 33456,
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'id' => 33016,
		],
	],
	"Complexity Analysis" => [
		'Complexity: ITS' => [
			'type' => 'complexity',
			'id' => 33014,
		],
		'Complexity: C Integer' => [
			'type' => 'complexity',
			'id' => 33013,
		],
	],
	"Demonstrations" => [
		'TRS Outermost' => [
			'type' => 'termination',
			'id' => 33568,
			'certified' => [
				'id' => 33569,
			],
		],
		'Java Bytecode' => [
			'type' => 'termination',
			'id' => 33571,
		],
		'Haskell' => [
			'type' => 'termination',
			'id' => 33572,
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'id' => 33563,
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'id' => 33566,
			'certified' => [
				'id' => 33567,
			],
		],
	],
];
?>