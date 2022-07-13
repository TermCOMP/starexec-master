<?php
$title = 'Termination Competition 2020';
$shortname = 'TermComp 2020';
$note = '(Final Run. First run is <a href="https://termcomp.github.io/Y2020-1/">here</a>)';
$showconfig = false;
$closed = true;
$db = 'TPDB 11.1';

$teams = [
	'RWTH Aachen' => ['AProVE','LoAT'],
	'HTWK Leipzig' => ['matchbox'],
	'U. Innsbruck' => ['TTT2', 'TcT'],
	'MU-TERM' => ['MuTerm'],
	'Berufsakademie Saarland' => ['MnM'],
	'U. de La Réunion' => ['NTI', 'NTI+cTI'],
	'Radboud U. Nijmegen' => ['Wanda', 'Ctrl'],
	'AIST' => ['NaTT'],
	'U. Freiburg' => ['Ultimate'],
	'LSV Cachan' => ['SizeChangeTool'],
	'U. Complutense de Madrid' => ['iRankFinder'],
	'Gumma U.' => ['SOL'],
];

$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'id' => 41483,
			'spaceid' => 426103,
			'participants' => [
				"NTI" => 360349,
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
				"MuTerm" => 326595,
			],
			'certified' => [
			'id' => 41501,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
					"NaTT" => 360199,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'id' => 41485,
			'spaceid' => 426158,
			'participants' => [
				"MuTerm" => 326595,
				"NaTT" => 350520,
				"TTT2" => 360055,
				"matchbox" => 360336,
				"AProVE" => 360174,
				"MnM" => 360442,
			],
			'certified' => [
				'id' => 41502,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
					"NaTT" => 360199,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'id' => 41486,
			'spaceid' => 426233,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' =>  41503,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'id' =>  41488,
			'spaceid' => 426149,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"matchbox" => 360337,
				"AProVE" => 360174,
				"MnM" => 360442,
			],
			'certified' => [
				'id' =>  41504,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'id' =>  41490,
			'spaceid' => 426058,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => 41505,
				'participants' => [
					"AProVE" => 360177,
					"NaTT" => 360199,
				],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'id' =>  41511,
			'spaceid' => 426154,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'id' =>  41493,
			'spaceid' => 426022,
			'participants' => [
				"MuTerm" => 163986,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'id' =>  41494,
			'spaceid' => 425946,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'id' =>  41495,
			'spaceid' => 426140,
			'participants' => [
				"SizeChangeTool" => 325830,
				"Wanda" => 359682,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
	],
	"Termination of Programs" => [
		'C' => [
			'type' => 'termination',
			'id' => 41518,
			'spaceid' => 426173,
			'participants' => [
				"AProVE" => 360173,
				"Ultimate" => 360394,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'C Integer' => [
			'type' => 'termination',
			'id' =>  41519,
			'spaceid' => 426063,
			'participants' => [
				"Ultimate" => 360394,
				"iRankFinder" => 360226,
				"AProVE" => 360173,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'id' =>  41496,
			'spaceid' => 425924,
			'participants' => [
				"Ctrl" => 23757,
				"iRankFinder" => 360226,
				"LoAT" => 360195,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'id' =>  41497,
			'spaceid' => 425939,
			'participants' => [
				"Ctrl" => 23758,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Haskell' => [
			'spaceid' => 425990,
			'type' => 'termination',
			'id' => 41564,
			'participants' => [
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Java_Bytecode' => [
			'spaceid' => 425927,
			'type' => 'termination',
			'id' => 41524,
			'participants' => [
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Java_Bytecode_Recursive' => [
			'spaceid' => 426004,
			'type' => 'termination',
			'id' => null,
			'participants' => [
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Logic Programming' => [
			'type' => 'termination',
			'id' =>  41498,
			'spaceid' => 425993,
			'participants' => [
				"NTI" => 360349,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Logic_Programming_with_Cut' => [
			'spaceid' => 425941,
			'type' => 'termination',
			'id' => null,
			'participants' => [
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Prolog' => [
			'spaceid' => 425912,
			'type' => 'termination',
			'id' => null,
			'participants' => [
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
	],
	"Complexity Analysis" => [
		'Complexity: C_Integer' => [
			'spaceid' => 426011,
			'type' => 'complexity',
			'id' => 41565,
			'participants' => [
				"AProVE" => 360180
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Complexity: ITS' => [
			'spaceid' => 426066,
			'type' => 'complexity',
			'id' => 41566,
			'participants' => [
				"AProVE" => 360179
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Derivational_Complexity: TRS' => [
			'spaceid' => 425952,
			'type' => 'complexity',
			'id' => 41499,
			'participants' => [
				"TcT" => 360388,
				"AProVE" => 360175,
			],
			'certified' => [
				'id' => 41527,
				'participants' => [
					"TcT" => 360387,
				],
			],
		],
		'Derivational_Complexity: TRS Innermost' => [
			'spaceid' => 425864,
			'type' => 'complexity',
			'id' => 41500,
			'participants' => [
				"TcT" => 360385,
				"AProVE" => 360175,
			],
			'certified' => [
				'id' => 41528,
				'participants' => [
					"TcT" => 360391,
				],
			],
		],
		'Runtime_Complexity: TRS' => [
			'spaceid' => 426182,
			'type' => 'complexity',
			'id' =>  41508,
			'participants' => [
				"TcT" => 360390,
				"AProVE" => 360179,
			],
			'certified' => [
				'id' => 41529,
				'participants' => [
					"TcT" => 360389,
				],
			],
		],
		'Runtime_Complexity: TRS Innermost' => [
			'spaceid' => 426027,
			'type' => 'complexity',
			'id' =>  41507,
			'participants' => [
				"TcT" => 360386,
				"AProVE" => 360179,
			],
			'certified' => [
				'id' => 41509,
				'participants' => [
					"TcT" => 360384,
					"AProVE" => 360177,
				],
			],
		],
	],
];
?>
