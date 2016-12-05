<?php

namespace App;

class RoomDecrypter
{
	protected $roomName;

	protected $sectorID;

	protected $rotations;

    public function __construct($roomName, $sectorID)
    {
        $this->roomName = str_replace('-', ' ', $roomName);
		$this->sectorID = $sectorID;

		$this->rotations = $sectorID % 26;
    }

    public function rotations()
    {
        return $this->rotations;
    }

    public function decode()
    {
		return $this->str_rot($this->roomName, $this->rotations);
    }

    private function str_rot($string, $rotations = 13) {

		$letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$rotations = (int) $rotations % 26;

		if (!$rotations) return $string;

		if ($rotations == 13) return str_rot13($string);

		for ($i = 0, $length = strlen($string); $i < $length; $i++) {

			$character = $string[$i];

			if ($character >= 'a' && $character <= 'z') {
				$string[$i] = $letters[(ord($character) - 71 + $rotations) % 26];
			} else if ($character >= 'A' && $character <= 'Z') {
				$string[$i] = $letters[(ord($character) - 39 + $rotations) % 26 + 26];
			}
		}

		return $string;
	}
}
