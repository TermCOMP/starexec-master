<?php
$title = 'Termination Competition 2020 (First Run)';
$shortname = "TermCOMP 2020-1";
$raw_mcats = [
	"Termination of Rewriting" => [
		'TRS Standard' => [
			'type' => 'termination',
			'jobid' => 41206,
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
			'jobid' => 41230,
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
			'jobid' => 41210,
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
			'jobid' => 41232,
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
			'jobid' => 41208,
			'spaceid' => 426233,
			'participants' => [
				"NaTT" => 350520,
				"TTT2" => 360055,
				"AProVE" => 360174,
			]
		],
		'TRS Relative Certified' => [
			'type' => 'termination',
			'jobid' =>  41231,
			'spaceid' => 426233,
			'certified' => true,
			'participants' => [
				"TTT2" => 360056,
				"AProVE" => 360177,
			]
		],
		'SRS Relative' => [
			'type' => 'termination',
			'jobid' =>  41209,
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
			'jobid' =>  41233,
			'spaceid' => 426149,
			'certified' => true,
			'participants' => [
				"TTT2" => 360056,
				"AProVE" => 360177,
			]
		],
		'TRS Equational' => [
			'type' => 'termination',
			'jobid' =>  41213,
			'spaceid' => 426058,
			'participants' => [
				"MuTerm" => 163986,
				"NaTT" => 350520,
				"AProVE" => 360174,
			]
		],
		'TRS Equational Certified' => [
			'type' => 'termination',
			'jobid' =>  41234,
			'spaceid' => 426058,
			'certified' => true,
			'participants' => [
				"AProVE" => 360177,
				"NaTT" => 360199,
			]
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'jobid' =>  41211,
			'spaceid' => 426154,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'jobid' =>  41212,
			'spaceid' => 426022,
			'participants' => [
				"MuTerm" => 163986,
				"AProVE" => 360174,
			]
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'jobid' =>  41214,
			'spaceid' => 425946,
			'participants' => [
				"MuTerm" => 326595,
				"AProVE" => 360174,
			]
		],
		'HRS (union beta)' => [
			'type' => 'termination',
			'jobid' =>  41215,
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
			'jobid' =>  41216,
			'spaceid' => 426173,
			'participants' => [
				"AProVE" => 360173,
				"Ultimate" => 326627,
			]
		],
		'C Integer' => [
			'type' => 'termination',
			'jobid' =>  41217,
			'spaceid' => 426063,
			'participants' => [
				"Ultimate" => 326627,
				"irankfinder" => 359564,
				"AProVE" => 360173,
			]
		],
		'Integer Transition Systems' => [
			'type' => 'termination',
			'jobid' =>  41219,
			'spaceid' => 425924,
			'participants' => [
				"Ctrl" => 23757,
				"irankfinder" => 359564,
				"LoAT" => 360195,
			]
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'jobid' =>  41220,
			'spaceid' => 425939,
			'participants' => [
				"Ctrl" => 23758,
				"AProVE" => 360174,
			]
		],
		'Haskell' => [
			'spaceid' => 425990,
			'type' => 'termination',
			'jobid' => false,
			'participants' => [
			]
		],
		'Java_Bytecode' => [
			'spaceid' => 425927,
			'type' => 'termination',
			'jobid' => false,
			'participants' => [
			]
		],
		'Java_Bytecode_Recursive' => [
			'spaceid' => 426004,
			'type' => 'termination',
			'jobid' => false,
			'participants' => [
			]
		],
		'Logic Programming' => [
			'type' => 'termination',
			'jobid' =>  41218,
			'spaceid' => 425993,
			'participants' => [
				"NTI" => 348357,
				"AProVE" => 360174,
			]
		],
		'Logic_Programming_with_Cut' => [
			'spaceid' => 425941,
			'type' => 'termination',
			'jobid' => false,
			'participants' => [
			]
		],
		'Prolog' => [
			'spaceid' => 425912,
			'type' => 'termination',
			'jobid' => false,
			'participants' => [
			]
		],
	],
	"Complexity Analysis" => [
		'Complexity: C_Integer' => [
			'spaceid' => 426011,
			'type' => 'complexity',
			'jobid' => false,
			'participants' => [
			]
		],
		'Complexity: ITS' => [
			'spaceid' => 426066,
			'type' => 'complexity',
			'jobid' => false,
			'participants' => [
			]
		],
		'Derivational_Complexity: TRS' => [
			'spaceid' => 425952,
			'type' => 'complexity',
			'jobid' => 41221,
			'participants' => [
			]
		],
		'Derivational_Complexity: TRS Innermost' => [
			'spaceid' => 425864,
			'type' => 'complexity',
			'jobid' => 41222,
			'participants' => [
			]
		],
		'Runtime_Complexity: TRS' => [
			'spaceid' => 426182,
			'type' => 'complexity',
			'jobid' =>  41223,
			'participants' => [
			]
		],
		'Runtime_Complexity: TRS Innermost' => [
			'spaceid' => 426027,
			'type' => 'complexity',
			'jobid' =>  41224,
			'participants' => [
			]
		],
	],
];
?>