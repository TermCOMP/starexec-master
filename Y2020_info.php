<h1>Termination Competition 2020 (Final)</h1>
The initial result is <a href="https://termcomp.github.io/Y2020-1/">here</a>.

<?php
$competition = [
	"name" => "TermComp 2020",
	"mcats" => [
		"Termination of Rewriting" => [
			'TRS Standard' => [
				'type' => 'termination',
//				'jobid' => 41206,
				'spaceid' => 426103,
				'parts' => [
					"NTI" => 348357,
					"NaTT" => 350520,
					"TTT2" => 360055,
					"AProVE" => 360174,
					"MuTerm" => 326595,
				],
			],
			'TRS Standard Certified' => [
				'type' => 'termination',
//				'jobid' => 41230,
				'spaceid' => 426103,
				'certified' => true,
				'parts' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
					"NaTT" => 360199,
				]
			],
			'SRS Standard' => [
				'type' => 'termination',
//				'jobid' => 41210,
				'spaceid' => 426158,
				'parts' => [
					"MuTerm" => 326595,
					"NaTT" => 350520,
					"TTT2" => 360055,
					"matchbox" => 360336,
					"AProVE" => 360174,
					"MnM" => 360181,
				]
			],
			'SRS Standard Certified' => [
				'type' => 'termination',
//				'jobid' => 41232,
				'spaceid' => 426158,
				'certified' => true,
				'parts' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
					"NaTT" => 360199,
				]
			],
			'TRS Relative' => [
				'type' => 'termination',
//				'jobid' => 41208,
				'spaceid' => 426233,
				'parts' => [
					"NaTT" => 350520,
					"TTT2" => 360055,
					"AProVE" => 360174,
				]
			],
			'TRS Relative Certified' => [
				'type' => 'termination',
//				'jobid' =>  41231,
				'spaceid' => 426233,
				'certified' => true,
				'parts' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
				]
			],
			'SRS Relative' => [
				'type' => 'termination',
//				'jobid' =>  41209,
				'spaceid' => 426149,
				'parts' => [
					"NaTT" => 350520,
					"TTT2" => 360055,
					"matchbox" => 360337,
					"AProVE" => 360174,
					"MnM" => 360181,
				]
			],
			'SRS Relative Certified' => [
				'type' => 'termination',
//				'jobid' =>  41233,
				'spaceid' => 426149,
				'certified' => true,
			    'parts' => [
					"TTT2" => 360056,
					"AProVE" => 360177,
				]
			],
			'TRS Equational' => [
				'type' => 'termination',
//				'jobid' =>  41213,
				'spaceid' => 426058,
				'parts' => [
					"MuTerm" => 163986,
					"NaTT" => 350520,
					"AProVE" => 360174,
				]
			],
			'TRS Equational Certified' => [
				'type' => 'termination',
//				'jobid' =>  41234,
				'spaceid' => 426058,
				'certified' => true,
				'parts' => [
					"AProVE" => 360177,
					"NaTT" => 360199,
				]
			],
			'TRS Conditional' => [
				'type' => 'termination',
//				'jobid' =>  41211,
				'spaceid' => 426154,
				'parts' => [
					"MuTerm" => 326595,
					"AProVE" => 360174,
				],
			],
			'TRS Context Sensitive' => [
				'type' => 'termination',
//				'jobid' =>  41212,
				'spaceid' => 426022,
				'parts' => [
					"MuTerm" => 163986,
					"AProVE" => 360174,
				]
			],
			'TRS Innermost' => [
				'type' => 'termination',
//				'jobid' =>  41214,
				'spaceid' => 425946,
				'parts' => [
					"MuTerm" => 326595,
					"AProVE" => 360174,
				]
			],
			'HRS (union beta)' => [
				'type' => 'termination',
//				'jobid' =>  41215,
				'spaceid' => 426140,
				'parts' => [
					"SizeChangeTool" => 325830,
					"Wanda" => 359682,
				]
			],
		],
	 	"Termination of Programs" => [
			'C' => [
				'type' => 'termination',
//				'jobid' =>  41216,
				'spaceid' => 426173,
				'parts' => [
					"AProVE" => 360173,
					"Ultimate" => 326627,
				]
			],
			'C Integer' => [
				'type' => 'termination',
//				'jobid' =>  41217,
				'spaceid' => 426063,
				'parts' => [
					"Ultimate" => 326627,
					"irankfinder" => 359564,
					"AProVE" => 360173,
				]
			],
			'Integer Transition Systems' => [
				'type' => 'termination',
//				'jobid' =>  41219,
				'spaceid' => 425924,
				'parts' => [
					"Ctrl" => 23757,
					"irankfinder" => 359564,
					"LoAT" => 360195,
				]
			],
			'Integer TRS Innermost' => [
				'type' => 'termination',
//				'jobid' =>  41220,
				'spaceid' => 425939,
				'parts' => [
					"Ctrl" => 23758,
					"AProVE" => 360174,
				]
			],
            'Haskell' => [
                'spaceid' => 425990,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ]
			],
            'Java_Bytecode' => [
                'spaceid' => 425927,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ]
            ],
            'Java_Bytecode_Recursive' => [
                'spaceid' => 426004,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ]
            ],
			'Logic Programming' => [
				'type' => 'termination',
//				'jobid' =>  41218,
				'spaceid' => 425993,
				'parts' => [
					"NTI" => 348357,
					"AProVE" => 360174,
				]
			],
            'Logic_Programming_with_Cut' => [
                'spaceid' => 425941,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ]
            ],
            'Prolog' => [
                'spaceid' => 425912,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ]
            ],
		],
		"Complexity Analysis" => [
			'Complexity: C_Integer' => [
				'spaceid' => 426011,
				'type' => 'complexity',
				'jobid' => false,
				'parts' => [
				]
			],
			'Complexity: ITS' => [
				'spaceid' => 426066,
				'type' => 'complexity',
				'jobid' => false,
				'parts' => [
				]
			],
			'Derivational_Complexity: TRS' => [
				'spaceid' => 425952,
				'type' => 'complexity',
//				'jobid' => 41221,
				'parts' => [
				]
			],
			'Derivational_Complexity: TRS Innermost' => [
				'spaceid' => 425864,
				'type' => 'complexity',
//				'jobid' => 41222,
				'parts' => [
				]
			],
			'Runtime_Complexity: TRS' => [
				'spaceid' => 426182,
				'type' => 'complexity',
//				'jobid' =>  41223,
				'parts' => [
				]
			],
			'Runtime_Complexity: TRS Innermost' => [
				'spaceid' => 426027,
				'type' => 'complexity',
//				'jobid' =>  41224,
				'parts' => [
				]
			],
		],
	],
];
?>