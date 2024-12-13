<?php
$title = 'Termination Competition 2017';
$shortname = 'TermCOMP 2017';
$showconfig = true;
$showscore = true;
$note = '';
$db = 'none';
$closed = true;// make true when registration is closed.
$previous = 'Y2016';

$categories = [
	'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => null,
			'id' => 24388,
			'participants' => [
                'AProVE' => 163935,
                'NaTT 1.6' => 164526,
                'ttt2-v1.16' => 164385,
				'muterm 5.18' => 163986,
				'Wanda' => 2389,
			],
			'certified' => [
				'id' => 24422,
				'postproc' => 172,
				'participants' => [
                    'AProVE' => 164103,
                    'ttt2-v1.16' => 164384,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => null,
			'id' => 24389,
			'participants' => [
				'AProVE' => 163935,
				'ttt2-v1.16' => 164385,
				'NaTT 1.6' => 164527,
				'muterm 5.18' => 163986,
                'pure-matchbox-2016-08-30.4' => 165453,
                'MultumNonMulta 3.6' => 165702,
			],
			'certified' => [
				'id' => 24423,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 164103,
					'ttt2-v1.16' => 164384,
				],
			],
		],
        'Cycles' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => null,
			'id' => 24390,
			'participants' => [
				'cycsrs-100816' => 163520,
				'pure-matchbox-2016-08-30.4' => 165454,
                'CycNTA' => 165820,
			],
			'certified' => [
				'id' => null,
				'postproc' => 172,
				'participants' => [
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => null,
			'id' => 24391,
			'participants' => [
				'AProVE' => 163935,
				'ttt2-v1.16' => 164385,
                'NaTT 1.6' => 164529,
			],
			'certified' => [
				'id' => 24424,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 164103,
                    'ttt2-v1.16' => 164384,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => null,
			'id' => 24392,
			'participants' => [
                'AProVE' => 163935,
				'ttt2-v1.16' => 164385,
                'MultumNonMulta 3.6' => 165702,
			],
			'certified' => [
				'id' => 24425,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 164103,
					'ttt2-v1.16' => 164384,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => null,
			'id' => 24393,
			'participants' => [
				'AProVE' => 163935,
                'muterm 5.18' => 163986,
                'NaTT 1.6' => 164526,
			],
            'certified' => [
				'postproc' => 172,
				'id' => 24394,
				'participants' => [
                    'AProVE' => 164103,
                    'NaTT 1.6' => 164528,
                ],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => null,
			'id' => 24395,
			'participants' => [
                'AProVE' => 163935,
				'muterm 5.18' => 163986,
			],
			'certified' => [
				'postproc' => 172,
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Context Sensitive' => [
			'type' => 'termination',
			'dir' => 'TRS_Contextsensitive',
			'spaceid' => null,
			'id' => 24396,
			'participants' => [
				'AProVE' => 163935,
				'muterm 5.18' => 163986,
			],
			'certified' => [
				'postproc' => 172,
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Innermost',
			'spaceid' => null,
			'id' => 24397,
			'participants' => [
				'AProVE' => 163935,
				'muterm 5.18' => 163986,
			],
			'certified' => [
				'id' => 24427,
				'postproc' => 172,
				'participants' => [
				],
			],
		],
        'TRS Outermost' => [
			'type' => 'termination',
			'dir' => 'TRS_Outermost',
			'spaceid' => null,
			'id' => 24426,
			'participants' => [
				'AProVE' => 163935,
				'muterm 5.18' => 163986,
			],
			'certified' => [
				'id' => 24428,
				'postproc' => 172,
				'participants' => [
				],
			],
		],
        'HRS Union Beta' => [
			'type' => 'termination',
			'dir' => 'Higher_Order_Rewriting_Union_Beta',
			'spaceid' => 531842,
			'id' => 24398,
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
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'Integer_TRS_Innermost',
			'spaceid' => null,
			'id' => 24401,
			'participants' => [
				'AProVE' => 163935,
                'Ctrl' => 23758,
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
			'id' => 24405,
			'participants' => [
				'AProVE' => 163965,
				'Ultimate' => 165938,
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
			'spaceid' => null,
			'id' => 24406,
			'participants' => [
				'AProVE' => 163965,
				'Ultimate' => 165938,
                'VeryMax' => 165578,
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
			'id' => 24399,
			'participants' => [
				'VeryMax' => 165578,
				'AProVE' => 163934,
				'Ctrl' => 23757,
			],
			'certified' => [
				'id' => 24400,
				'participants' => [
				],
			],
		],
        'Haskell' => [
			'type' => 'termination',
			'dir' => 'Haskell',
			'spaceid' => 466206,
			'id' => 24432,
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
			'spaceid' => null,
			'id' => 24430,
			'participants' => [
				'AProVE' => 24273,
				'Ultimate' => 24758,
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
			'id' => 24431,
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
	],
	'Complexity Analysis' => [
		// 'Derivational Complexity: TRS' => [
		// 	'type' => 'complexity',
		// 	'dir' => 'Derivational_Complexity_Full_Rewriting',
		// 	'spaceid' => null,
		// 	'id' => 10310,
		// 	'participants' => [
		// 		'TCT2_20150725' => 24076,
        //         'TCT3_2015' => 24249,
        //         'pure-matchbox-2016-08-30.4' => 24117,
		// 	],
		// 	'certified' => [
		// 		'id' => null,
		// 		'participants' => [
		// 		],
		// 	],
		// ],
        'Complexity: C Integer' => [
			'type' => 'complexity',
			'dir' => 'Complexity_C_Integer',
			'spaceid' => null,
			'id' => 24407,
			'participants' => [
                'AProVE' => 164151,
				'Loopus' => 165484,
                'tct' => 165440,
                'CoFloCo' => 164533,
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
			'id' => 24404,
			'participants' => [
                'AProVE' => 163932,
				'Loopus' => 165483,
                'tct' => 165441,
                'CoFloCo' => 164532,
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
			'spaceid' => null,
			'id' => 24429,
			'participants' => [
                'AProVE' => 164592,
				'tct' => 165444,
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
			'spaceid' => null,
			'id' => 24402,
			'participants' => [
                'tct' => 165446,
				'AProVE' => 164592,
			],
			'certified' => [
				'id' => 24403,
				'postproc' => 821,
				'participants' => [
                    'tct' => 165447,
                    'AProVE' => 164593,
                ],
			],
		],
	],
];
?>
