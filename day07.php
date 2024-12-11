<?php

/**
 * @link https://adventofcode.com/2024/day/7
 */

$inputs = file_get_contents('input/day07.txt');

$sum1 = $sum2 = 0;

preg_match_all('/(\d+)\:\ (\d+(?:\ \d+)*)/', $inputs, $matches, \PREG_SET_ORDER);

foreach ($matches as $match)
{
    $result = (int) $match[1];
    $numbers = explode(' ', $match[2]);
    $sum1 += in_array($result, iterator_to_array(calc1(array_reverse($numbers)), false)) ? $result : 0;
    $sum2 += in_array($result, iterator_to_array(calc2(array_reverse($numbers)), false)) ? $result : 0;
}

function calc1(array $numbers): \Generator
{
    $first = array_shift($numbers);
    if (count($numbers) == 0)
    {
        yield $first;
    }
    else
    {
        foreach(calc1($numbers) as $num)
        {
            yield $first + $num;
            yield $first * $num;
        }
    }
}

function calc2(array $numbers): \Generator
{
    $first = array_shift($numbers);
    if (count($numbers) == 0)
    {
        yield $first;
    }
    else
    {
        foreach(calc2($numbers) as $num)
        {
            yield $first + $num;
            yield $first * $num;
            yield $num . $first;
        }
    }
}

echo $sum1 . \PHP_EOL;
echo $sum2 . \PHP_EOL;
