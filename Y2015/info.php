<?php
$title = 'Termination Competition 2015';
$shortname = 'TermCOMP 2015';
$showconfig = true;
$showscore = true;
$note = '';
$db = 'none';
$closed = true;// make true when registration is closed.
$previous = 'Y2014';

$categories = [
	'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => null,
			'id' => 10257,
			'participants' => [
                'AProVE' => 24272,
                'NaTT 1.3' => 22689,
                'TTT2' => 23357,
				'muterm 5.17' => 24307,
				'Wanda' => 2389,
                'AutoNon 1.21' => 24242,
                'matchbox2015-07-26.1' => 24112,
			],
			'certified' => [
				'id' => 10256,
				'postproc' => 172,
				'participants' => [
                    'AProVE' => 24733,
                    'TTT2' => 23358,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => null,
			'id' => 10296,
			'participants' => [
				'AProVE' => 24272,
				'TTT2' => 23357,
				'NaTT 1.3' => 22691,
				'muterm 5.17' => 24307,
                'AutoNon 1.21' => 24242,
                'matchbox2015-07-26.1' => 24112,
			],
			'certified' => [
				'id' => 10301,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 24733,
					'TTT2' => 23358,
				],
			],
		],
        'Cycles' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => null,
			'id' => 10259,
			'participants' => [
				'cycsrs-29-07-2015.5' => 24259,
				'matchbox2015-07-26.1' => 24110,
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
			'id' => 10298,
			'participants' => [
				'AProVE' => 24272,
				'TTT2' => 23357,
                'NaTT 1.3' => 22690,
			],
			'certified' => [
				'id' => 10302,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 24733,
                    'TTT2' => 23358,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => null,
			'id' => 10299,
			'participants' => [
                'AProVE' => 24272,
				'TTT2' => 23357,
                'NaTT 1.3' => 22690,
                'matchbox2015-07-26.1' => 24105,
			],
			'certified' => [
				'id' => 10303,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 24733,
					'TTT2' => 23358,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => null,
			'id' => 10304,
			'participants' => [
				'AProVE' => 24272,
                'muterm 5.17' => 24307,
			],
            'certified' => [
				'postproc' => 172,
				'id' => null,
				'participants' => [
				],
			],
		],
		'TRS Conditional' => [
			'type' => 'termination',
			'dir' => 'TRS_Conditional',
			'spaceid' => null,
			'id' => 10305,
			'participants' => [
                'AProVE' => 24272,
				'muterm 5.17' => 24307,
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
			'id' => 10306,
			'participants' => [
				'AProVE' => 24272,
				'muterm 5.17' => 24307,
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
			'id' => 10307,
			'participants' => [
				'AProVE' => 24272,
				'muterm 5.17' => 24307,
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
			'id' => 10309,
			'participants' => [
				'AProVE' => 24270,
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
			'id' => 10260,
			'participants' => [
				'AProVE' => 24271,
				'Ultimate' => 24757,
                'HipTNT+ v3' => 24352,
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
			'id' => 10261,
			'participants' => [
				'AProVE' => 24271,
				'Ultimate' => 24757,
                'HipTNT+ v3' => 24352,
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
			'id' => 10308,
			'participants' => [
				'T2 - 2015-07-09 - 13745bd6' => 23138,
				'AProVE' => 24266,
				'Ctrl' => 23757,
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
			'id' => 10316,
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
        'Java Bytecode Recursive' => [
			'type' => 'termination',
			'dir' => 'Java_Bytecode_Recursive',
			'spaceid' => null,
			'id' => 10317,
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
	],
	'Complexity Analysis' => [
		'Derivational Complexity: TRS' => [
			'type' => 'complexity',
			'dir' => 'Derivational_Complexity_Full_Rewriting',
			'spaceid' => null,
			'id' => 10310,
			'participants' => [
				'TCT2_20150725' => 24076,
                'TCT3_2015' => 24249,
                'matchbox2015-07-26.1' => 24117,
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
			'id' => 10311,
			'participants' => [
                'AProVE' => 24264,
				'TCT2_20150725' => 24071,
                'TCT3_2015' => 24243,
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
			'id' => 10312,
			'participants' => [
                'TCT2_20150725' => 24070,
                'TCT3_2015' => 24244,
				'AProVE' => 24267,
			],
			'certified' => [
				'id' => 10313,
				'postproc' => 821,
				'participants' => [
                    'TCT2_20150725' => 24072,
                    'TCT3_2015' => 24250,
                    'AProVE' => 24733,
                ],
			],
		],
	],
];
?>
