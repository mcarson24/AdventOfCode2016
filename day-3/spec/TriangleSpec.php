<?php

namespace spec\App;

use App\Triangle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TriangleSpec extends ObjectBehavior
{
    function it_can_store_three_side_values()
	{
		$this->beConstructedWith('5 6 7');
		$this->sideA->shouldReturn('5');
		$this->sideB->shouldReturn('6');
		$this->sideC->shouldReturn('7');
	}

	function it_can_store_values_that_have_single_digits()
	{
		$this->beConstructedWith('1    2           45');
		$this->sideA->shouldReturn('1');
		$this->sideB->shouldReturn('2');
		$this->sideC->shouldReturn('45');
	}

	function it_stores_old_triangles()
	{
		$this->beConstructedWith('5  10  23');

		$this::cleanSideLengths()->shouldReturn([
			['5', '6', '7'],
			['1', '2', '45'],
			['5', '10', '23'],
		]);
	}
}
