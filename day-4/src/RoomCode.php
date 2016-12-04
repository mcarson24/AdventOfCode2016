<?php

namespace App;

class RoomCode
{
	protected $encryptedData;

	public $roomName;

	public $sectorID;

	public function __construct($encryptedData)
    {
        $this->encryptedData = $encryptedData;

		$this->roomName = $this->roomName();

		$this->sectorID = $this->sectorID();
    }

	public function encryptedData()
    {
        return $this->encryptedData;
    }

	public function roomName()
    {
		$positionOfFirstNumber = $this->findFirstDigitIn($this->encryptedData);

		return substr($this->encryptedData, 0, $positionOfFirstNumber - 1);
    }

	public function sectorID()
	{
		$positionOfFirstNumber = $this->findFirstDigitIn($this->encryptedData);

		return (int) substr($this->encryptedData, $positionOfFirstNumber, 3);
	}

	public function checkSum()
	{
		$positionOfCheckSum = strpos($this->encryptedData, '[') + 1;

		return substr($this->encryptedData, $positionOfCheckSum, 5);
	}

	public function isValid()
	{
		return $this->checkSum() == $this->mostCommonLetters();
	}

	public function mostCommonLetters()
	{
		$roomName = preg_replace('/-/', '', $this->roomName);

		$letters = array_count_values(str_split($roomName));

		array_walk($letters, function(&$occurrences, $letter) {
			$occurrences = [
				'letter' => $letter,
				'occurrences' =>$occurrences
			];
		});

		uasort($letters, function($a, $b) {
			return $this->order($a, $b);
		});

		return substr(implode(array_keys($letters)), 0, 5);
	}

	private function findFirstDigitIn($string)
	{
		$string = str_split($string);

		for ($i = 0, $n = sizeof($string); $i < $n; $i++)
		{
			if (is_numeric($string[$i]))
			{
				return $i;
			}
		}
	}

	private function order($a, $b)
	{
		if ($a['occurrences'] == $b['occurrences'])
		{
			if ($a['letter'] > $b['letter']) return 1;
		}
		return $a['occurrences'] < $b['occurrences'] ? 1 : -1;
	}
}
