<?php

namespace App;

class StarKeyPad extends KeyPad {

	protected $x = -2;

	protected $y = 0;

	/**
	 * The mappings to each button. The
	 * coordinates where each button
	 * is located is the key.
	 *
	 * @var array
	 */
	protected $buttons = [
		'0,2'  	=> 1,
		'-1,1'  => 2,
		'0,1'  	=> 3,
		'1,1'  	=> 4,
		'-2,0' 	=> 5,
		'-1,0' 	=> 6,
		'0,0' 	=> 7,
		'1,0'   => 8,
		'2,0'   => 9,
		'-1,-1' => 'A',
		'0,-1'  => 'B',
		'1,-1'  => 'C',
		'0,-2'  => 'D',
	];

	/**
	 * Set the limits where we can move on the keypad.
	 * Will prevent us from moving where there are
	 * no buttons.
	 */
	protected function setLimits()
	{
		abs($this->y) == 0 ? $this->xLimit = 2 : $this->xLimit = abs($this->y) % 2;

		abs($this->x) == 0 ? $this->yLimit = 2 : $this->yLimit = abs($this->x) % 2;
	}
}
