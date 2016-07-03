<?php

namespace jycr753\PasswordStrengthChecker;

class CountInString extends CountInStringAbstract
{
    public function countLength(array $password)
    {
        return  $password['length'] * 4;
    }

    public function countLowerCase(array $password)
    {
        preg_match_all('/[a-z]{1}/', $password['raw'], $matches);
        if (isset($matches[0])) {
            if (implode('', $matches[0]) == $password['raw']) {
                return 0;
            }

            return (strlen($password['raw']) - count($matches[0])) * 2;
        }

        return 0;
    }

    public function countNumbers(array $password)
    {
        preg_match_all('/[0-9]{1}/', $password['raw'], $matches);
        if (isset($matches[0])) {
            if (implode('', $matches[0]) == $password['raw']) {
                return 0;
            }

            return count($matches[0]) * 4;
        }

        return 0;
    }

    public function countSymbols(array $password)
    {
        return  $password['symbol']['count'] * 6;
    }

    public function countUpperCase(array $password)
    {
        preg_match_all('/[A-Z]{1}/', $password['raw'], $matches);
        if (isset($matches[0])) {
            if (implode('', $matches[0]) == $password['raw']) {
                return 0;
            }

            return (strlen($password['raw']) - count($matches[0])) * 2;
        }

        return 0;
    }
}
