<?php

require 'vendor/autoload.php';

use App\RoomCode;
use App\RoomDecrypter;

$roomCodes = file('roomCodes.txt');

$roomCodes = collect($roomCodes);

$validRoomNames = $roomCodes->map(function($roomCode) {
	return new RoomCode($roomCode);
})->filter(function($room) {
	return $room->isValid();
});

$validRoomSectorIDSum = $validRoomNames->reduce(function($carry, $room) {
	return $carry += $room->sectorID;
});

$northPoleStorageID = $validRoomNames->map(function($room) {
	return [
		'roomName' => (new RoomDecrypter($room->roomName, $room->sectorID))->decode(),
		'sectorID' => $room->sectorID
	];
})->filter(function($room) {
	return strpos($room['roomName'], 'pole');
})->flatten()->get(1);

echo sprintf("Sum of valid room sector ids: %d\n", $validRoomSectorIDSum);
echo sprintf("Sector ID of room where N. Pole objects are stored: %d\n", $northPoleStorageID);
