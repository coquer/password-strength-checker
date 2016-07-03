<?php

namespace jycr753\PasswordStrengthChecker;

class PasswordCheckImplementation extends CountInStringAbstract
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

    public function hasCharactersOnly(array $password)
    {
        $passwordLength = strlen($password['raw']);

        return (
            $password['lower']['count'] + $password['upper']['count'] == $passwordLength
        ) ? -$passwordLength : 0;
    }

    public function hasExtra(array $password)
    {
        $score = 0;
        if (strlen($password['raw']) >= 8) {
            $score += 2;
        }
        foreach (['upper', 'lower', 'number', 'symbol'] as $type) {
            if ($password[$type]['count'] > 0) {
                $score += 2;
            }
        }

        return $score;
    }

    public function hasNumbersOnly(array $password)
    {
        $passwordLength = strlen($password['raw']);

        return (
            $password['number']['count'] == $passwordLength
        ) ? -$passwordLength : 0;
    }

    public function hasAnyNumberInTheMiddle(array $password)
    {
        $password = substr($password['raw'], 1, strlen($password['raw']) - 2);
        preg_match_all('/[0-9]{1}/', $password, $matches);

        return (isset($matches[0])) ? count($matches[0]) * 2 : 0;
    }

    public function doesHasSequentialChars(array $password)
    {
        $score = 0;
        $result = 0;
        foreach ($password['list'] as $character => $count) {
            if ($count > 1) {
                $score += $count - 1;
            }
        }
        if ($score > 0) {
            $result -= (int) ($score / (strlen($password['raw']) - $score)) + 1;
        }

        return $result;
    }

    public function doesHasSequentialNumbers(array $password)
    {
        preg_match_all('/[0-9]{2,}/', $password['raw'], $matches);
        if (! empty($matches[0])) {
            $score = 0;
            foreach ($matches[0] as $match) {
                $score -= (strlen($match) - 1) * 2;
            }

            return $score;
        }

        return 0;
    }

    public function doesHasSequentialUpperCase(array $password)
    {
        preg_match_all('/[A-Z]{2,}/', $password['raw'], $matches);
        if (! empty($matches[0])) {
            $score = 0;
            foreach ($matches[0] as $match) {
                $score -= (strlen($match) - 1) * 2;
            }

            return $score;
        }

        return 0;
    }

    public function doesHasSequentialLowerCase(array $password)
    {
        preg_match_all('/[a-z]{2,}/', $password['raw'], $matches);
        if (! empty($matches[0])) {
            $score = 0;
            foreach ($matches[0] as $match) {
                $score -= (strlen($match) - 1) * 2;
            }

            return $score;
        }

        return 0;
    }
}
