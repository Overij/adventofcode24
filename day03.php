<?php

/**
 * @link https://adventofcode.com/2024/day/3
 */

$inputs = file_get_contents('input/day03.txt');
$sum1 = $sum2 = 0;

preg_match_all('/mul\((\d+),(\d+)\)/', $inputs, $matches_muls, \PREG_OFFSET_CAPTURE);
preg_match_all('/do\(\)/', $inputs, $matches_dos, \PREG_OFFSET_CAPTURE);
preg_match_all('/don\'t\(\)/', $inputs, $matches_donts, \PREG_OFFSET_CAPTURE);


for ($i = 0; $i < count($matches_muls[0]); ++$i)
{
    // Part 1
    $sum1 += $matches_muls[1][$i][0] * $matches_muls[2][$i][0];

    // Part 2
    $do = closest($matches_dos[0], $matches_muls[1][$i][1]) + 1;
    $dont = closest($matches_donts[0], $matches_muls[1][$i][1]);

    if ($do > $dont)
    {
        $sum2 += $matches_muls[1][$i][0] * $matches_muls[2][$i][0];
    }
}

function closest(array $search, int $offset) : int
{
    $help = array_column(array_filter($search, fn ($x) => $x[1] < $offset), 1);
    return count($help) == 0 ? 0 : max($help);
}

echo $sum1 . \PHP_EOL;
echo $sum2 . \PHP_EOL;
