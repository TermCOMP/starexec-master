<?php
$title = 'Termination Competition 2024';
$shortname = 'TermCOMP 2024';
$showconfig = true;
$showscore = true;
$note = '';
$db = 'TPDB 11.4';
$closed = false;// make true when registration is closed.
$previous = 'Y2023';

$categories = [
		'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => 550469,
			'id' => 63347,
			'participants' => [
				// 'NTI' => null,
				// 'NaTT' => null,
				// 'TTT2' => null,
				'AProVE' => 782592
				// 'MuTerm' => null,
				// 'MnM' => null,
				// 'AutoNon' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					// 'TTT2' => null,
					// 'AProVE' => null,
					// 'NaTT' => null,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'MuTerm' => null,
				// 'NaTT' => null,
				// 'TTT2' => null,
				// 'matchbox' => null,
				// 'AProVE' => null,
				// 'MnM' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					// 'TTT2' => null,
					// 'AProVE' => null,
					// 'NaTT' => null,
					// 'matchbox' => null,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'NaTT' => null,
				// 'TTT2' => null,
				// 'AProVE' => null,
				// 'MnM' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					// 'TTT2' => null,
					// 'AProVE' => null,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'NaTT' => null,
				// 'TTT2' => null,
				// 'matchbox' => null,
				// 'AProVE' => null,
				// 'MnM' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					// 'TTT2' => null,
					// 'AProVE' => null,
					// 'matchbox' => null,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'MuTerm' => null,
				// 'NaTT' => null,
				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
  					// 'AProVE' => null,
					// 'NaTT' => null,
				],
			],
		],
		'TRS Conditional - Operational Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
				// 'MuTerm' => null,
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
			'spaceid' => null,
			'id' => null,
			'note' => 'http://zenon.dsic.upv.es/muterm/benchmarks/ot-vs-t-20220721/benchmarks.html',
			'participants' => [
				// 'MuTerm' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
				// 'MuTerm' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
				// 'MuTerm' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					// 'AProVE' => null,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
					// 'AProVE' => null,
				],
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'Wanda' => null,
//				'SOL' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
				// 'Ultimate' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
//				'iRankFinder' => null,
				// 'LoAT' => null,
				'KoAT' => 748986, // We disabled control-flow refinement by iRankFinder in this category.
				// 'MuVal' => null,
				// 'MuVal-RL' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
  				// 'AProVE' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'NTI+cTI' => null,
  				// 'AProVE' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
  				// 'AProVE' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
  				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
	],
	'Complexity Analysis' => [
		'Complexity: C' => [
			'type' => 'complexity',
			'dir' => 'Complexity_C_Integer',
			'spaceid' => null,
			'id' => null,
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
			'spaceid' => null,
			'id' => null,
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
			'spaceid' => null,
			'id' => null,
			'participants' => [
//				'TcT' => null,
				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => null,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'spaceid' => null,
			'id' => null,
			'participants' => [
//				'TcT' => null,
				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => null,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'spaceid' => null,
			'id' => null,
			'participants' => [
//				'TcT' => null,
				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => null,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'spaceid' => null,
			'id' => null,
			'participants' => [
//				'TcT' => null,
				// 'AProVE' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => null,
					// 'AProVE' => null,
				],
			],
		],
		'Runtime Complexity: TRS Parallel Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'previous' => null,
			'spaceid' => null,
			'id' => null,
			'participants' => [
				// 'AProVE' => null,
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
