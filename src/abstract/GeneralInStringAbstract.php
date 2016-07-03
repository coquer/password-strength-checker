<?php

namespace jycr753\PasswordStrengthChecker;

abstract class GeneralInStringAbstract
{
    abstract public function hasCharactersOnly(array $password);

    abstract public function hasExtra(array $password);

    abstract public function hasNumbersOnly(array $password);

    abstract public function hasAnyNumberInTheMiddle(array $password);
}
