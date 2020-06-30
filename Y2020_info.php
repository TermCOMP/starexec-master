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
					"NTI" => 360349,
					"NaTT" => 350520,
					"TTT2" => 360055,
					"AProVE" => 360174,
					"MuTerm" => 326595,
				],
				'certified' => [
//					jobid' => 41230,
					'parts' => [
						"TTT2" => 360056,
						"AProVE" => 360177,
						"NaTT" => 360199,
					],
				],
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
					"MnM" => 360367,
				],
				'certified' => [
//					'jobid' => 41232,
					'parts' => [
						"TTT2" => 360056,
						"AProVE" => 360177,
						"NaTT" => 360199,
					],
				],
			],
			'TRS Relative' => [
				'type' => 'termination',
//				'jobid' => 41208,
				'spaceid' => 426233,
				'parts' => [
					"NaTT" => 350520,
					"TTT2" => 360055,
					"AProVE" => 360174,
				],
				'certified' => [
//					'jobid' =>  41231,
					'parts' => [
						"TTT2" => 360056,
						"AProVE" => 360177,
					],
				],
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
					"MnM" => 360367,
				],
				'certified' => [
//					'jobid' =>  41233,
				    'parts' => [
						"TTT2" => 360056,
						"AProVE" => 360177,
					],
				],
			],
			'TRS Equational' => [
				'type' => 'termination',
//				'jobid' =>  41213,
				'spaceid' => 426058,
				'parts' => [
					"MuTerm" => 163986,
					"NaTT" => 350520,
					"AProVE" => 360174,
				],
				'certified' => [
					'parts' => [
						"AProVE" => 360177,
						"NaTT" => 360199,
					],
				],
			],
			'TRS Conditional' => [
				'type' => 'termination',
//				'jobid' =>  41211,
				'spaceid' => 426154,
				'parts' => [
					"MuTerm" => 326595,
					"AProVE" => 360174,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'TRS Context Sensitive' => [
				'type' => 'termination',
//				'jobid' =>  41212,
				'spaceid' => 426022,
				'parts' => [
					"MuTerm" => 163986,
					"AProVE" => 360174,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'TRS Innermost' => [
				'type' => 'termination',
//				'jobid' =>  41214,
				'spaceid' => 425946,
				'parts' => [
					"MuTerm" => 326595,
					"AProVE" => 360174,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'HRS (union beta)' => [
				'type' => 'termination',
//				'jobid' =>  41215,
				'spaceid' => 426140,
				'parts' => [
					"SizeChangeTool" => 325830,
					"Wanda" => 359682,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
		],
	 	"Termination of Programs" => [
			'C' => [
				'type' => 'termination',
//				'jobid' =>  41216,
				'spaceid' => 426173,
				'parts' => [
					"AProVE" => 360173,
					"Ultimate" => 360394,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'C Integer' => [
				'type' => 'termination',
//				'jobid' =>  41217,
				'spaceid' => 426063,
				'parts' => [
					"Ultimate" => 360394,
					"iRankFinder" => 360226,
					"AProVE" => 360173,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'Integer Transition Systems' => [
				'type' => 'termination',
//				'jobid' =>  41219,
				'spaceid' => 425924,
				'parts' => [
					"Ctrl" => 23757,
					"iRankFinder" => 360226,
					"LoAT" => 360195,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'Integer TRS Innermost' => [
				'type' => 'termination',
//				'jobid' =>  41220,
				'spaceid' => 425939,
				'parts' => [
					"Ctrl" => 23758,
					"AProVE" => 360174,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
            'Haskell' => [
                'spaceid' => 425990,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ],
				'certified' => [
					'parts' => [
					],
				],
			],
            'Java_Bytecode' => [
                'spaceid' => 425927,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ],
				'certified' => [
					'parts' => [
					],
				],
            ],
            'Java_Bytecode_Recursive' => [
                'spaceid' => 426004,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ],
				'certified' => [
					'parts' => [
					],
				],
            ],
			'Logic Programming' => [
				'type' => 'termination',
//				'jobid' =>  41218,
				'spaceid' => 425993,
				'parts' => [
					"NTI" => 360349,
					"AProVE" => 360174,
				],
				'certified' => [
					'parts' => [
					],
				],
			],
            'Logic_Programming_with_Cut' => [
                'spaceid' => 425941,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ],
				'certified' => [
					'parts' => [
					],
				],
            ],
            'Prolog' => [
                'spaceid' => 425912,
                'type' => 'termination',
                'jobid' => false,
                'parts' => [
                ],
				'certified' => [
					'parts' => [
					],
				],
            ],
		],
		"Complexity Analysis" => [
			'Complexity: C_Integer' => [
				'spaceid' => 426011,
				'type' => 'complexity',
				'jobid' => false,
				'parts' => [
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'Complexity: ITS' => [
				'spaceid' => 426066,
				'type' => 'complexity',
				'jobid' => false,
				'parts' => [
				],
				'certified' => [
					'parts' => [
					],
				],
			],
			'Derivational_Complexity: TRS' => [
				'spaceid' => 425952,
				'type' => 'complexity',
//				'jobid' => 41221,
				'parts' => [
                                        "TcT" => 360388,
				],
				'certified' => [
					'parts' => [
                                                "TcT" => 360387,
					],
				],
			],
			'Derivational_Complexity: TRS Innermost' => [
				'spaceid' => 425864,
				'type' => 'complexity',
//				'jobid' => 41222,
				'parts' => [
                                        "TcT" => 360385,
				],
				'certified' => [
					'parts' => [
                                                "TcT" => 360391,
					],
				],
			],
			'Runtime_Complexity: TRS' => [
				'spaceid' => 426182,
				'type' => 'complexity',
//				'jobid' =>  41223,
				'parts' => [
                                        "TcT" => 360390,
				],
				'certified' => [
					'parts' => [
                                                "TcT" => 360389,
					],
				],
			],
			'Runtime_Complexity: TRS Innermost' => [
				'spaceid' => 426027,
				'type' => 'complexity',
//				'jobid' =>  41224,
				'parts' => [
                                        "TcT" => 360386,
				],
				'certified' => [
					'parts' => [
                                                "TcT" => 360384,
					],
				],
			],
		],
	],
];
?>
