<?php
$title = 'Termination Competition 2016';
$shortname = 'TermCOMP 2016';
$showconfig = true;
$showscore = true;
$note = '';
$db = 'none';
$closed = true;// make true when registration is closed.
$previous = 'Y2015';

$categories = [
	'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => null,
			'id' => 18368,
			'participants' => [
                'AProVE' => 163935,
                'NaTT 1.6' => 164526,
                'ttt2-v1.16' => 164385,
				'muterm 5.18' => 163986,
				'Wanda' => 2389,
			],
			'certified' => [
				'id' => 18373,
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
			'id' => 18369,
			'participants' => [
				'AProVE' => 163935,
				'ttt2-v1.16' => 164385,
				'NaTT 1.6' => 164527,
				'muterm 5.18' => 163986,
                'pure-matchbox-2016-08-30.4' => 165453,
                'MultumNonMulta 3.6' => 165702,
			],
			'certified' => [
				'id' => 18374,
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
			'id' => 18370,
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
			'id' => 18371,
			'participants' => [
				'AProVE' => 163935,
				'ttt2-v1.16' => 164385,
                'NaTT 1.6' => 164529,
			],
			'certified' => [
				'id' => 18375,
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
			'id' => 18372,
			'participants' => [
                'AProVE' => 163935,
				'ttt2-v1.16' => 164385,
                'MultumNonMulta 3.6' => 165702,
			],
			'certified' => [
				'id' => 18376,
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
			'id' => 18377,
			'participants' => [
				'AProVE' => 163935,
                'muterm 5.18' => 163986,
                'NaTT 1.6' => 164526,
			],
            'certified' => [
				'postproc' => 172,
				'id' => 18378,
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
			'id' => 18379,
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
			'id' => 18380,
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
			'id' => 18381,
			'participants' => [
				'AProVE' => 163935,
				'muterm 5.18' => 163986,
			],
			'certified' => [
				'id' => null,
				'postproc' => 172,
				'participants' => [
				],
			],
		],
		'Integer TRS Innermost' => [
			'type' => 'termination',
			'dir' => 'Integer_TRS_Innermost',
			'spaceid' => null,
			'id' => 18383,
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
			'id' => 18388,
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
			'id' => 18389,
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
			'id' => 18382,
			'participants' => [
				'VeryMax' => 165578,
				'AProVE' => 163934,
				'Ctrl' => 23757,
			],
			'certified' => [
				'id' => null,
				'participants' => [
				],
			],
		],
        // 'Java Bytecode' => [
		// 	'type' => 'termination',
		// 	'dir' => 'Java_Bytecode',
		// 	'spaceid' => null,
		// 	'id' => 10316,
		// 	'participants' => [
		// 		'AProVE' => 24273,
		// 		'Ultimate' => 24758,
		// 	],
		// 	'certified' => [
		// 		'id' => null,
		// 		'participants' => [
		// 		],
		// 	],
		// ],
        // 'Java Bytecode Recursive' => [
		// 	'type' => 'termination',
		// 	'dir' => 'Java_Bytecode_Recursive',
		// 	'spaceid' => null,
		// 	'id' => 10317,
		// 	'participants' => [
		// 		'AProVE' => 24273,
		// 		'Ultimate' => 24758,
		// 	],
		// 	'certified' => [
		// 		'id' => null,
		// 		'participants' => [
		// 		],
		// 	],
		// ],
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
			'id' => 18390,
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
			'id' => 18387,
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
			'id' => 18384,
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
			'id' => 18385,
			'participants' => [
                'tct' => 165446,
				'AProVE' => 164592,
			],
			'certified' => [
				'id' => 18386,
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
