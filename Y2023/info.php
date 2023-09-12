<?php
$title = 'Termination Competition 2023';
$shortname = 'TermCOMP 2023';
$showconfig = true;
$showscore = false;
$note = '';
$db = 'TPDB 11.3';
$closed = true;// make true when registration is closed.
$previous = 'Y2022';

$categories = [
		'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => 548619,
			'id' => 60843,
			'participants' => [
				'NTI' => 741723,
				'NaTT' => 749415,
				'TTT2' => 552234,
				'AProVE' => 749005,
				'MuTerm' => 326595,
				'MnM' => 749295,
				'AutoNon' => 749524, // copy of: 24242
			],
			'certified' => [
				'id' => 60833,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 749011,
					'NaTT' => 552278,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 548673,
			'id' => 60841,
			'participants' => [
				'MuTerm' => 326595,
				'NaTT' => 749415,
				'TTT2' => 552234,
				'matchbox' => 748956,
				'AProVE' => 749005,
				'MnM' => 749269,
			],
			'certified' => [
				'id' => 60838,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 749011,
					'NaTT' => 552278,
					'matchbox' => 748957,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 466103,
			'id' => 60824,
			'participants' => [
				'NaTT' => 749415,
				'TTT2' => 552234,
				'AProVE' => 749005,
				'MnM' => 749295,
			],
			'certified' => [
				'id' => 60825,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 749011,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 548612,
			'id' => 60826,
			'participants' => [
				'NaTT' => 749415,
				'TTT2' => 552234,
				'matchbox' => 748956,
				'AProVE' => 749005,
				'MnM' => 749269,
			],
			'certified' => [
				'id' => 60834,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 749011,
					'matchbox' => 748957,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 466098,
			'id' => 60828,
			'participants' => [
				'MuTerm' => 163986,
				'NaTT' => 350520,
				'AProVE' => 749005,
			],
			'certified' => [
				'id' => 60827,
				'participants' => [
  					'AProVE' => 749011,
					'NaTT' => 360199,
				],
			],
		],
		'TRS Conditional - Operational Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 531912,
			'id' => 60830,
			'participants' => [
				'AProVE' => 749005,
				'MuTerm' => 671245,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Conditional - Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 531912,
			'id' => 60652,
			'note' => 'http://zenon.dsic.upv.es/muterm/benchmarks/ot-vs-t-20220721/benchmarks.html',
			'participants' => [
				'MuTerm' => 671244,
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
			'id' => 60829,
			'participants' => [
				'AProVE' => 749005,
				'MuTerm' => 163986,
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
			'id' => 60835,
			'participants' => [
				'AProVE' => 749005,
				'MuTerm' => 326595,
			],
			'certified' => [
				'id' => 60831,
				'participants' => [
					'AProVE' => 749011,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => 466242,
			'id' => 60832,
			'participants' => [
				'AProVE' => 749005,
			],
			'certified' => [
				'id' => 60836,
				'participants' => [
					'AProVE' => 749011,
				],
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 531842,
			'id' => 60901,
			'participants' => [
				'Wanda' => 359682,
//				'SOL' => 671696,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
	],
	'Termination of Programs' => [
		'C' => [
			'type' => 'termination',
			'dir' => 'C',
			'spaceid' => 531852,
			'id' => 60837,
			'participants' => [
				'AProVE' => 749009,
				'Ultimate' => 748941,
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
			'id' => 60839,
			'participants' => [
				'Ultimate' => 748941,
//				'iRankFinder' => 360226,
				'AProVE' => 748135,
				'MuVal' => 749230,
				'MuVal-RL' => 749463,
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
			'id' => 60845,
			'participants' => [
//				'iRankFinder' => 360226,
				'LoAT' => 747594,
				'KoAT' => 748986, // We disabled control-flow refinement by iRankFinder in this category.
				'MuVal' => 749209,
				'MuVal-RL' => 749466,
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
			'id' => 60902,
			'participants' => [
				'AProVE' => 749005,
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
			'id' => 60907,
			'participants' => [
  				'AProVE' => 749005,
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
			'id' => 60904,
			'participants' => [
				'AProVE' => 749005,
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
			'id' => 60905,
			'participants' => [
				'AProVE' => 749005,
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
			'spaceid' => 548660,
			'id' => 60840,
			'participants' => [
				'NTI+cTI' => 748843,
  				'AProVE' => 749005,
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
			'id' => 60906,
			'participants' => [
  				'AProVE' => 749005,
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
			'id' => 60908,
			'participants' => [
  				'AProVE' => 749005,
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
			'spaceid' => 548691,
			'id' => 60863,
			'participants' => [
				'KoAT' => 748989,
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
			'spaceid' => 548704,
			'id' => 60864,
			'participants' => [
				'KoAT & LoAT' => 748959,
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
			'id' => 60915,
			'participants' => [
//				'TcT' => 360388,
				'AProVE' => 749016,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => 360387,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'spaceid' => 466273,
			'id' => 60913,
			'participants' => [
//				'TcT' => 360385,
				'AProVE' => 749016,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => 360391,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'spaceid' => 466246,
			'id' => 60911,
			'participants' => [
//				'TcT' => 360390,
				'AProVE' => 749008,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => 360389,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'spaceid' => 466379,
			'id' => 60916,
			'participants' => [
//				'TcT' => 360386,
				'AProVE' => 749008,
			],
			'certified' => [
				'id' => 60917,
				'participants' => [
//					'TcT' => 360384,
					'AProVE' => 749011,
				],
			],
		],
		'Runtime Complexity: TRS Parallel Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'previous' => null,
			'spaceid' => 466379,
			'id' => 60912,
			'participants' => [
				'AProVE' => 749014,
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
