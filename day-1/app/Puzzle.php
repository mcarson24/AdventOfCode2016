<?php

namespace App;

class Puzzle
{
	protected $currentDirection = 0;

	protected $yDistance = 0;

	protected $xDistance = 0;

	protected $compass = [
		0 => 'North',
		1 => 'East',
		2 => 'South',
		3 => 'West'
	];

	protected $locations = [
		"0, 0"
	];

	protected $firstDuplicate = '';

	/**
	 * @param $direction
	 * @return int
	 */
	public function turn($direction)
    {
		$direction = strtoupper($direction);

        if ($direction == 'R')
		{
			// Resets direction to handle turning from west(3) to north(0).
			if ($this->currentDirection == 3)
			{
				return $this->currentDirection = 0;
			}
			$this->currentDirection++;
		}

		if ($direction == 'L')
		{
			// Handle turning from north(0) to west(3).
			if ($this->currentDirection == 0)
			{
				$this->currentDirection = sizeof($this->compass);
			}
			$this->currentDirection--;
		}
    }

	/**
	 * @param $distance
	 */
	protected function walk($distance)
	{
		if ($distance == 0) return;
		if ($this->currentDirection() == 'West')
		{
			foreach	(range(0, $distance - 1) as $i)
			{
				$this->xDistance--;
				array_push($this->locations, "{$this->xDistance}, {$this->yDistance}");
			}
		}

		if ($this->currentDirection() == 'East')
		{
			foreach	(range(0, $distance - 1) as $i)
			{
				$this->xDistance++;
				array_push($this->locations, "{$this->xDistance}, {$this->yDistance}");
			}
		}

		if ($this->currentDirection() == 'South')
		{
			foreach	(range(0, $distance - 1) as $i)
			{
				$this->yDistance--;
				array_push($this->locations, "{$this->xDistance}, {$this->yDistance}");
			}
		}

		if ($this->currentDirection() == 'North')
		{
			foreach	(range(0, $distance - 1) as $i)
			{
				$this->yDistance++;
				array_push($this->locations, "{$this->xDistance}, {$this->yDistance}");
			}
		}

		if ($this->firstDuplicate == '')
		{
			$this->findDuplicate();
		}
	}

	/**
	 * @param $instructions
	 */
	public function move($instructions)
    {
		$instructions = explode(', ', $instructions);

		array_map(function($instruction) {
			$direction = substr($instruction, 0, 1);
			$this->turn($direction);

			$distance = strlen($instruction) == 1 ? 0 : substr($instruction, 1);
			$this->walk($distance);
		}, $instructions);
	}

	/**
	 * @return mixed
	 */
	public function currentDirection()
	{
		return $this->compass[$this->currentDirection];
	}

	/**
	 * @return number
	 */
	public function distanceFromStart()
	{
		return abs($this->xDistance) + abs($this->yDistance);
	}

	/**
	 * @return array
	 */
	public function locations()
	{
		return $this->locations;
	}

	/**
	 * @return string
	 */
	public function firstDuplicate()
	{
		return $this->firstDuplicate;
	}

	/**
	 * @return number
	 */
	public function distanceToFirstDuplicate()
    {
		$coordinatesOfFirstDuplicate = explode(', ', $this->firstDuplicate);

        return abs($coordinatesOfFirstDuplicate[0]) + abs($coordinatesOfFirstDuplicate[1]);
    }

	/**
	 * Finds duplicate in the locations that we have
	 * visited so far.
	 */
	private function findDuplicate()
	{
		$frequencies = array_count_values($this->locations);

		$this->firstDuplicate = in_array(2, $frequencies) ? array_search(2, $frequencies) : '';
	}
}
