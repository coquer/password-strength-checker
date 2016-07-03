<?php

namespace jycr753\PasswordStrengthChecker;

abstract class PasswordCheckAbstract
{
    abstract public function countLength(array $password);

    abstract public function countLowerCase(array $password);

    abstract public function countNumbers(array $password);

    abstract public function countSymbols(array $password);

    abstract public function countUpperCase(array $password);

    abstract public function hasCharactersOnly(array $password);

    abstract public function hasExtra(array $password);

    abstract public function hasNumbersOnly(array $password);

    abstract public function hasAnyNumberInTheMiddle(array $password);

    abstract public function doesHasSequentialChars(array $password);

    abstract public function doesHasSequentialNumbers(array $password);

    abstract public function doesHasSequentialUpperCase(array $password);

    abstract public function doesHasSequentialLowerCase(array $password);
}
