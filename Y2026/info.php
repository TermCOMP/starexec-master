<?php
$title = 'Termination Competition 2026';
$shortname = 'TermCOMP 2026';
$showconfig = true;
$showscore = false;
$note = '';
$db = 'TPDB 11.5';
$closed = false; // make true when registration is closed.
$previous = 'Y2025';

$categories = [
	'Termination of Rewriting' => [
                'TRS Standard' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'id' => 275763,
			'participants' => [
				'NTI' => 783008,
			],
			'certified' => [
			],
		],
                'TRS Standard nti' => [
			'type' => 'termination',
			'dir' => 'TRS_Standard',
			'id' => 275763,
			'participants' => [
				'NTI' => 783008,
			],
			'certified' => [
			],
		],
                'Integer Transition Systems' => [
			'type' => 'termination',
			'dir' => 'Integer_Transition_Systems',
			'id' => 518060,
			'participants' => [
			],
			'certified' => [
			],
		],
	],
        'Termination of Programs' => [
		'Logic Programming' => [
			'type' => 'termination',
			'dir' => 'Logic_Programming',
			'id' => 276036,
			'participants' => [
				'NTI+cTI' => 788377,
			],
			'certified' => [
			],
		],
                'Logic Programming nti' => [
			'type' => 'termination',
			'dir' => 'Logic_Programming',
			'id' => 276036,
			'participants' => [
				'NTI+cTI' => 788377,
			],
			'certified' => [
			],
		],
        ],
];
?>
