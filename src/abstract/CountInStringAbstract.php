<?php

namespace jycr753\PasswordStrengthChecker;

abstract class CountInStringAbstract
{
    abstract public function countLength(array $password);

    abstract public function countLowerCase(array $password);

    abstract public function countNumbers(array $password);

    abstract public function countSymbols(array $password);

    abstract public function countUpperCase(array $password);
}
