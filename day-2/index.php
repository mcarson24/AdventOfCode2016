<?php

require 'vendor/autoload.php';

use App\StarKeyPad;
use App\StandardKeyPad;

$inputs = file('inputs.txt');

$keyPads = [
	'part1' => new StandardKeyPad(),
	'part2' => new StarKeyPad()
];

array_map(function($keypad) use ($inputs) {
	array_map(function($input) use ($keypad) {
		$keypad->move($input);
	}, $inputs);
	echo sprintf("%s\n", $keypad->buttonsToPress());
}, $keyPads);