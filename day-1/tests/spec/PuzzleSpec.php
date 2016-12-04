<?php

namespace spec\App;

use App\Puzzle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PuzzleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_is_facing_north()
	{
		$this->currentDirection()->shouldReturn('North');
	}

	function it_turns_to_the_right_and_is_facing_east()
	{
		$this->turn('R');
		$this->currentDirection()->shouldReturn('East');
	}

	function it_turns_to_the_left_and_is_facing_west()
	{
		$this->turn('L');
		$this->currentDirection()->shouldReturn('West');
	}

	function it_turns_to_the_left_twice_and_is_facing_south()
	{
		$this->turn('L');
		$this->turn('L');
		$this->currentDirection()->shouldReturn('South');
	}

	function it_can_turn_back_to_the_north()
	{
		$this->turn('L');
		$this->turn('R');
		$this->currentDirection()->shouldReturn('North');
	}

	function it_can_walk_a_certain_distance()
	{
		$this->move('R10');
		$this->currentDirection()->shouldReturn('East');
		$this->distanceFromStart()->shouldReturn(10);
	}

	public function it_can_turn_and_not_move()
	{
		$this->move('L');
		$this->currentDirection()->shouldReturn('West');
		$this->distanceFromStart()->shouldReturn(0);
	}

	function it_can_track_the_distance_from_the_starting_point_with_multiple_turns()
	{
		$this->move('R5');
		$this->move('L5');
		$this->move('R5');
		$this->move('R3');
		$this->currentDirection()->shouldReturn('South');
		$this->distanceFromStart()->shouldReturn(12);
	}

	function it_can_track_another_distance_from_the_starting_point_with_multiple_turns()
	{
		$this->move('R5');
		$this->move('L2');
		$this->move('R6');
		$this->move('L2');
		$this->move('L2');
		$this->currentDirection()->shouldReturn('West');
		$this->distanceFromStart()->shouldReturn(13);
	}

	function it_can_handle_multiple_directions_passed_at_once()
	{
		$this->move('R5, L2, R6, L2, L2');
		$this->currentDirection()->shouldReturn('West');
		$this->distanceFromStart()->shouldReturn(13);
	}

	function it_can_handle_other_multiple_directions_passed_at_once()
	{
		$this->move('R5, L5, R5, R3');
		$this->currentDirection()->shouldReturn('South');
		$this->distanceFromStart()->shouldReturn(12);
	}

	function it_handles_negative_distance_correctly()
	{
		$this->move('L3, L3');
		$this->distanceFromStart()->shouldReturn(6);
	}

	function it_keeps_track_of_locations()
	{
		$this->move('L3, L3');

		$this->locations()->shouldReturn([
			'0, 0',
			'-1, 0',
			'-2, 0',
			'-3, 0',
			'-3, -1',
			'-3, -2',
			'-3, -3'
		]);
	}

	function it_finds_first_duplicate_location()
	{
		$this->move('R3, R3, R3, R3');

		$this->locations()->shouldReturn([
			'0, 0',
			'1, 0',
			'2, 0',
			'3, 0',
			'3, -1',
			'3, -2',
			'3, -3',
			'2, -3',
			'1, -3',
			'0, -3',
			'0, -2',
			'0, -1',
			'0, 0'
		]);

		$this->firstDuplicate()->shouldReturn('0, 0');
	}

	public function it_finds_the_first_duplicate_and_does_not_overwrite_it_with_another_duplicate()
	{
		$this->move('R1, R1, R1, R1, L1, L1, L1');

		$this->locations()->shouldReturn([
			'0, 0', '1, 0', '1, -1', '0, -1', '0, 0', '-1, 0', '-1, -1', '0, -1'
		]);

		$this->firstDuplicate()->shouldReturn('0, 0');
	}

	public function it_determines_distance_from_start_to_first_duplicate()
	{
		$this->move('R1, R1, L1, L1, L1, R1');

		$this->locations()->shouldReturn([
			'0, 0', '1, 0', '1, -1', '2, -1', '2, 0', '1, 0', '1, 1'
		]);

		$this->firstDuplicate()->shouldReturn('1, 0');

		$this->distanceToFirstDuplicate()->shouldReturn(1);
	}
}
