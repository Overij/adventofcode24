<?php

/**
 * @link https://adventofcode.com/2024/day/4
 */

$inputs = file('input/day04.txt', FILE_IGNORE_NEW_LINES);

$grid = array_map(fn ($x) => str_split($x), $inputs);
$count1 = $count2 = 0;

for ($i = 0; $i < count($grid); ++$i)
{
    for ($j = 0; $j < count($grid[$i]); ++$j)
    {
        // Part 1
        if ($grid[$i][$j] == 'X')
        {
            $help = [
                ($grid[$i][$j + 1] ?? '') . ($grid[$i][$j + 2] ?? '') . ($grid[$i][$j + 3] ?? ''),
                ($grid[$i][$j - 1] ?? '') . ($grid[$i][$j - 2] ?? '') . ($grid[$i][$j - 3] ?? ''),
                ($grid[$i + 1][$j] ?? '') . ($grid[$i + 2][$j] ?? '') . ($grid[$i + 3][$j] ?? ''),
                ($grid[$i - 1][$j] ?? '') . ($grid[$i - 2][$j] ?? '') . ($grid[$i - 3][$j] ?? ''),
                ($grid[$i + 1][$j + 1] ?? '') . ($grid[$i + 2][$j + 2] ?? '') . ($grid[$i + 3][$j + 3] ?? ''),
                ($grid[$i + 1][$j - 1] ?? '') . ($grid[$i + 2][$j - 2] ?? '') . ($grid[$i + 3][$j - 3] ?? ''),
                ($grid[$i - 1][$j - 1] ?? '') . ($grid[$i - 2][$j - 2] ?? '') . ($grid[$i - 3][$j - 3] ?? ''),
                ($grid[$i - 1][$j + 1] ?? '') . ($grid[$i - 2][$j + 2] ?? '') . ($grid[$i - 3][$j + 3] ?? '')
            ];
            $count1 += array_count_values($help)['MAS'] ?? 0;
        }

        // Part 2
        if ($grid[$i][$j] == 'A')
        {
            $help1 = ($grid[$i + 1][$j + 1] ?? '') . ($grid[$i - 1][$j - 1] ?? '');
            $help2 = ($grid[$i + 1][$j - 1] ?? '') . ($grid[$i - 1][$j + 1] ?? '');
            if (($help1 === 'MS' || $help1 == 'SM') && ($help2 === 'MS' || $help2 == 'SM'))
            {
                ++$count2;
            }
        }
    }
}

echo $count1 . \PHP_EOL;
echo $count2 . \PHP_EOL;
