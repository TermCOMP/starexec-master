<?php
$title = 'Termination Competition 2021';
$shortname = 'TermCOMP 2021';
$showconfig = true;
$showscore = true;
$note = '';
$db = 'TPDB 11.2';
$previous = 'Y2020-2';
$closed = true;

$teams = [// List of teams.
	'AProVE' => ['AProVE'],
	'iRankFinder' => ['iRankFinder'],
	'LoAT' => ['LoAT'],
	'Matchbox' => ['matchbox'],
	'MU-TERM' => ['MuTerm'],
	'MultumNonMulta' => ['MnM'],
	'NaTT' => ['NaTT'],
	'NTI' => ['NTI', 'NTI+cTI'],
	'SizeChangeTool' => ['SizeChangeTool'],
	'SOL' => ['SOL'],
	'Tyrolean Tools' => ['TTT2', 'TcT'],
	'Ultimate' => ['Ultimate'],
	'Wanda-Ctrl' => ['Wanda', 'Ctrl'],
];
$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'id' => 47877,
			'participants' => [
				"NTI" => 549724,
				"NaTT" => 552075,
				"TTT2" => 552234,
				"AProVE" => 551423,
				"MuTerm" => 326595,
			],
			'certified' => [
			'id' => 47875,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
					"NaTT" => 552274,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 466081,
			'id' => 47878,
			'participants' => [
				"MuTerm" => 326595,
				"NaTT" => 552075,
				"TTT2" => 552234,
				"matchbox" => 550935,
				"AProVE" => 551423,
				"MnM" => 552513,
			],
			'certified' => [
				'id' => 47876,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
					"NaTT" => 552278,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 466103,
			'id' => 47871,
			'participants' => [
				"NaTT" => 552075,
				"TTT2" => 552234,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47872,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 466194,
			'id' => 47874,
			'participants' => [
				"NaTT" => 552075,
				"TTT2" => 552234,
				"matchbox" => 550934,
				"AProVE" => 551423,
				"MnM" => 552058,
			],
			'certified' => [
				'id' => 47873,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 466098,
			'id' => 47879,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47953,
				'participants' => [
					"AProVE" => 552179,
//					"NaTT" => 552357,
				],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 466363,
			'id' => 47881,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'dir' => 'TRS_Contextsensitive',
			'spaceid' => 466359,
			'id' => 47882,
			'participants' => [
				"MuTerm" => 163986,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Innermost',
			'spaceid' => 466200,
			'id' => 47883,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47884,
				'participants' => [
					"AProVE" => 552179,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'previous' => 'Y2019/TRS_Outermost.VBS.json',
			'spaceid' => 466242,
			'id' => 47885,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47886,
				'participants' => [
					"AProVE" => 552179,
				],
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 466209,
			'id' => 47887,
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
			'dir' => 'C',
			'spaceid' => 466367,
			'id' => 47888,
			'participants' => [
				"AProVE" => 551429,
				"Ultimate" => 552352,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'C Integer' => [
			'type' => 'termination',
			'dir' => 'C_Integer',
			'spaceid' => 466376,
			'id' => 47889,
			'participants' => [
				"Ultimate" => 552352,
				"iRankFinder" => 360226,
				"AProVE" => 551429,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'dir' => 'Integer_Transition_Systems',
			'spaceid' => 466219,
			'id' => 47892,
			'participants' => [
				"Ctrl" => 23757,
				"iRankFinder" => 360226,
				"LoAT" => 551398,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'Integer_TRS_Innermost',
			'spaceid' => 466410,
			'id' => 47890,
			'participants' => [
				"Ctrl" => 23758,
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Haskell' => [
			'type' => 'termination',
			'dir' => 'Haskell',
			'spaceid' => 466206,
			'id' => 47958,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Java Bytecode' => [
			'type' => 'termination',
			'dir' => 'Java_Bytecode',
			'spaceid' => 466222,
			'id' => 47905,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Java Bytecode Recursive' => [
			'type' => 'termination',
			'dir' => 'Java_Bytecode_Recursive',
			'previous' => null,
			'spaceid' => 466352,
			'id' => 47907,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Logic Programming' => [
			'type' => 'termination',
			'dir' => 'Logic_Programming',
			'id' => 47891,
			'spaceid' => 466183,
			'participants' => [
				"NTI+cTI" => 549725,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Logic Programming with Cut' => [
			'type' => 'termination',
			'dir' => 'Logic_Programming_with_Cut',
			'spaceid' => 466237,
			'previous' => null,
			'id' => 47903,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Prolog' => [
			'type' => 'termination',
			'dir' => 'Prolog',
			'previous' => null,
			'spaceid' => 466034,
			'id' => 47904,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
	],
	'Complexity Analysis' => [
		'Complexity: C Integer' => [
			'type' => 'complexity',
			'dir' => 'Complexity_C_Integer',
			'spaceid' => 466341,
			'id' => 47893,
			'participants' => [
				"AProVE" => 551427
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Complexity: ITS' => [
			'type' => 'complexity',
			'dir' => 'Complexity_ITS',
			'spaceid' => 466146,
			'id' => 47894,
			'participants' => [
				"AProVE" => 552182
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Derivational Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Full_Rewriting',
			'spaceid' => 466043,
			'id' => 47897,
			'participants' => [
				"TcT" => 360388,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => 47895,
				'participants' => [
					"TcT" => 360387,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'spaceid' => 466273,
			'id' => 47899,
			'participants' => [
				"TcT" => 360385,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => 47898,
				'participants' => [
					"TcT" => 360391,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'spaceid' => 466246,
			'id' => 47896,
			'participants' => [
				"TcT" => 360390,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => 47900,
				'participants' => [
					"TcT" => 360389,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'id' => 47901,
			'spaceid' => 466379,
			'participants' => [
				"TcT" => 360386,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => 47902,
				'participants' => [
					"TcT" => 360384,
					"AProVE" => 552179,
				],
			],
		],
	],
];
?>
