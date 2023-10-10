<?php

function fibonacci($n, $first = 0, $second = 1)
{
    $fib = [$first, $second];
    for ($i = 1; $i < $n; $i++) {
        $fib[] = $fib[$i] + $fib[$i - 1];
    }
    return $fib;
}


echo implode(', ', fibonacci(10));
