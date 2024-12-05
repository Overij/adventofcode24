<?php

/**
 * @link https://adventofcode.com/2024/day/5
 */

$inputs = file_get_contents('input/day05.txt');

$rules = [];
$updates = [];
$sum1 = $sum2 = 0;

preg_match_all('/((\d+)\|(\d+))|(\d+(?:,\d+)*)/', $inputs, $matches, \PREG_SET_ORDER | \PREG_UNMATCHED_AS_NULL);
foreach ($matches as $match)
{
    if ($match[1])
    {
        // Use first num as index for easier lookups
        $rules[$match[2]][] = [$match[2], $match[3]];
    }
    else if ($match[4])
    {
        $updates[] = explode(',', $match[4]);
    }
}

foreach ($updates as $update)
{
    // Part 1
    $valid = true;
    for ($i = 0; $i < count($update); ++$i)
    {
        for ($j = 0; $j < count($update); ++$j)
        {
            if ($j < $i && in_array([$update[$i], $update[$j]], $rules[$update[$i]]))
            {
                $valid = false;
                break 2;
            }

        }
    }
    $sum1 += $valid ? $update[(int) (count($update) / 2)] : 0;

    // Part 2
    $rs = array_filter($rules, fn ($x) => in_array($x, $update), \ARRAY_FILTER_USE_KEY);
    $sorted = $update;
    usort($sorted, fn ($a, $b) => in_array([$a, $b], $rs[$a]) ? -1 : 1);
    $sum2 += $sorted !== $update ? $sorted[(int) (count($sorted) / 2)] : 0;
}

echo $sum1 . \PHP_EOL;
echo $sum2 . \PHP_EOL;
