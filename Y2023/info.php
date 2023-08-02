<?php
$title = 'Termination Competition 2023';
$shortname = 'TermCOMP 2023';
$showconfig = true;
$showscore = false;
$note = '';
$db = 'TPDB 11.3';
$closed = false;// make true when registration is closed.
$previous = 'Y2022';

$categories = [
		'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => 466107,
			'id' => null,
			'participants' => [
				'NTI' => 741723,
//				'NaTT' => 671548,
//				'TTT2' => 552234,
				'AProVE' => 748141,
//				'MuTerm' => 326595,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TTT2' => 552235,
					'AProVE' => 748138,
//					'NaTT' => 552278,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 466081,
			'id' => null,
			'participants' => [
//				'MuTerm' => 326595,
//				'NaTT' => 671548,
//				'TTT2' => 552234,
//				'matchbox' => 671247,
				'AProVE' => 748141,
//				'MnM' => 671271,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TTT2' => 552235,
					'AProVE' => 748138,
//					'NaTT' => 552278,
//					'matchbox' => 671248,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 466103,
			'id' => null,
			'participants' => [
//				'NaTT' => 671548,
//				'TTT2' => 552234,
				'AProVE' => 748141,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TTT2' => 552235,
					'AProVE' => 748138,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 466194,
			'id' => null,
			'participants' => [
//				'NaTT' => 671548,
//				'TTT2' => 552234,
//				'matchbox' => 550934,
				'AProVE' => 748141,
//				'MnM' => 671271,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TTT2' => 552235,
					'AProVE' => 748138,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 466098,
			'id' => null,
			'participants' => [
//				'MuTerm' => 163986,
//				'NaTT' => 671548,
				'AProVE' => 748141,
			],
			'certified' => [
				'id' => null,
				'participants' => [
  					'AProVE' => 748138,
//					'NaTT' => 552357,
				],
			],
		],
		'TRS Conditional - Operational Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 531912,
			'id' => null,
			'participants' => [
				'AProVE' => 748141,
//				'MuTerm' => 671245,
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
			'id' => null,
			'note' => 'http://zenon.dsic.upv.es/muterm/benchmarks/ot-vs-t-20220721/benchmarks.html',
			'participants' => [
//				'MuTerm' => 671244,
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
			'id' => null,
			'participants' => [
				'AProVE' => 748141,
//				'MuTerm' => 163986,
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
			'id' => null,
			'participants' => [
				'AProVE' => 748141,
//				'MuTerm' => 326595,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					'AProVE' => 748138,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => 466242,
			'id' => null,
			'participants' => [
				'AProVE' => 748141,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					'AProVE' => 748138,
				],
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 531842,
			'id' => null,
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
			'id' => null,
			'participants' => [
//				'AProVE' => 671179,
//				'Ultimate' => 671700,
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
			'id' => null,
			'participants' => [
//				'Ultimate' => 671700,
//				'iRankFinder' => 360226,
//				'AProVE' => 671179,
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
			'id' => null,
			'participants' => [
//				'iRankFinder' => 360226,
				'LoAT' => 744508,
				'KoAT' => 747951, // We disabled control-flow refinement by iRankFinder in this category.
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
			'id' => null,
			'participants' => [
				'AProVE' => 742587,
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
			'id' => null,
			'participants' => [
  				'AProVE' => 742587,
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
			'id' => null,
			'participants' => [
//				'AProVE' => 551423,
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
			'id' => null,
			'participants' => [
//				'AProVE' => 551423,
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
			'spaceid' => 531900,
			'id' => null,
			'participants' => [
				'NTI+cTI' => 748115,
  				'AProVE' => 742587,
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
			'id' => null,
			'participants' => [
  				'AProVE' => 742587,
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
			'id' => null,
			'participants' => [
  				'AProVE' => 742587,
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
			'spaceid' => 531830,
			'id' => null,
			'participants' => [
				'KoAT' => 747955,
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
			'spaceid' => 531862,
			'id' => null,
			'participants' => [
				'KoAT & LoAT' => 747959,
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
			'id' => null,
			'participants' => [
//				'TcT' => 360388,
//				'AProVE' => 551421,
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
			'id' => null,
			'participants' => [
//				'TcT' => 360385,
//				'AProVE' => 551421,
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
			'id' => null,
			'participants' => [
//				'TcT' => 360390,
//				'AProVE' => 551428,
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
			'id' => null,
			'participants' => [
//				'TcT' => 360386,
//				'AProVE' => 551428,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => 360384,
//					'AProVE' => 552179,
				],
			],
		],
		'Runtime Complexity: TRS Parallel Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'previous' => null,
			'spaceid' => 466379,
			'id' => null,
			'participants' => [
//				'AProVE' => 671239,
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
