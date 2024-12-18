<?php

/**
 * @link https://adventofcode.com/2024/day/8
 */

$inputs = file('input/day08.txt', FILE_IGNORE_NEW_LINES);

$grid = array_map(fn ($x) => str_split($x), $inputs);
$antennas = [];
$antinodes1 = $antinodes2 = [];
$min = 0;
$max = count($grid);

for ($i = 0; $i < count($grid); ++$i)
{
    for ($j = 0; $j < count($grid[$i]); ++$j)
    {
        if ($grid[$i][$j] !== '.')
        {
            $antennas[$grid[$i][$j]][] = [$i, $j];
        }
    }
}

foreach ($antennas as $nodes)
{
    for ($i = 0; $i < count($nodes); ++$i)
    {
        for ($j = 0; $j < count($nodes); ++$j)
        {
            if ($i == $j) continue;

            [$y1, $x1] = $nodes[$i];
            [$y2, $x2] = $nodes[$j];

            $dy = $y2 - $y1;
            $dx = $x2 - $x1;
            
            // Part 1
            if ($y1 - $dy >= $min && $y1 - $dy < $max && $x1 - $dx >= $min && $x1 - $dx < $max)
            {
                $antinodes1[] = $y1 - $dy . 'x' . $x1 - $dx;
            }

            if ($y2 + $dy >= $min && $y2 + $dy < $max && $x2 + $dx >= $min && $x2 + $dx < $max)
            {
                $antinodes1[] = $y2 + $dy . 'x' . $x2 + $dx;
            }

            // Part 2
            [$y1, $x1] = $nodes[$i];
            while($y1 - $dy >= $min && $y1 - $dy < $max && $x1 - $dx >= $min && $x1 - $dx < $max)
            {
                $antinodes2[] = $y1 - $dy . 'x' . $x1 - $dx;
                $y1 -= $dy;
                $x1 -= $dx;
            }

            [$y1, $x1] = $nodes[$i];
            while ($y1 + $dy >= $min && $y1 + $dy < $max && $x1 + $dx >= $min && $x1 + $dx < $max)
            {
                $antinodes2[] = $y1 + $dy . 'x' . $x1 + $dx;
                $y1 += $dy;
                $x1 += $dx;
            }
        }
    }
}

echo count(array_unique($antinodes1)) . \PHP_EOL;
echo count(array_unique($antinodes2)) . \PHP_EOL;
