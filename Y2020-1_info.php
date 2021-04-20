<?php
$title = 'Termination Competition 2020 (First Run)';
$shortname = "TermCOMP 2020-1";
$note = 'The final result is <a href=\"https://termcomp.github.io/Y2020/\">here</a>.';
$tpdbver = '11.1';
$categories = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'id' => 41206,
			'spaceid' => 426103,
			'participants' => [
				"NTI" => 348357,
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
				"MuTerm" => 326595,
			],
		],
		'TRS Standard Certified' => [
			'type' => 'termination',
			'id' => 41230,
			'spaceid' => 426103,
			'certified' => true,
			'participants' => [
				"TTT2" => 360056,
				"AProVE" => 360177,
				"NaTT" => 360199,
			]
		],
		'SRS Standard' => [
			'type' => 'termination',
			'id' => 41210,
			'spaceid' => 426158,
			'participants' => [
				"MuTerm" => 326595,
				"NaTT" => 350520,
				"TTT2" => 360055,
				"matchbox" => 360160,
				"AProVE" => 360174,
				"MnM" => 360181,
			]
		],
		'SRS Standard Certified' => [
			'type' => 'termination',
			'id' => 41232,
			'spaceid' => 426158,
			'certified' => true,
			'participants' => [
				"TTT2" => 360056,
				"AProVE" => 360177,
				"NaTT" => 360199,
			]
		],
		'TRS Relative' => [
			'type' => 'termination',
			'id' => 41208,
			'spaceid' => 426233,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
			]
		],
		'TRS Relative Certified' => [
			'type' => 'termination',
			'id' =>  41231,
			'spaceid' => 426233,
			'certified' => true,
			'participants' => [
				"TTT2" => 360056,
				"AProVE" => 360177,
			]
		],
		'SRS Relative' => [
			'type' => 'termination',
			'id' =>  41209,
			'spaceid' => 426149,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"matchbox" => 360160,
				"AProVE" => 360174,
				"MnM" => 360181,
			]
		],
		'SRS Relative Certified' => [
			'type' => 'termination',
			'id' =>  41233,
			'spaceid' => 426149,
			'certified' => true,
			'participants' => [
				"TTT2" => 360056,
				"AProVE" => 360177,
			]
		],
		'TRS Equational' => [
			'type' => 'termination',
			'id' =>  41213,
			'spaceid' => 426058,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 360174,
			]
		],
		'TRS Equational Certified' => [
			'type' => 'termination',
			'id' =>  41234,
			'spaceid' => 426058,
			'certified' => true,
			'participants' => [
				"AProVE" => 360177,
				"NaTT" => 360199,
			]
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'id' =>  41211,
			'spaceid' => 426154,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'id' =>  41212,
			'spaceid' => 426022,
			'participants' => [
				"MuTerm" => 163986,
				"AProVE" => 360174,
			]
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'id' =>  41214,
			'spaceid' => 425946,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			]
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'id' =>  41215,
			'spaceid' => 426140,
			'participants' => [
				"SizeChangeTool" => 325830,
				"Wanda" => 359682,
			]
		],
	],
	"Termination of Programs" => [
		'C' => [
			'type' => 'termination',
			'id' =>  41216,
			'spaceid' => 426173,
			'participants' => [
				"AProVE" => 360173,
				"Ultimate" => 326627,
			]
		],
		'C Integer' => [
			'type' => 'termination',
			'id' =>  41217,
			'spaceid' => 426063,
			'participants' => [
				"Ultimate" => 326627,
				"irankfinder" => 359564,
				"AProVE" => 360173,
			]
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'id' =>  41219,
			'spaceid' => 425924,
			'participants' => [
				"Ctrl" => 23757,
				"irankfinder" => 359564,
				"LoAT" => 360195,
			]
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'id' =>  41220,
			'spaceid' => 425939,
			'participants' => [
				"Ctrl" => 23758,
				"AProVE" => 360174,
			]
		],
		'Haskell' => [
			'spaceid' => 425990,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			]
		],
		'Java_Bytecode' => [
			'spaceid' => 425927,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			]
		],
		'Java_Bytecode_Recursive' => [
			'spaceid' => 426004,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			]
		],
		'Logic Programming' => [
			'type' => 'termination',
			'id' =>  41218,
			'spaceid' => 425993,
			'participants' => [
				"NTI" => 348357,
				"AProVE" => 360174,
			]
		],
		'Logic_Programming_with_Cut' => [
			'spaceid' => 425941,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			]
		],
		'Prolog' => [
			'spaceid' => 425912,
			'type' => 'termination',
			'id' => false,
			'participants' => [
			]
		],
	],
	"Complexity Analysis" => [
		'Complexity: C_Integer' => [
			'spaceid' => 426011,
			'type' => 'complexity',
			'id' => false,
			'participants' => [
			]
		],
		'Complexity: ITS' => [
			'spaceid' => 426066,
			'type' => 'complexity',
			'id' => false,
			'participants' => [
			]
		],
		'Derivational_Complexity: TRS' => [
			'spaceid' => 425952,
			'type' => 'complexity',
			'id' => 41221,
			'participants' => [
			]
		],
		'Derivational_Complexity: TRS Innermost' => [
			'spaceid' => 425864,
			'type' => 'complexity',
			'id' => 41222,
			'participants' => [
			]
		],
		'Runtime_Complexity: TRS' => [
			'spaceid' => 426182,
			'type' => 'complexity',
			'id' =>  41223,
			'participants' => [
			]
		],
		'Runtime_Complexity: TRS Innermost' => [
			'spaceid' => 426027,
			'type' => 'complexity',
			'id' =>  41224,
			'participants' => [
			]
		],
	],
];
?>