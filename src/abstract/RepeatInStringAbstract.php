<?php

namespace jycr753\PasswordStrengthChecker;

abstract class RepeatInStringAbstract {
    public abstract function doesHasSequentialChars(array $password);
    public abstract function doesHasSequentialNumbers(array $password);
    public abstract function doesHasSequentialUpperCase(array $password);
    public abstract function doesHasSequentialLowerCase(array $password);
}