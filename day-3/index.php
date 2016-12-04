<?php

require 'vendor/autoload.php';

use App\Triangle;
use App\Converter;
use App\TriangleChecker;

$sideLengths = file('triangles.txt');

$triangles = array_map(function($lengths) {
	return (string) (new TriangleChecker(new Triangle($lengths)))->isValid();
}, $sideLengths);

$validOriginalTriangles = array_count_values($triangles);

$newTriangles = array_map(function($lengths) {
	return (string) (new TriangleChecker(new Triangle($lengths)))->isValid();
}, Converter::convert(Triangle::cleanSideLengths()));

$validNewTriangles = array_count_values($newTriangles);

echo sprintf("Valid Triangles: %s\n", $validOriginalTriangles[1]);
echo sprintf("Valid Vertical Triangles: %s\n", $validNewTriangles[1]);
