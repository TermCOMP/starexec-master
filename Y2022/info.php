<?php
$title = 'Termination Competition 2022';
$shortname = 'TermCOMP 2022';
$showconfig = true;
$showscore = false;
$note = '';
$db = 'TPDB 11.3';
$closed = false;
$previous = 'Y2021';

$teams = [
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
			'spaceid' => 466107,
			'id' => null,
			'participants' => [
				"NTI" => 549724,
//				"NaTT" => 552075,
//				"TTT2" => 552234,
//				"AProVE" => 551423,
//				"MuTerm" => 326595,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TTT2" => 552235,
//					"AProVE" => 552179,
//					"NaTT" => 552274,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 466081,
			'id' => null,
			'participants' => [
//				"MuTerm" => 326595,
//				"NaTT" => 552075,
//				"TTT2" => 552234,
//				"matchbox" => 550935,
//				"AProVE" => 551423,
//				"MnM" => 552513,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TTT2" => 552235,
//					"AProVE" => 552179,
//					"NaTT" => 552278,
					"matchbox" => 647693,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 466103,
			'id' => null,
			'participants' => [
//				"NaTT" => 552075,
//				"TTT2" => 552234,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 466194,
			'id' => null,
			'participants' => [
//				"NaTT" => 552075,
//				"TTT2" => 552234,
//				"matchbox" => 550934,
				"AProVE" => 551423,
//				"MnM" => 552058,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 466098,
			'id' => null,
			'participants' => [
//				"MuTerm" => 163986,
//				"NaTT" => 350520,
//				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"AProVE" => 552179,
//					"NaTT" => 552357,
				],
			],
		],
		'TRS Conditional (Operational Termination)' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 466363,
			'id' => null,
			'participants' => [
//				"MuTerm" => 326595,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Conditional (Termination)' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 466363,
			'note' => 'test',
			'participants' => [
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'dir' => 'TRS_Contextsensitive',
			'spaceid' => 466359,
			'id' => null,
			'participants' => [
//				"MuTerm" => 163986,
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
			'id' => null,
			'participants' => [
//				"MuTerm" => 326595,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"AProVE" => 552179,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => 466242,
			'id' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"AProVE" => 552179,
				],
			],
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 466209,
			'id' => null,
			'participants' => [
//				"SizeChangeTool" => 325830,
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
			'id' => null,
			'participants' => [
				"AProVE" => 671179,
//				"Ultimate" => 552352,
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
			'id' => null,
			'participants' => [
//				"Ultimate" => 552352,
//				"iRankFinder" => 360226,
				"AProVE" => 671179,
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
			'id' => null,
			'participants' => [
//				"Ctrl" => 23757,
//				"iRankFinder" => 360226,
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
			'id' => null,
			'participants' => [
//				"Ctrl" => 23758,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Haskell' => [
			'type' => 'termination',
			'dir' => 'Haskell',
			'spaceid' => 466206,
			'id' => null,
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
			'id' => null,
			'participants' => [
//				"AProVE" => 551423,
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
			'spaceid' => 466352,
			'id' => null,
			'participants' => [
//				"AProVE" => 551423,
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
			'spaceid' => 466183,
			'id' => null,
			'participants' => [
				"NTI+cTI" => 671137,
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
			'id' => null,
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
			'spaceid' => 466034,
			'id' => null,
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
			'id' => null,
			'participants' => [
				"AProVE" => 671123,
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
			'id' => null,
			'participants' => [
//				"AProVE" => 552182
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
			'id' => null,
			'participants' => [
//				"TcT" => 360388,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TcT" => 360387,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'spaceid' => 466273,
			'id' => null,
			'participants' => [
//				"TcT" => 360385,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TcT" => 360391,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'spaceid' => 466246,
			'id' => null,
			'participants' => [
//				"TcT" => 360390,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TcT" => 360389,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'spaceid' => 466379,
			'id' => null,
			'participants' => [
//				"TcT" => 360386,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					"TcT" => 360384,
					"AProVE" => 552179,
				],
			],
		],
		'Runtime Complexity: TRS Parallel Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'spaceid' => 466379,
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
];
?>
