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
			'id' => 60641,
			'participants' => [
				'NTI' => 741723,
				'NaTT' => 671548,
				'TTT2' => 552234,
				'AProVE' => 748141,
				'MuTerm' => 326595,
				'MnM' => 748281,
			],
			'certified' => [
				'id' => 60642,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 748138,
					'NaTT' => 552278,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 548673,
			'id' => 60661,
			'participants' => [
				'MuTerm' => 326595,
				'NaTT' => 671548,
				'TTT2' => 552234,
				'matchbox' => 748264,
				'AProVE' => 748141,
				'MnM' => 748265,
			],
			'certified' => [
				'id' => 60650,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 748138,
					'NaTT' => 552278,
					'matchbox' => 748831,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 466103,
			'id' => 60643,
			'participants' => [
				'NaTT' => 671548,
				'TTT2' => 552234,
				'AProVE' => 748141,
				'MnM' => 748281,
			],
			'certified' => [
				'id' => 60644,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 748138,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 548612,
			'id' => 60648,
			'participants' => [
				'NaTT' => 671548,
				'TTT2' => 552234,
				'matchbox' => 748264,
				'AProVE' => 748141,
				'MnM' => 748265,
			],
			'certified' => [
				'id' => 60645,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 748138,
					'matchbox' => 748831,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 466098,
			'id' => 60646,
			'participants' => [
				'MuTerm' => 163986,
				'NaTT' => 350520,
				'AProVE' => 748141,
			],
			'certified' => [
				'id' => 60647,
				'participants' => [
  					'AProVE' => 748138,
					'NaTT' => 360199,
				],
			],
		],
		'TRS Conditional - Operational Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 531912,
			'id' => 60649,
			'participants' => [
				'AProVE' => 748141,
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
			'id' => 60651,
			'participants' => [
				'AProVE' => 748141,
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
			'id' => 60655,
			'participants' => [
				'AProVE' => 748141,
				'MuTerm' => 326595,
			],
			'certified' => [
				'id' => 60658,
				'participants' => [
					'AProVE' => 748138,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => 466242,
			'id' => 60654,
			'participants' => [
				'AProVE' => 748141,
			],
			'certified' => [
				'id' => 60656,
				'participants' => [
					'AProVE' => 748138,
				],
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 531842,
			'id' => 60657,
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
			'id' => 60659,
			'participants' => [
				'AProVE' => 748135,
				'Ultimate' => 748316,
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
			'id' => 60660,
			'participants' => [
				'Ultimate' => 748316,
//				'iRankFinder' => 360226,
				'AProVE' => 748135,
				'MuVal' => 748241,
				'MuVal-RL' => 748315,
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
			'id' => 60693,
			'participants' => [
//				'iRankFinder' => 360226,
				'LoAT' => 744508,
				'KoAT' => 747951, // We disabled control-flow refinement by iRankFinder in this category.
				'MuVal' => 748257,
				'MuVal-RL' => 748314,
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
				'AProVE' => 748141,
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
				'AProVE' => 748141,
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
			'id' => 60662,
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
			'spaceid' => 548691,
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
			'spaceid' => 548704,
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
				'AProVE' => 748136,
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
				'AProVE' => 748136,
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
				'AProVE' => 748133,
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
				'AProVE' => 748133,
			],
			'certified' => [
				'id' => null,
				'participants' => [
//					'TcT' => 360384,
					'AProVE' => 748138,
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
				'AProVE' => 748137,
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
