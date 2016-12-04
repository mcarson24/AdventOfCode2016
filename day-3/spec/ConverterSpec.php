<?php

namespace spec\App;

use App\Triangle;
use App\VerticalTriangle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConverterSpec extends ObjectBehavior
{
	function it_converts_triangles()
	{
		$this->convert([
			['15', '10', '35'],
			['100', '100', '100'],
			['150', '150', '150']
		])->shouldReturn([
			'15 100 150',
			'10 100 150',
			'35 100 150'
		]);
	}
}
