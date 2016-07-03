<?php

namespace jycr753\PasswordStrengthChecker;

abstract class RepeatInStringAbstract
{
    abstract public function doesHasSequentialChars(array $password);

    abstract public function doesHasSequentialNumbers(array $password);

    abstract public function doesHasSequentialUpperCase(array $password);

    abstract public function doesHasSequentialLowerCase(array $password);
}
