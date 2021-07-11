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
			'id' => null,
			'spaceid' => 466107,
			'participants' => [
				"NTI" => 549724,
				"NaTT" => 552075,
				"TTT2" => 552234,
				"AProVE" => 551423,
				"MuTerm" => 326595,
			],
			'certified' => [
			'id' => null,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
					"NaTT" => 552274,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 466081,
			'participants' => [
				"MuTerm" => 326595,
				"NaTT" => 552075,
				"TTT2" => 552234,
				"matchbox" => 550935,
				"AProVE" => 551423,
				"MnM" => 552513,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
					"NaTT" => 552278,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 466103,
			'participants' => [
				"NaTT" => 552075,
				"TTT2" => 552234,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 466194,
			'participants' => [
				"NaTT" => 552075,
				"TTT2" => 552234,
				"matchbox" => 550934,
				"AProVE" => 551423,
				"MnM" => 552058,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TTT2" => 552235,
					"AProVE" => 552179,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 466098,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 551423,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"AProVE" => 552179,
					"NaTT" => 552357,
				],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'id' => null,
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
			'id' => null,
			'spaceid' => 466359,
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
			'id' => null,
			'spaceid' => 466200,
			'participants' => [
				"MuTerm" => 326595,
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
			'id' => null,
			'spaceid' => 466242,
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
			'id' => null,
			'spaceid' => 466209,
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
			'id' => null,
			'spaceid' => 466367,
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
			'id' => null,
			'spaceid' => 466376,
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
			'id' => null,
			'spaceid' => 466219,
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
			'id' => null,
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
				'id' => null,
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
				'id' => null,
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
				'id' => null,
				'participants' => [
				],
			],
		],
		'Logic Programming' => [
			'type' => 'termination',
			'id' => null,
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
			'spaceid' => 466237,
			'type' => 'termination',
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
			'spaceid' => 466034,
			'type' => 'termination',
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
		'Complexity: C_Integer' => [
			'spaceid' => 466341,
			'type' => 'complexity',
			'id' => null,
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
			'id' => null,
			'participants' => [
				"TcT" => 360388,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TcT" => 360387,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'spaceid' => 466273,
			'type' => 'complexity',
			'id' => null,
			'participants' => [
				"TcT" => 360385,
				"AProVE" => 551421,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TcT" => 360391,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'spaceid' => 466246,
			'type' => 'complexity',
			'id' => null,
			'participants' => [
				"TcT" => 360390,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TcT" => 360389,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'spaceid' => 466379,
			'type' => 'complexity',
			'id' => null,
			'participants' => [
				"TcT" => 360386,
				"AProVE" => 551428,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TcT" => 360384,
					"AProVE" => 552179,
				],
			],
		],
	],
];
?>
