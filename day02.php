<?php

/**
 * @link https://adventofcode.com/2024/day/2
 */

$inputs = file('input/day02.txt', FILE_IGNORE_NEW_LINES);

$safe1 = $safe2 = 0;

foreach ($inputs as $line)
{
    $nums = explode(' ', $line);
    $nums = array_merge([$nums], genArrays($nums));

    for ($i = 0; $i < count($nums); ++$i)
    {
        if (isSafe($nums[$i]))
        {
            if ($i == 0)
            {
                ++$safe1;
            }
            ++$safe2;
            break;
        }
    }
}

function genArrays(array $in) : array
{
    $res = [];
    for ($i = 0; $i < count($in); ++$i)
    {
        $help = $in;
        array_splice($help, $i, 1);
        $res[] = $help;
    }
    return $res;
}

function isSafe(array $nums) : bool
{
    $help1 = array_values($nums);
    $help2 = array_values($nums);
    sort($help1);
    rsort($help2);

    if ($nums !== $help1 && $nums !== $help2) 
    {
        return false;
    }

    for ($i = 0; $i < count($nums) - 1; ++$i)
    {
        if ($nums[$i] == $nums[$i + 1] || abs($nums[$i] - $nums[$i + 1]) > 3)
        {
            return false;
        }
    }

    return true;
}

echo $safe1 . \PHP_EOL;
echo $safe2 . \PHP_EOL;
