<?php

namespace spec\App;

use App\RoomCode;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomCodeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
        $this->shouldHaveType(RoomCode::class);
    }

    function it_takes_an_encrypted_name_as_parameter()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
		$this->encryptedData()->shouldReturn('aaaaa-bbb-z-y-x-123[abxyz]');
	}

	function it_can_strip_apart_the_data_and_return_the_room_name()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
		$this->roomName()->shouldReturn('aaaaa-bbb-z-y-x');
	}

	function it_can_strip_apart_the_data_and_return_the_sector_id()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
		$this->sectorID()->shouldReturn(123);
	}

	function it_can_strip_apart_the_data_and_return_the_sector_id_of_a_different_room()
	{
		$this->beConstructedWith('a-b-c-d-e-f-g-h-987[abcde]');
		$this->sectorID()->shouldReturn(987);
	}

	function it_can_strip_apart_the_data_and_return_the_checksum()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
		$this->checkSum()->shouldReturn('abxyz');
	}

	function it_can_strip_apart_the_data_and_return_the_checksum_of_a_different_room()
	{
		$this->beConstructedWith('a-b-c-d-e-f-g-h-987[abcde]');
		$this->checkSum()->shouldReturn('abcde');
	}

	function it_can_strip_apart_other_data_and_returns_the_room_name()
	{
		$this->beConstructedWith('a-b-c-d-e-f-g-h-987[abcde]');
		$this->roomName()->shouldReturn('a-b-c-d-e-f-g-h');
	}

	function it_can_strip_apart_more_data_and_returns_the_room_name()
	{
		$this->beConstructedWith('not-a-real-room-404[oarel]');
		$this->roomName()->shouldReturn('not-a-real-room');
	}

	function it_can_strip_last_data_and_returns_the_room_name()
	{
		$this->beConstructedWith('totally-real-room-200[decoy]');
		$this->roomName()->shouldReturn('totally-real-room');
	}

	function it_can_determine_the_five_most_common_letter_in_the_room_name()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
		$this->mostCommonLetters()->shouldReturn('abxyz');
	}

	function it_can_determine_the_five_most_common_letter_in_the_second_room_name()
	{
		$this->beConstructedWith('a-b-c-d-e-f-g-h-987[abcde]');
		$this->mostCommonLetters()->shouldReturn('abcde');
	}

	function it_can_determine_the_five_most_common_letter_in_the_third_room_name()
	{
		$this->beConstructedWith('not-a-real-room-404[oarel]');
		$this->mostCommonLetters()->shouldReturn('oarel');
	}

	function it_can_determine_the_five_most_common_letter_in_the_fourth_room_name()
	{
		$this->beConstructedWith('totally-real-room-200[decoy]');
		$this->mostCommonLetters()->shouldReturn('loart');
	}

	function it_can_check_if_a_room_is_valid()
	{
		$this->beConstructedWith('aaaaa-bbb-z-y-x-123[abxyz]');
		$this->isValid()->shouldReturn(true);
	}

	function it_can_check_if_a_room_is_valid_of_a_different_room()
	{
		$this->beConstructedWith('a-b-c-d-e-f-g-h-987[abcde]');
		$this->isValid()->shouldReturn(true);
	}

	function it_can_check_if_a_room_is_invalid()
	{
		$this->beConstructedWith('totally-real-room-200[decoy]');
		$this->isValid()->shouldReturn(false);
	}
}
