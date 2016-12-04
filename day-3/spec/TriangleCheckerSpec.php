<?php

namespace spec\App;

use App\Triangle;
use App\TriangleChecker;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TriangleCheckerSpec extends ObjectBehavior {

	function it_checks_that_a_triangle_is_valid()
	{
		$this->beConstructedWith(new Triangle('5  6  7'));
		$this->isValid()->shouldReturn(true);
		$this->triangle()->shouldReturnAnInstanceOf(Triangle::class);
	}

	function it_correctly_checks_a_triangle_with_sides_of_5_10_and_25()
	{
		$this->beConstructedWith(new Triangle('5  10  25'));
		$this->isValid()->shouldReturn(false);
		$this->triangle()->shouldReturnAnInstanceOf(Triangle::class);
	}
}
