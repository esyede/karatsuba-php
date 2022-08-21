<?php

namespace Esyede;

class Karatsuba
{
    public function multiply(int $first, int $second)
    {
        // not a base10, fall back to traditional multiplication
        if ($first < 10 || $second < 10) {
            return $first * $second;
        }

        // find middle / half position
        $half = ceil((max(ceil(log10($first)), ceil(log10($second)))) / 2);

        $first = '' . $first;
        $second = '' . $second;

        // split the digit sequences in the middle
        $left1 = (int) substr($first, 0, strlen($first) - $half);
        $right1 = (int) substr($first, - $half);

        $left2 = (int) substr($second, 0, strlen($second) - $half);
        $right2  = (int) substr($second, - $half);

        // 3 recursive calls made to numbers approximately half the size
        $recurse1 = $this->multiply($right1, $right2);
        $recurse2 = $this->multiply($right1 + $left1, $right2 + $left2);
        $recurse3 = $this->multiply($left1, $left2);

        return (int) (($recurse3 * pow(10, 2 * $half))
            + (($recurse2 - $recurse3 - $recurse1) * pow(10, $half))
            + $recurse1);
    }
}
