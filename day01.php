<?php

/**
 * @link https://adventofcode.com/2024/day/1
 */

$inputs = file('input/day01.txt', FILE_IGNORE_NEW_LINES);

$sum1 = $sum2 = 0;
$left = $right = [];

foreach ($inputs as $line)
{
    preg_match('/(?<left>\d+)\s+(?<right>\d+)/', $line, $matches);
    $left[] = (int) $matches['left'];
    $right[] = (int) $matches['right'];
}

sort($left);
sort($right);

$counts = array_count_values($right);

for ($i = 0; $i < count($left); ++$i)
{
    $sum1 += abs($left[$i] - $right[$i]);
    $sum2 += $left[$i] * ($counts[$left[$i]] ?? 0);
}

echo $sum1 . \PHP_EOL;
echo $sum2 . \PHP_EOL;
