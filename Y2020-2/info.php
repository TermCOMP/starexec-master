<?php
$title = 'Termination Competition 2020';
$shortname = 'TermComp 2020';
$note = '(Final Run. First run is <a href="https://termcomp.github.io/Y2020-1/">here</a>)';
$showconfig = true;
$showscore = true;
$closed = true;
$db = 'TPDB 11.1';
$previous = 'Y2019-1';

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
			'dir' => 'SRS_Standard',
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
			'dir' => 'TRS_Relative',
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
			'dir' => 'SRS_Relative',
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
			'dir' => 'TRS_Equational',
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
			'dir' => 'TRS_Conditional',
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
			'dir' => 'TRS_Contextsensitive',
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
			'dir' => 'TRS_Innermost',
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
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
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
			'dir' => 'C',
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
			'dir' => 'C_Integer',
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
			'dir' => 'Integer_Transition_Systems',
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
			'dir' => 'Integer_TRS_Innermost',
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
			'dir' => 'Haskell',
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
		'Java Bytecode' => [
			'spaceid' => 425927,
			'type' => 'termination',
			'dir' => 'Java_Bytecode',
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
		'Java Bytecode Recursive' => [
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
			'dir' => 'Logic_Programming',
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
		'Logic Programming with Cut' => [
			'spaceid' => 425941,
			'type' => 'termination',
			'dir' => 'Logic_Programming_with_Cut',
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
			'dir' => 'Prolog',
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
		'Complexity: C Integer' => [
			'spaceid' => 426011,
			'type' => 'complexity',
			'dir' => 'Complexity_C_Integer',
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
			'dir' => 'Complexity_ITS',
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
		'Derivational Complexity: TRS' => [
			'spaceid' => 425952,
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Full_Rewriting',
			'previous' => 'Y2018/Derivational_Complexity__TRS.VBS.json',
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
		'Derivational Complexity: TRS Innermost' => [
			'spaceid' => 425864,
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'previous' => null,
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
		'Runtime Complexity: TRS' => [
			'spaceid' => 426182,
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
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
		'Runtime Complexity: TRS Innermost' => [
			'spaceid' => 426027,
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
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
