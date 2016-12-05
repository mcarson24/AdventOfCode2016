<?php

require 'vendor/autoload.php';

use App\RoomCode;
use App\RoomDecrypter;

$roomCodes = file('roomCodes.txt');

$validRooms = array_map(function($roomCode) {
	return new RoomCode($roomCode);
}, $roomCodes);

$validRooms = array_filter($validRooms, function($room) {
	return $room->isValid();
});

$roomNames = array_map(function($room) {
	return [
		'name' => (new RoomDecrypter($room->roomName, $room->sectorID))->decode(),
		'sectorID' => $room->sectorID
	];
}, $validRooms);


$amount = array_reduce($validRooms, function($carry, $room) {
	return $carry += $room->sectorID;
});

var_dump(array_filter($roomNames, function($room) {
	return strpos($room['name'], 'pole');
}));

echo sprintf("Sector ID sums of valid rooms: %d", $amount);

