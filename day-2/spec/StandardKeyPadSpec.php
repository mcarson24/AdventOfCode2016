<?php

namespace spec\App;

use App\Puzzle;
use App\StandardKeyPad;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StandardKeyPadSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StandardKeyPad::class);
    }

    function it_can_move_up_and_store_its_location()
	{
		$this->move('U');
		$this->buttonLocations()->shouldReturn([
			'0,1'
		]);
	}

	function it_can_move_down_and_store_its_location()
	{
		$this->move('D');
		$this->buttonLocations()->shouldReturn([
			'0,-1'
		]);
	}

	function it_can_move_right_and_store_its_location()
	{
		$this->move('R');
		$this->buttonLocations()->shouldReturn([
			'1,0'
		]);
	}

	function it_can_move_left_and_store_its_location()
	{
		$this->move('L');
		$this->buttonLocations()->shouldReturn([
			'-1,0'
		]);
	}

	function it_can_move_multiple_times_and_store_its_location()
	{
		$this->move('LUUDL');
		$this->buttonLocations()->shouldReturn([
			'-1,0'
		]);
	}

	function it_stores_multiple_button_locations_for_multiple_instructions()
	{
		$this->move('UR');
		$this->move('DL');
		$this->buttonLocations()->shouldReturn([
			'1,1', '0,0'
		]);
	}

	function it_doesnot_go_over_the_keypad_boundries()
	{
		$this->move('UUUUU');
		$this->buttonLocations()->shouldReturn([
			'0,1'
		]);
	}

	function it_translates_button_locations_to_correct_buttons()
	{
		$this->move('UR');
		$this->buttonLocations()->shouldReturn([
			'1,1'
		]);
		$this->buttonsToPress()->shouldReturn('3');
	}

	function it_translates_two_button_locations_to_correct_buttons()
	{
		$this->move('UR');
		$this->move('UR');
		$this->buttonLocations()->shouldReturn([
			'1,1', '1,1'
		]);
		$this->buttonsToPress()->shouldReturn('33');
	}

	function it_translates_three_button_locations_to_correct_buttons()
	{
		$this->move('UR');
		$this->move('UR');
		$this->move('DL');
		$this->buttonLocations()->shouldReturn([
			'1,1', '1,1', '0,0'
		]);
		$this->buttonsToPress()->shouldReturn('335');
	}

	function it_translates_multiple_button_locations_to_correct_buttons()
	{
		$this->move('ULL');
		$this->move('RRDDD');
		$this->move('LURDL');
		$this->move('UUUUD');
		$this->buttonLocations()->shouldReturn([
			'-1,1', '1,-1', '0,-1', '0,0'
		]);
		$this->buttonsToPress()->shouldReturn('1985');
	}
}
