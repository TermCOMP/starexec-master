<?php
$title = 'Termination Competition 2014';
$shortname = 'TermCOMP 2014';
$showconfig = true;
$showscore = true;
$note = '';
$db = 'none';
$closed = true;// make true when registration is closed.
$previous = 'none';

$categories = [
	'Termination of Rewriting' => [
		'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'spaceid' => null,
			'id' => 5373,
			'participants' => [
                'AProVE' => 2656,
                'NaTT' => 2514,
                'TTT2' => 1950,
				'mu-term 5.13' => 2059,
				'Wanda' => 2389,
			],
			'certified' => [
				'id' => 5377,
				'postproc' => 172,
				'participants' => [
                    'AProVE' => 2652,
                    'TTT2' => 1951,
					'matchbox2014.07.08' => 2846,
				],
			],
		],
		'SRS Standard' => [
			'type' => 'termination',
			'dir' => 'SRS_Standard',
			'spaceid' => null,
			'id' => 5374,
			'participants' => [
				'AProVE' => 2656,
				'TTT2' => 1950,
				'NaTT' => 2514,
				'mu-term 5.13' => 2059,
			],
			'certified' => [
				'id' => 5378,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 2652,
					'matchbox2014.07.08' => 2846,
					'TTT2' => 1951,
				],
			],
		],
		'TRS Relative' => [
			'type' => 'termination',
			'dir' => 'TRS_Relative',
			'spaceid' => null,
			'id' => 5375,
			'participants' => [
				'AProVE' => 2656,
				'TTT2' => 1950,
			],
			'certified' => [
				'id' => 5379,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 2652,
                    'TTT2' => 1951,
				],
			],
		],
		'SRS Relative' => [
			'type' => 'termination',
			'dir' => 'SRS_Relative',
			'spaceid' => null,
			'id' => 5376,
			'participants' => [
                'AProVE' => 2656,
				'TTT2' => 1950,
			],
			'certified' => [
				'id' => 5380,
				'postproc' => 172,
				'participants' => [
					'AProVE' => 2652,
					'TTT2' => 1951,
				],
			],
		],
		'TRS Equational' => [
			'type' => 'termination',
			'dir' => 'TRS_Equational',
			'spaceid' => null,
			'id' => 5381,
			'participants' => [
				'AProVE' => 2656,
                'mu-term 5.13' => 2059,
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
			'id' => 5382,
			'participants' => [
                'AProVE' => 2656,
				'mu-term 5.13' => 2059,
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
			'id' => 5383,
			'participants' => [
				'AProVE' => 2656,
				'mu-term 5.13' => 2059,
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
			'id' => 5384,
			'participants' => [
				'AProVE' => 2656,
				'mu-term 5.13' => 2059,
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
			'id' => 5387,
			'participants' => [
				'AProVE' => 2654,
                'Ctrl' => 2388,
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
			'spaceid' => null,
			'id' => 5385,
			'participants' => [
				'Wanda' => 2390,
                'THOR' => 2862,
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
			'id' => 5391,
			'participants' => [
				'AProVE' => 2655,
				'Ultimate' => 2751,
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
			'id' => 5386,
			'participants' => [
				'T2 - 2014-07-06v1' => 2751,
				'AProVE' => 2894,
				'Ctrl' => 2387,
                'CppInv' => 2870,
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
			'id' => 5388,
			'participants' => [
				'TCT' => 2908,
                'CaT' => 1952,
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
			'id' => 5389,
			'participants' => [
				'TCT' => 2909,
                'CaT' => 1952,
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
			'id' => 5390,
			'participants' => [
                'TCT' => 2910,
				'AProVE' => 2656,
			],
			'certified' => [
				'id' => null,
				'postproc' => 821,
				'participants' => [
				],
			],
		],
	],
];
?>
