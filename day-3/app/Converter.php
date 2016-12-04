<?php

namespace App;

class Converter
{
    public static function convert($triangles)
	{
		$convertedTriangles = [];

		for ($i = 0, $n = sizeof($triangles); $i < $n; $i+=3)
		{
			array_push($convertedTriangles,
				$triangles[$i][0] . ' ' . $triangles[$i + 1][0] . ' ' . $triangles[$i + 2][0],
				$triangles[$i][1] . ' ' . $triangles[$i + 1][1] . ' ' . $triangles[$i + 2][1],
				$triangles[$i][2] . ' ' . $triangles[$i + 1][2] . ' ' .  $triangles[$i + 2][2]
			);
		}

		return $convertedTriangles;
	}
}
