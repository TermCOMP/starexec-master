<?php
$competition = [
	"name" => "Termination Competition 2020",
	"mcats" => [
		"Termination of Rewriting" => [
			'TRS Standard' => [
				'type' => 'termination',
				'jobid' => 41206,
				'spaceid' => 426103,
				'parts' => [
					348357,//NTI
					350520,//NaTT
					360055,//TTT2
					360174,//AProVE
					326595,//MuTerm
				],
			],
			'TRS Standard Certified' => [
				'type' => 'termination',
				'jobid' => 41230,
				'spaceid' => 426103,
				'certified' => true,
				'parts' => [
					360056,//TTT2
					360177,//AProVE
					360199,//NaTT
				]
			],
			'SRS Standard' => [
				'type' => 'termination',
				'jobid' => 41210,
				'spaceid' => 426158,
				'parts' => [
					326595,//MuTerm
					350520,//NaTT
					360055,//TTT2
					360160,//matchbox
					360174,//AProVE
					360181,//MnM
				]
			],
			'SRS Standard Certified' => [
				'type' => 'termination',
				'jobid' => 41232,
				'spaceid' => 426158,
				'parts' => [
					360056,//TTT2
					360177,//AProVE
					360199,//NaTT
				]
			],
			'TRS Relative' => [
				'type' => 'termination',
				'jobid' => 41208,
				'spaceid' => 426233,
				'parts' => [
					350520,//NaTT
					360055,//TTT2
					360174,//AProVE
				]
			],
			'TRS Relative Certified' => [
				'type' => 'termination',
				'jobid' =>  41231,
				'spaceid' => 426233,
				'parts' => [
					360056,//TTT2
					360177,//AProVE
				]
			],
			'SRS Relative' => [
				'type' => 'termination',
				'jobid' =>  41209,
				'spaceid' => 426149,
				'parts' => [
					350520,//NaTT
					360055,//TTT2
					360160,//matchbox
					360174,//AProVE
					360181,//MnM
				]
			],
			'SRS Relative Certified' => [
				'type' => 'termination',
				'jobid' =>  41233,
				'spaceid' => 426149,
			    'parts' => [
					360056,//TTT2
					360177,//AProVE
				]
			],
			'TRS Equational' => [
				'type' => 'termination',
				'jobid' =>  41213,
				'spaceid' => 426058,
				'parts' => [
					163986,//MuTerm
					350520,//NaTT
					360174,//AProVE
				]
			],
			'TRS Equational Certified' => [
				'type' => 'termination',
				'jobid' =>  41234,
				'spaceid' => 426058,
				'parts' => [
					360177,//AProVE
					360199,//NaTT
				]
			],
			'TRS Conditional' => [
				'type' => 'termination',
				'jobid' =>  41211,
				'spaceid' => 426154,
				'parts' => [
					326595,//MuTerm
					360174,//AProVE
				],
			],
			'TRS Context Sensitive' => [
				'type' => 'termination',
				'jobid' =>  41212,
				'spaceid' => 426022,
				'parts' => [
					163986,//MuTerm
					360174,//AProVE
				]
			],
			'TRS Innermost' => [
				'type' => 'termination',
				'jobid' =>  41214,
				'spaceid' => 425946,
				'parts' => [
					326595,//MuTerm
					360174,//AProVE
				]
			],
			'HRS (union beta)' => [
				'type' => 'termination',
				'jobid' =>  41215,
				'spaceid' => 426140,
				'parts' => [
					325830,//SizeChangeTool
					359682,//Wanda
				]
			],
		],
	 	"Termination of Programs" => [
			'C' => [
				'type' => 'termination',
				'jobid' =>  41216,
				'spaceid' => 426173,
				'parts' => [
					360173,//AProVE
					326627,//Ultimate
				]
			],
			'C Integer' => [
				'type' => 'termination',
				'jobid' =>  41217,
				'spaceid' => 426063,
				'parts' => [
					326627,//Ultimate
					359564,//irankfinder
					360173,//AProVE
				]
			],
			'Integer Transition Systems' => [
				'type' => 'termination',
				'jobid' =>  41219,
				'spaceid' => 425924,
				'parts' => [
					23757,//Ctrl
					359564,//irankfinder
					360195,//LoAT
				]
			],
			'Integer TRS Innermost' => [
				'type' => 'termination',
				'jobid' =>  41220,
				'spaceid' => 425939,
				'parts' => [
					23758,//Ctrl
					360174,//AProVE
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
				'jobid' =>  41218,
				'spaceid' => 425993,
				'parts' => [
					348357,//NTI
					360174,//AProVE
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
				'jobid' => 41221,
				'parts' => [
				]
			],
			'Derivational_Complexity: TRS Innermost' => [
				'spaceid' => 425864,
				'type' => 'complexity',
				'jobid' => 41222,
				'parts' => [
				]
			],
			'Runtime_Complexity: TRS' => [
				'spaceid' => 426182,
				'type' => 'complexity',
				'jobid' =>  41223,
				'parts' => [
				]
			],
			'Runtime_Complexity: TRS Innermost' => [
				'spaceid' => 426027,
				'type' => 'complexity',
				'jobid' =>  41224,
				'parts' => [
				]
			],
		],
	],
];
?>