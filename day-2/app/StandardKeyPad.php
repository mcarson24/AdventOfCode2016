<?php

namespace App;

class StandardKeyPad extends KeyPad {

	protected $x = 0;

	protected $y = 0;

	/**
	 * The mappings to each button. The
	 * coordinates where each button
	 * is located is the key.
	 *
	 * @var array
	 */
	protected $buttons = [
		'-1,1'   => 1,
		'0,1'    => 2,
		'1,1'    => 3,
		'-1,0'   => 4,
		'0,0'    => 5,
		'1,0'    => 6,
		'-1,-1'  => 7,
		'0,-1'   => 8,
		'1,-1'   => 9
	];

	/**
	 * Set the limits where we can move on the keypad.
	 * Will prevent us from moving where there are
	 * no buttons.
	 */
	protected function setLimits()
	{
		$this->xLimit = 1;
		$this->yLimit = 1;
	}
}
