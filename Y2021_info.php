<?php
$title = 'Termination Competition 2021 (First Run)';
$shortname = 'TermCOMP 2021-1';
$showconfig = true;
$note = '';
$tpdbver = '11.2';
$closed = true;
$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'id' => 47659,
			'spaceid' => 466107,
			'participants' => [
				"NTI" => 549724,
				"NaTT" => 552075,
				"TTT2" => 552234,
				"AProVE" => 551423,
				"MuTerm" => 326595,
			],
			'certified' => [
			'id' => 47660,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
					"NaTT" => 360199,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'id' => 47661,
			'spaceid' => 466081,
			'participants' => [
				"MuTerm" => 326595,
				"NaTT" => 552075,
				"TTT2" => 552234,
				"matchbox" => 550935,
				"AProVE" => 551423,
				"MnM" => 552058,
			],
			'certified' => [
				'id' => 47662,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
					"NaTT" => 360199,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'id' => 47664,
			'spaceid' => 466103,
			'participants' => [
				"NaTT" => 552075,
				"TTT2" => 552234,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47665,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'id' => 47666,
			'spaceid' => 466194,
			'participants' => [
				"NaTT" => 552075,
				"TTT2" => 552234,
				"matchbox" => 550934,
				"AProVE" => 551423,
				"MnM" => 552058,
			],
			'certified' => [
				'id' => 47667,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'id' => 47668,
			'spaceid' => 466098,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47669,
				'participants' => [
					"AProVE" => 552179,
					"NaTT" => 360199,
				],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'id' => 47670,
			'spaceid' => 466363,
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
			'id' => 47671,
			'spaceid' => 466359,
			'participants' => [
				"MuTerm" => 163986,
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'id' => 47672,
			'spaceid' => 466200,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => 47673,
				'participants' => [
					"AProVE" => 552179,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 466242,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
					"AProVE" => 552179,
				],
			],
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'id' => 47674,
			'spaceid' => 466209,
			'participants' => [
				"SizeChangeTool" => 325830,
				"Wanda" => 359682,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
	],
	"Termination of Programs" => [
		'C' => [
			'type' => 'termination',
			'id' => 47704,
			'spaceid' => 466367,
			'participants' => [
				"AProVE" => 551429,
				"Ultimate" => 552352,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'C Integer' => [
			'type' => 'termination',
			'id' => 47705,
			'spaceid' => 466376,
			'participants' => [
				"Ultimate" => 552352,
				"iRankFinder" => 360226,
				"AProVE" => 551429,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'id' => 47675,
			'spaceid' => 466219,
			'participants' => [
				"Ctrl" => 23757,
				"iRankFinder" => 360226,
				"LoAT" => 551398,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'id' => 47676,
			'spaceid' => 466410,
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
			'spaceid' => 466206,
			'type' => 'termination',
			'id' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Java Bytecode' => [
			'spaceid' => 466222,
			'type' => 'termination',
			'id' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Java Bytecode Recursive' => [
			'spaceid' => 466352,
			'type' => 'termination',
			'id' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Logic Programming' => [
			'type' => 'termination',
			'id' => 47677,
			'spaceid' => 466183,
			'participants' => [
				"NTI+cTI" => 549725,
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Logic Programming with Cut' => [
			'spaceid' => 466237,
			'type' => 'termination',
			'id' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Prolog' => [
			'spaceid' => 466034,
			'type' => 'termination',
			'id' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
	],
	'Complexity Analysis' => [
		'Complexity: C_Integer' => [
			'spaceid' => 466341,
			'type' => 'complexity',
			'id' => null,
			'participants' => [
				"AProVE" => 551427
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Complexity: ITS' => [
			'spaceid' => 466146,
			'type' => 'complexity',
			'id' => null,
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
			'spaceid' => 466043,
			'type' => 'complexity',
			'id' => 47678,
			'participants' => [
				"TcT" => 360388,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => 47679,
				'participants' => [
					"TcT" => 360387,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'spaceid' => 466273,
			'type' => 'complexity',
			'id' => 47680,
			'participants' => [
				"TcT" => 360385,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => 47681,
				'participants' => [
					"TcT" => 360391,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'spaceid' => 466246,
			'type' => 'complexity',
			'id' => 47682,
			'participants' => [
				"TcT" => 360390,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => 47683,
				'participants' => [
					"TcT" => 360389,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'spaceid' => 466379,
			'type' => 'complexity',
			'id' => 47684,
			'participants' => [
				"TcT" => 360386,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => 47685,
				'participants' => [
					"TcT" => 360384,
					"AProVE" => 552179,
				],
			],
		],
	],
];
?>
