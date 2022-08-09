<?php
$title = 'Termination Competition 2022';
$shortname = 'TermCOMP 2022';
$showconfig = false;
$showscore = false;
$note = '';
$db = 'TPDB 11.3';
$closed = true;
$previous = 'Y2021';

$teams = [
	'AProVE+LoAT' => ['AProVE','LoAT'],
	'iRankFinder' => ['iRankFinder'],
	'Matchbox' => ['matchbox'],
	'MU-TERM' => ['MuTerm'],
	'MultumNonMulta' => ['MnM'],
	'NaTT' => ['NaTT'],
	'NTI+cTI' => ['NTI', 'NTI+cTI'],
	'SOL' => ['SOL'],
	'TTT2+TcT' => ['TTT2', 'TcT'],
	'Ultimate' => ['Ultimate'],
	'Wanda' => ['Wanda'],
];

$categories = [
		'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => 466107,
			'id' => 54200,
			'participants' => [
				'NTI' => 549724,
				'NaTT' => 671548,
				'TTT2' => 552234,
				'AProVE' => 551423,
				'MuTerm' => 326595,
			],
			'certified' => [
				'id' => 54199,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 552179,
					'NaTT' => 552278,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 466081,
			'id' => 54202,
			'participants' => [
				'MuTerm' => 326595,
				'NaTT' => 671548,
				'TTT2' => 552234,
				'matchbox' => 671247,
				'AProVE' => 551423,
				'MnM' => 671271,
			],
			'certified' => [
				'id' => 54201,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 552179,
					'NaTT' => 552278,
					'matchbox' => 671248,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 466103,
			'id' => 54195,
			'participants' => [
				'NaTT' => 671548,
				'TTT2' => 552234,
				'AProVE' => 551423,
			],
			'certified' => [
				'id' => 54196,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 552179,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 466194,
			'id' => 54198,
			'participants' => [
				'NaTT' => 671548,
				'TTT2' => 552234,
//				'matchbox' => 550934,
				'AProVE' => 551423,
				'MnM' => 671271,
			],
			'certified' => [
				'id' => 54197,
				'participants' => [
					'TTT2' => 552235,
					'AProVE' => 552179,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 466098,
			'id' => 54203,
			'participants' => [
				'MuTerm' => 163986,
				'NaTT' => 671548,
				'AProVE' => 551423,
			],
			'certified' => [
				'id' => 54204,
				'participants' => [
					'AProVE' => 552179,
//					'NaTT' => 552357,
				],
			],
		],
		'TRS Conditional - Operational Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'previous' => 'Y2021/TRS_Conditional.VBS.json',
			'spaceid' => 531912,
			'id' => 54205,
			'participants' => [
				'AProVE' => 551423,
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
			'previous' => null,
			'spaceid' => 531912,
			'id' => 54222,
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
			'id' => 54206,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54208,
			'participants' => [
				'AProVE' => 551423,
				'MuTerm' => 326595,
			],
			'certified' => [
				'id' => 54207,
				'participants' => [
					'AProVE' => 552179,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => 466242,
			'id' => 54209,
			'participants' => [
				'AProVE' => 551423,
			],
			'certified' => [
				'id' => 54210,
				'participants' => [
					'AProVE' => 552179,
				],
			],
		],
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 531842,
			'id' => 54227,
			'participants' => [
				'Wanda' => 359682,
				'SOL' => 671696,
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
			'id' => 54224,
			'participants' => [
				'AProVE' => 671179,
				'Ultimate' => 671700,
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
			'id' => 54225,
			'participants' => [
				'Ultimate' => 671700,
				'iRankFinder' => 360226,
				'AProVE' => 671179,
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
			'id' => 54213,
			'participants' => [
				'iRankFinder' => 360226,
				'LoAT' => 551398,
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
			'id' => 54233,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54237,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54234,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54235,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54212,
			'participants' => [
				'NTI+cTI' => 671372,
				'AProVE' => 551423,
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
			'id' => 54236,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54238,
			'participants' => [
				'AProVE' => 551423,
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
			'id' => 54241,
			'participants' => [
				'AProVE' => 671123,
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
			'id' => 54242,
			'participants' => [
				'AProVE' => 671224,
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
			'id' => 54215,
			'participants' => [
				'TcT' => 360388,
				'AProVE' => 551421,
			],
			'certified' => [
				'id' => 54214,
				'participants' => [
					'TcT' => 360387,
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'spaceid' => 466273,
			'id' => 54221,
			'participants' => [
				'TcT' => 360385,
				'AProVE' => 551421,
			],
			'certified' => [
				'id' => 54217,
				'participants' => [
					'TcT' => 360391,
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'spaceid' => 466246,
			'id' => 54218,
			'participants' => [
				'TcT' => 360390,
				'AProVE' => 551428,
			],
			'certified' => [
				'id' => 54216,
				'participants' => [
					'TcT' => 360389,
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'spaceid' => 466379,
			'id' => 54226,
			'participants' => [
				'TcT' => 360386,
				'AProVE' => 551428,
			],
			'certified' => [
				'id' => 54220,
				'participants' => [
					'TcT' => 360384,
					'AProVE' => 552179,
				],
			],
		],
		'Runtime Complexity: TRS Parallel Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'previous' => null,
			'spaceid' => 466379,
			'id' => 54223,
			'participants' => [
				'AProVE' => 671239,
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
