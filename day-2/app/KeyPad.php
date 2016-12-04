<?php


namespace App;


class KeyPad {

	protected $buttonLocations = [];

	protected $xLimit;

	protected $yLimit;

	/**
	 * Converts the button coordinates to
	 * actual button numbers.
	 *
	 * @return string
	 */
	public function buttonsToPress()
	{
		$buttonCombo = array_map(function($location) {
			return $this->buttons[$location];
		}, $this->buttonLocations);

		return implode('', $buttonCombo);
	}

	/**
	 * @param $directions
	 */
	public function move($directions)
	{
		$directions = str_split($directions, 1);

		foreach ($directions as $direction)
		{
			$this->setLimits();

			if ($direction == 'U')
			{
				if ($this->y == $this->yLimit) continue;

				$this->y += 1;
			}

			if ($direction == 'D')
			{
				if ($this->y == -$this->yLimit) continue;

				$this->y -= 1;
			}

			if ($direction == 'R')
			{
				if ($this->x == $this->xLimit) continue;

				$this->x += 1;
			}

			if ($direction == 'L')
			{
				if ($this->x == -$this->xLimit) continue;

				$this->x -= 1;
			}
		}

		$this->addToButtonLocations();
	}

	/**
	 * @return array
	 */
	public function buttonLocations()
	{
		return $this->buttonLocations;
	}

	/**
	 * We just stopped on a button. Lets store
	 * it in the buttonLocations array so
	 * that we can check them later.
	 */
	private function addToButtonLocations()
	{
		array_push($this->buttonLocations, "{$this->x},{$this->y}");
	}

}