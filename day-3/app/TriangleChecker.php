<?php

namespace App;

class TriangleChecker
{
	protected $triangle;

    public function __construct(Triangle $triangle)
    {
        $this->triangle = $triangle;
    }

    public function isValid()
    {
        if ($this->triangle->sideA + $this->triangle->sideB <= $this->triangle->sideC)
		{
			return false;
		}

		if ($this->triangle->sideA + $this->triangle->sideC <= $this->triangle->sideB)
		{
			return false;
		}

		if ($this->triangle->sideB + $this->triangle->sideC <= $this->triangle->sideA)
		{
			return false;
		}

		return true;
    }
}
