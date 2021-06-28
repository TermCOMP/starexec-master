<?php
$title = 'Termination Competition 2021 (First Run)';
$shortname = 'TermCOMP 2021-1';
$showconfig = true;
$note = 'Registration is open, via pull-requests on <a href=https://github.com/TermCOMP/starexec-master/blob/master/Y2021_info.php>this file</a>!';
$tpdbver = '11.1';
$closed = false;
$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426103,
			'participants' => [
				"NTI" => 549724,
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
				"MuTerm" => 326595,
			],
			'certified' => [
			'id' => null,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
					"NaTT" => 360199,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'id' => null,
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
				'id' => null,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
					"NaTT" => 360199,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426233,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426149,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"matchbox" => 360337,
				"AProVE" => 360174,
				"MnM" => 360442,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426058,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 360174,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					"AProVE" => 360177,
					"NaTT" => 360199,
				],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426154,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426022,
			'participants' => [
				"MuTerm" => 163986,
				"AProVE" => 360174,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 425946,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
					"AProVE" => 551426,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => null,
			'participants' => [
				"AProVE" => 551423,
			],
			'certified' => [
				'participants' => [
					"AProVE" => 551426,
				],
			],
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426140,
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
			'id' => null,
			'spaceid' => 426173,
			'participants' => [
				"AProVE" => 551429,
				"Ultimate" => 360394,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'C Integer' => [
			'type' => 'termination',
			'id' => null,
			'spaceid' => 426063,
			'participants' => [
				"Ultimate" => 360394,
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
			'id' => null,
			'spaceid' => 425924,
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
			'id' => null,
			'spaceid' => 425939,
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
			'spaceid' => 425990,
			'type' => 'termination',
			'id' => null,
			'participants' => [
				"AProVE" => 360174,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Java_Bytecode' => [
			'spaceid' => 425927,
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
		'Java_Bytecode_Recursive' => [
			'spaceid' => 426004,
			'type' => 'termination',
			'id' => false,
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
			'id' => null,
			'spaceid' => 425993,
			'participants' => [
				"NTI+cTI" => 549725,
				"AProVE" => 360174,
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Logic_Programming_with_Cut' => [
			'spaceid' => 425941,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			],
			'certified' => [
				'participants' => [
				],
			],
		],
		'Prolog' => [
			'spaceid' => 425912,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			],
			'certified' => [
				'participants' => [
				],
			],
		],
	],
	"Complexity Analysis" => [
		'Complexity: C_Integer' => [
			'spaceid' => 426011,
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
			'spaceid' => 426066,
			'type' => 'complexity',
			'id' => null,
			'participants' => [
				"AProVE" => 551428
			],
			'certified' => [
				'id' => false,
				'participants' => [
				],
			],
		],
		'Derivational_Complexity: TRS' => [
			'spaceid' => 425952,
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
		'Derivational_Complexity: TRS Innermost' => [
			'spaceid' => 425864,
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
		'Runtime_Complexity: TRS' => [
			'spaceid' => 426182,
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
		'Runtime_Complexity: TRS Innermost' => [
			'spaceid' => 426027,
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
					"AProVE" => 551426,
				],
			],
		],
	],
];
?>
