<?php

/**
 * @link https://adventofcode.com/2024/day/6
 */

$inputs = file('input/day06.txt', FILE_IGNORE_NEW_LINES);

$grid = array_map(fn ($x) => str_split($x), $inputs);
[$y, $x] = startPos($grid);
$visited = 0;
$dir = 0;

while (true)
{
    [$y2, $x2] = [[-1, 0], [0, 1], [1, 0], [0, -1]][$dir];

    if ($grid[$y][$x] !== 'X')
    {
        $grid[$y][$x] = 'X';
        ++$visited;
    }

    switch ($grid[$y + $y2][$x + $x2] ?? '')
    {
        case '#':
            $dir = $dir == 3 ? 0 : $dir + 1;
            break;
        case '':
            break 2;
        default:
            $y += $y2;
            $x += $x2;
            break;
    }
}

function startPos(array $grid) : array
{
    for ($i = 0; $i < count($grid); ++$i)
    {
        for ($j = 0; $j < count($grid[$i]); ++$j)
        {
            if ($grid[$i][$j] === '^')
            {
                return [$i, $j];
            }
        }
    }
}

echo $visited . \PHP_EOL;
