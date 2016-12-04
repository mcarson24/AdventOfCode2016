<?php

require 'vendor/autoload.php';

use App\RoomCode;

$roomCodes = file('roomCodes.txt');

$validRooms = array_map(function($roomCode) {
	return new RoomCode($roomCode);
}, $roomCodes);

$validRooms = array_filter($validRooms, function($room) {
	return $room->isValid();
});

//var_dump($validRooms);

$amount = array_reduce($validRooms, function($carry, $room) {
	return $carry += $room->sectorID;
});

var_dump($amount);

