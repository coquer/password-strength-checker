<?php

namespace jycr753\PasswordStrengthChecker;

abstract class RepeatInStringAbstract {
    public abstract function doesChartRepeats();
    public abstract function doesHasSequentialChars();
    public abstract function doesHasSequentialNumbers();
    public abstract function doesHasSequentialUpperCase();
    public abstract function doesHasSequentialLowerCase();
}