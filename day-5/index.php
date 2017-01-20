<?php

// Part One:

$roomCode = 'reyedfim';

$theInt = 0;

$password = '';

while (strlen($password) < 8)
{
    $currentString = $roomCode . $theInt;

    $hash = md5($currentString);

    $firstFiveLettersOfHash = substr($hash, 0, 5);

    if ($firstFiveLettersOfHash === '00000')
    {
        $password .= substr($hash, 5, 1);
    }

    $theInt++;
}

var_dump($password);

// Part Two:

$roomCode = 'reyedfim';

$theInt = 0;

$password = [
    '', '', '', '', '', '', '', ''
];

$passwordInputs = 0;

while ($passwordInputs < 8)
{
    $currentString = $roomCode . $theInt;

    $hash = md5($currentString);

    $firstFiveLettersOfHash = substr($hash, 0, 5);

    if ($firstFiveLettersOfHash === '00000')
    {
        $sixthCharacter = substr($hash, 5, 1);

        if (preg_match('/[0-7]/', $sixthCharacter))
        {
            if ($password[$sixthCharacter] == '')
            {
                $password[$sixthCharacter] = substr($hash, 6, 1);
                $passwordInputs++;
                
            }
        }
    }

    $theInt++;
}

var_dump(implode($password));