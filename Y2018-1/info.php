<?php
$title = 'Termination Competition 2018';
$shortname = 'TermCOMP 2018';
$note = '';
$showconfig = true;
$showscore = true;
$closed = true;
$db = 'TPDB 10.6';
$teams = [];
$previous = 'Y2017';
$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'id' => 30034,
			'certified' => [
				'id' => 30038,
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'id' => 30035,
			'certified' => [
				'id' => 30039,
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'id' => 30036,
			'certified' => [
				'id' => 30040,
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'id' => 30037,
			'certified' => [
				'id' => 30041,
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'id' => 30042,
			'certified' => [
				'id' => 30043,
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'id' => 30044,
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'dir' => 'TRS_Contextsensitive',
			'id' => 30045,
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Innermost',
			'id' => 30046,
			'certified' => [
				'id' => 30097,
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'id' => 30047,
			'untrusted' => [303214],
		],
	],
	"Termination of Programs" => [
		'C' => [
			'type' => 'termination',
			'dir' => 'C',
			'id' => 30048,
		],
		'C Integer' => [
			'type' => 'termination',
			'dir' => 'C_Integer',
			'id' => 30049,
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'dir' => 'Integer_Transition_Systems',
			'id' => 30050,
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'Integer_TRS_Innermost',
			'id' => 30051,
		],
	],
	"Complexity Analysis" => [
		'Complexity: ITS' => [
			'type' => 'complexity',
			'dir' => 'Complexity_ITS',
			'id' => 30054,
		],
		'Complexity: C Integer' => [
			'type' => 'complexity',
			'dir' => 'Complexity_C_Integer',
			'id' => 30055,
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'id' => 30091,
			'certified' => [
				'id' => 30105,
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'id' => 30092,
			'certified' => [
				'id' => 30094,
			],
		],
	],
	"Demonstration" => [
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'id' => 30096,
			'certified' => [
				'id' => 30098,
			],
		],
		'HRS' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'id' => 30099,
		],
		'Java Bytecode' => [
			'type' => 'termination',
			'dir' => 'Java_Bytecode',
			'id' => 30100,
		],
		'Prolog' => [
			'type' => 'termination',
			'dir' => 'Prolog',
			'id' => 30101,
		],
		'Haskell' => [
			'type' => 'termination',
			'dir' => 'Haskell',
			'id' => 30102,
		],
		'Derivational Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Full_Rewriting',
			'id' => 30103,
			'certified' => [
				'id' => 30104,
			],
		],
	],
];
?>
