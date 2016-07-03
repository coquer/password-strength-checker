<?php

namespace jycr753\PasswordStrengthChecker;

class RepeatInString extends RepeatInStringAbstract
{
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
        if (!empty($matches[0])) {
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
        if (!empty($matches[0])) {
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
        if (!empty($matches[0])) {
            $score = 0;
            foreach ($matches[0] as $match) {
                $score -= (strlen($match) - 1) * 2;
            }

            return $score;
        }

        return 0;
    }
}
