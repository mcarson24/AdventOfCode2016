<?php

namespace App;

class Triangle
{
	protected static $cleanSideLengths = [];

	public $sideA;

	public $sideB;

	public $sideC;

	/**
	 * Triangle constructor.
	 *
	 * @param string $sides
	 */
	public function __construct(string $sides)
    {
		// Split the string into an array of the three side lengths
		// The lengths are separated by 1, 2, or 3 spaces.
		$sides = preg_split('/\s{1,3}/', $sides);

		// Remove empty values from the arrays.
		$sides = array_values(array_filter($sides, function($side) {
			return $side != '';
		}));

		$this->sideA = $sides[0];

		$this->sideB = $sides[1];

		$this->sideC = $sides[2];

		// Store all triangles
		array_push(static::$cleanSideLengths, [
			$this->sideA , $this->sideB, $this->sideC
		]);
    }

	/**
	 * Clean Side Lengths
	 *
	 * Returns an array of all of the triangles
	 * with cleanly spaced values.
	 *
	 * @return array
	 */
	public static function cleanSideLengths()
    {
        return static::$cleanSideLengths;
    }
}
