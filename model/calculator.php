<?php
function addition(float $arg1, float $arg2): float    {
    return $arg1 + $arg2;
}

function subtraction (float $arg1, float $arg2): float
{
    return $arg1 - $arg2;
}

function multiply(float $arg1, float $arg2): float
{
    return $arg1 * $arg2;
}

function division(float $arg1, float $arg2): float|string
{
    return $arg2 == 0 ? 'На ноль делить нельзя!' : $arg1 / $arg2;
}


function calculate(float $arg1, float $arg2, string $operator): float|string
{
    switch($operator){
        case '+':
            return addition($arg1, $arg2);
        case '-':
            return subtraction($arg1, $arg2);
        case '*':
            return multiply($arg1, $arg2);
        case '/':
            return division($arg1, $arg2);
        default:
            return 'Ошибка!';
    }

}