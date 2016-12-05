<?php

namespace spec\App;

use App\RoomDecrypter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomDecrypterSpec extends ObjectBehavior
{
    function it_is_initializable_with_a_room_name_and_sector_id_as_its_param()
    {
		$this->beConstructedWith('not-a-real-room', 404);
        $this->shouldHaveType(RoomDecrypter::class);
    }

    function it_can_determine_the_rotation_for_the_shift_cypher()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-', 123);
		$this->rotations()->shouldReturn(19);
	}

	function it_rotates_a_string()
	{
		$this->beConstructedWith('a-a', 1);
		$this->decode()->shouldReturn('b b');
	}

	function it_rotates_another_string()
	{
		$this->beConstructedWith('qzmt-zixmtkozy-ivhz', '343');
		$this->decode()->shouldReturn('very encrypted name');
	}
}
