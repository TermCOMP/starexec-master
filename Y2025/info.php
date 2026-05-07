<?php
$title = 'Termination Competition 2025';
$shortname = 'TermCOMP 2025';
$showconfig = true;
$showscore = false;
$note = '';
$db = 'TPDB 11.5';
$closed = true;// make true when registration is closed.
$previous = 'Y2024';

$categories = [
	'Termination of Rewriting' => [
	 	'TRS Standard' => [
	 		'dir' => 'TRS_Standard',
	 		'id' => 60781488,
	 	],
	 	'SRS Standard' => [
	 		'dir' => 'SRS_Standard',
	 		'id' => 60787734,
		],
	 	'TRS Relative' => [
	 		'dir' => 'TRS_Relative',
	 		'id' => 60806944,
	 	],
	 	'SRS Relative' => [
	 		'dir' => 'SRS_Relative',
	 		'id' => 60806987,
	 	],
	 	'TRS Equational' => [
	 		'dir' => 'TRS_Equational',
	 		'id' => 60792731,
	 	],
	 	'TRS Conditional - Operational Termination' => [
	 		'dir' => 'TRS_Conditional',
	 		'id' => 60783906,
	 	],
	 	'TRS Conditional - Termination' => [
	 		'dir' => 'TRS_Conditional',
	 		'id' => 60341286,
	 	],
	 	'TRS Context Sensitive' => [
	 		'dir' => 'TRS_Contextsensitive',
	 		'id' => 60792768,
	 	],
	 	'TRS Innermost' => [
			'dir' => 'TRS_Innermost',
	 		'id' => 60792801,
	 	],
	 	'TRS Outermost' => [
	 		'dir' => 'TRS_Outermost',
	 		'id' => 60372512,
	 	],
	 	'Integer TRS Innermost' => [
	 		'dir' => 'Integer_TRS_Innermost',
	 		'id' => 60377967,
	 	],
		'HRS Union Beta' => [
//			'dir' => 'Higher_Order_Rewriting',
			'id' => 60341223,
		],
	],
	 'Probabilistic Termination of Rewriting' => [
	 	'PTRS Standard' => [
	 		'dir' => 'PTRS_Standard',
	 		'id' => 60748375,
	 	],
	 	'PTRS Innermost' => [
	 		'dir' => 'PTRS_Standard',
	 		'id' => 60748472,
	 	],
	 ],
	'Termination of Programs' => [
		'C' => [
		 	'dir' => 'C',
		 	'id' => 60783810,
		],
		'Integer Transition Systems' => [
			'dir' => 'Integer_Transition_Systems',
			'id' => 60804560,
		],
		'Java Bytecode' => [
		 	'dir' => 'Java_Bytecode',
		 	'id' => 60378423,
		],
		'Java Bytecode Recursive' => [
		 	'dir' => 'Java_Bytecode_Recursive',
		 	'id' => 60380296,
		 ],
		'Logic Programming' => [
			'dir' => 'Logic_Programming',
			'id' => 60792637,
		],
		'Logic Programming with Cut' => [
		 	'dir' => 'Logic_Programming_with_Cut',
		 	'id' => 60380507,
		 ],
		'Prolog' => [
			'dir' => 'Prolog',
			'id' => 60380589,
		],
	],
	'Complexity Analysis' => [
	 	'Complexity: C' => [
	 		'dir' => 'Complexity_C_Integer',
	 		'id' => 60810166,
	 	],
	 	'Complexity: ITS' => [
	 		'dir' => 'Complexity_ITS',
	 		'id' => 60811460,
	 	],
	],
];
?>
