<?php

namespace spec\App;

use App\StarKeyPad;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StarKeyPadSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StarKeyPad::class);
    }

	function it_starts_on_the_number_five_which_is_in_the_middle_column_all_the_way_to_the_left()
	{
		$this->move('RL');
		$this->buttonLocations()->shouldReturn([
			'-2,0'
		]);
	}

	function it_does_not_reset_after_an_instruction()
	{
		$this->move('RR');
		$this->move('RL');
		$this->buttonLocations()->shouldReturn([
			'0,0', '0,0'
		]);
	}

	function it_wont_move_out_of_bounds_on_the_five_wide_row_()
	{
		$this->move('RRRRR');
		$this->buttonLocations()->shouldReturn([
			'2,0'
		]);
	}

	function it_wont_move_out_of_bounds_on_the_three_wide_row()
	{
		$this->move('RRULL');
		$this->buttonLocations()->shouldReturn([
			'-1,1'
		]);
	}

	function it_wont_move_out_of_bounds_on_the_one_wide_row()
	{
		$this->move('RRUUR');
		$this->buttonLocations()->shouldReturn([
			'0,2'
		]);
	}

	function it_wont_move_out_of_bounds_on_a_one_tall_column()
	{
		$this->move('U');
		$this->buttonLocations()->shouldReturn([
			'-2,0'
		]);
	}

	function it_wont_move_out_of_bounds_on_a_two_tall_column()
	{
		$this->move('RUU');
		$this->buttonLocations()->shouldReturn([
			'-1,1'
		]);
	}

	function it_wont_move_out_of_bounds_on_a_three_tall_column()
	{
		$this->move('RRUUU');
		$this->buttonLocations()->shouldReturn([
			'0,2'
		]);
	}

	function it_wont_move_out_of_bounds_even_after_multiple_attempts()
	{
		$this->move('LURDL');
		$this->buttonsToPress()->shouldReturn('A');
	}

	function it_gives_the_correct_buttons()
	{
		$this->move('ULL');
		$this->move('RRDDD');
		$this->move('LURDL');
		$this->move('UUUUD');
		$this->buttonsToPress()->shouldReturn('5DB3');
	}

	function it_stays_in_the_lines()
	{
		$this->move('LUDRULUDDLDRDLRURRURUDLUUR');
		$this->buttonsToPress()->shouldReturn('4');
	}
}
