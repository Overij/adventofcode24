<?php

/**
 * @link https://adventofcode.com/2024/day/9
 */

$inputs = str_split(file_get_contents('input/day09.txt'));

$blocks1 = [];
$sum1 = $sum2 = 0;

for ($i = 0; $i < count($inputs); ++$i)
{
    array_push($blocks1, ...array_fill(0, $inputs[$i], $i % 2 == 0 ? (int) ($i / 2) : '.'));
}

$blocks2 = $blocks1;

// Part 1
for ($i = 0, $j = count($blocks1) - 1; $i < $j; ++$i, --$j)
{
    while ($blocks1[$i] !== '.') if (++$i == $j) break 2;
    while ($blocks1[$j] === '.') if ($i == --$j) break 2;

    $blocks1[$i] = $blocks1[$j];
    $blocks1[$j] = '.';
}

for ($i = 0; $i < count($blocks1); ++$i)
{
    $sum1 += $blocks1[$i] !== '.' ? $i * $blocks1[$i] : 0;
}

echo $sum1 . \PHP_EOL;

// Part 2
for ($j1 = count($blocks2) - 1; $j1 >= 0; /*--$j1*/)
{
    $i1 = 0;

    while ($blocks2[$i1] !== '.') if (++$i1 == $j1) break 2;
    while ($blocks2[$j1] === '.') if ($i1 == --$j1) break 2;

    // now $i1 is a '.'
    // and $j1 is NOT a '.'

    $j2 = $j1;
    $c = '';
    while ($blocks2[$j2] !== '.')
    {
        $c .= $blocks2[$j2] . 'x';
        --$j2;
        if ($blocks2[$j2] !== $blocks2[$j1]) break;
    }
    $fsize = $j1 - $j2;

    //while ($i1 < $j2)
    while (true)
    {
        $i2 = $i1;
        while ($blocks2[$i2] === '.') ++$i2;
        $esize = $i2 - $i1;
        if ($esize >= $fsize)
        {
            break;
        }
        $i1 = $i2;
        while ($blocks2[$i1] !== '.') if (++$i1 == $j2) break 2;
    }

    if ($esize < $fsize)
    {
        $j1 = $j2;
        continue;
    }

    for ($j = $j1; $j > $j2; --$j)
    {
        //echo $i1 . ' ' . $blocks2[$i1] . ' -> ' . $blocks2[$j] . ' . @ ' . array_search('.', $blocks2) . \PHP_EOL;
        $blocks2[$i1++] = $blocks2[$j];
        $blocks2[$j] = '.';
    }

    $j1 = $j2;

    echo '';

    /*
    $i1 = 0;

    while ($blocks2[$j1] === '.') if ($i1 == --$j1) break 2;

    $j2 = $j1;
    while ($blocks2[$j2] !== '.') if (--$j2 < 0) break 2;
    $fsize = $j1 - $j2;

    while (true)
    {
        $esize = 0;
        while ($blocks2[$i1] !== '.') if (++$i1 >= $j2) break 2;
        $i2 = $i1;
        while ($blocks2[$i2] === '.') if (++$i2 >= $j2) break 2;
        $esize = $i2 - $i1;
        if ($esize < $fsize)
        {
            $i1 = $i2;
            continue;
        }
        break;
    }

    if ($esize < $fsize) continue;

    for ($j = $j1; $j > $j2; --$j)
    {
        $blocks2[$i1++] = $blocks2[$j];
        $blocks2[$j] = '.';
    }

    //echo 'x' . \PHP_EOL;
    */
}

echo implode('', $blocks1) . \PHP_EOL;
echo implode('', $blocks2) . \PHP_EOL;

for ($i = 0; $i < count($blocks2); ++$i)
{
    $sum2 += $blocks2[$i] !== '.' ? $i * $blocks2[$i] : 0;
}



echo $sum2 . \PHP_EOL;
