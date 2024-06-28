<?php
$title = 'Termination Competition 2024';
$shortname = 'TermCOMP 2024';
$showconfig = true;
$showscore = false;
$note = '';
$db = 'TPDB 11.4';
$closed = true;// make true when registration is closed.
$previous = 'Y2023';

$categories = [
	'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => 550691,
			'id' => 63906,
			'participants' => [
				'NTI' => 783008,
				'NaTT' => 790086,
				'AProVE' => 788264,
				'MuTerm' => 790115,
				// 'MnM' => null,
				'AutoNon' => 790411,
			],
			'certified' => [
				'id' => 63907,
				'postproc' => 818,
				'participants' => [
					'AProVE' => 788245,
					// 'NaTT' => null,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => 550817,
			'id' => 63908,
			'participants' => [
				'MuTerm' => 790115,
				'NaTT' => 790086,
				'matchbox' => 788343,
				'AProVE' => 790593,
				'MnM' => 788390,
			],
			'certified' => [
				'id' => 63909,
				'postproc' => 818,
				'participants' => [
					'AProVE' => 790604,
					// 'NaTT' => null,
					'matchbox' => 788346,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => 550835,
			'id' => 63716,
			'demo' => true,
			'participants' => [
				// 'NaTT' => null,
				'AProVE' => 788264,
				// 'MnM' => null,
			],
			'certified' => [
				'id' => 63742,
				'postproc' => 818,
				'participants' => [
					'AProVE' => 788245,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => 550733,
			'id' => 63910,
			'participants' => [
				// 'NaTT' => null,
				'matchbox' => 788345,
				'AProVE' => 788264,
				'MnM' => 788390,
			],
			'certified' => [
				'id' => 63911,
				'postproc' => 818,
				'participants' => [
					'AProVE' => 790604,
					'matchbox' => 788340,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => 550907,
			'id' => 63912,
			'participants' => [
				'MuTerm' => 790115,
				// 'NaTT' => null,
				'AProVE' => 788264,
			],
			'certified' => [
				'id' => 63913,
				'postproc' => 818,
				'participants' => [
					'AProVE' => 788245,
					// 'NaTT' => null,
				],
			],
		],
		'TRS Conditional - Operational Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 550749,
			'id' => 63914,
			'participants' => [
				'AProVE' => 788264,
				'MuTerm' => 790115,
			],
			'certified' => [
				'id' => null,
				'postproc' => 818,
				'participants' => [
				],
			],
		],
		'TRS Conditional - Termination' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => 550749,
			'id' => 63753,
			'note' => 'http://zenon.dsic.upv.es/muterm/benchmarks/ot-vs-t-20220721/benchmarks.html',
			'participants' => [
				'MuTerm' => 790117,
			],
			'certified' => [
				'postproc' => 818,
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'dir' => 'TRS_Contextsensitive',
			'spaceid' => 550643,
			'id' => 63915,
			'participants' => [
				'AProVE' => 788264,
				'MuTerm' => 790116,
			],
			'certified' => [
				'postproc' => 818,
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Innermost',
			'spaceid' => 550901,
			'id' => 63916,
			'participants' => [
				'AProVE' => 788266,
				'MuTerm' => 790064,
			],
			'certified' => [
				'id' => 63917,
				'postproc' => 820,
				'participants' => [
					'AProVE' => 788256,
				],
			],
		],
		'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => 550912,
			'id' => 63661,
			'demo' => true,
			'participants' => [
				'AProVE' => 788254,
			],
			'certified' => [
				'id' => 63743,
				'postproc' => 819,
				'participants' => [
					'AProVE' => 788255,
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
		'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 531842,
			'id' => 60901,
			'participants' => [
				'Wanda' => 359682,
				//				'SOL' => null,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
	],
	'Probabilistic Termination of Rewriting' => [
		'PTRS Standard' => [
			'type' => 'termination',
			'dir' => 'PTRS_Standard',
			'spaceid' => 550638,
			'id' => 63663,
			'participants' => [
				'AProVE' => 788252,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'PTRS Innermost' => [
			'type' => 'termination',
			'dir' => 'PTRS_Standard',
			'spaceid' => 550638,
			'id' => 63664,
			'participants' => [
				'AProVE' => 788248,
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
			'spaceid' => 550759,
			'id' => 63918,
			'participants' => [
				'AProVE' => 749009,
				'Ultimate' => 790100,
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
			'spaceid' => 550917,
			'id' => 63919,
			'participants' => [
				//				'iRankFinder' => null,
				'LoAT' => 747594,
				'KoAT' => 748986, // We disabled control-flow refinement by iRankFinder in this category.
				'MuVal' => 789717,
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
			'spaceid' => 550778,
			'id' => 63920,
			'participants' => [
				'NTI+cTI' => 788377,
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
		'Complexity: C' => [
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
			'spaceid' => 550754,
			'id' => 63737,
			'participants' => [
				'AProVE' => 788243,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Derivational Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Innermost_Rewriting',
			'spaceid' => 550647,
			'id' => 63736,
			'participants' => [
				'AProVE' => 788262,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Runtime Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Full_Rewriting',
			'spaceid' => 550843,
			'id' => 63735,
			'participants' => [
				'AProVE' => 788258,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
		'Runtime Complexity: TRS Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'spaceid' => 550870,
			'id' => 63734,
			'demo' => true,
			'participants' => [
				'AProVE' => 788241,
			],
			'certified' => [
				'id' => 63738,
				'postproc' => 821,
				'participants' => [
					'AProVE' => 788260,
				],
			],
		],
		'Runtime Complexity: TRS Parallel Innermost' => [
			'type' => 'complexity',
			'dir' => 'Runtime_Complexity_Innermost_Rewriting',
			'previous' => null,
			'spaceid' => 550870,
			'id' => 63905,
			'participants' => [
				'AProVE' => 790592,
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
